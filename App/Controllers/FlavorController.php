<?php

namespace App\Controllers;

use App\Models\Flavor;
use App\Models\Tea;
use App\Support\Selection;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class FlavorController extends BaseController
{
    public function index(Request $request): Response
    {
        $session = $this->app->getSession();
        $message = $session->get('flavor_message');
        $session->remove('flavor_message');

        return $this->html([
            'flavors' => Flavor::getAll(orderBy: 'name ASC'),
            'message' => $message,
        ]);
    }

    public function create(Request $request): Response
    {
        return $this->form($request, new Flavor());
    }

    public function edit(Request $request): Response
    {
        return $this->form($request, $this->findFlavor($request));
    }

    public function delete(Request $request): Response
    {
        $this->allowFormMethods($request);
        $flavor = $this->findFlavor($request);

        if ($request->isPost()) {
            $this->verifyFormToken($request);
            $flavor->delete();

            return $this->backToList('Príchuť bola vymazaná. Čaje zostali zachované.');
        }

        return $this->html(['flavor' => $flavor, 'token' => $this->formToken()]);
    }

    private function form(Request $request, Flavor $flavor): Response
    {
        $this->allowFormMethods($request);
        $isEdit = $flavor->getId() !== null;
        $teas = Tea::getAll(orderBy: 'name ASC');
        $selectedTeaIds = array_map(fn(Tea $tea) => $tea->getId(), $flavor->getTeas());
        $values = ['name' => $flavor->getName(), 'description' => $flavor->getDescription()];
        $errors = [];

        if ($request->isPost()) {
            $this->verifyFormToken($request);
            foreach (array_keys($values) as $field) {
                $value = $request->post($field);
                $values[$field] = is_string($value) ? trim($value) : '';
            }
            $values['description'] = str_replace(["\r\n", "\r"], "\n", $values['description']);

            if (preg_match('/\A.{1,60}\z/us', $values['name']) !== 1) {
                $errors[] = 'Zadajte názov príchute s najviac 60 znakmi.';
            } elseif (Flavor::getCount('name = ? AND id <> ?', [$values['name'], $flavor->getId() ?? 0]) > 0) {
                $errors[] = 'Príchuť s týmto názvom už existuje. Upravte ju alebo zvoľte iný názov.';
            }
            if (preg_match('/\A.{0,240}\z/us', $values['description']) !== 1) {
                $errors[] = 'Popis môže obsahovať najviac 240 znakov.';
            }
            $selection = Selection::ids(
                $request->post('tea_ids'),
                array_map(fn(Tea $tea) => $tea->getId(), $teas)
            );
            $selectedTeaIds = $selection ?? [];
            if ($selection === null) {
                $errors[] = 'Vyberte čaje z ponuky.';
            }

            if ($errors === []) {
                $flavor->setName($values['name']);
                $flavor->setDescription($values['description']);
                $flavor->saveWithTeas($selectedTeaIds);

                return $this->backToList($isEdit ? 'Zmeny príchute boli uložené.' : 'Príchuť bola pridaná.');
            }
        }

        return $this->html([
            'flavor' => $flavor,
            'isEdit' => $isEdit,
            'values' => $values,
            'errors' => $errors,
            'teas' => $teas,
            'selectedTeaIds' => $selectedTeaIds,
            'token' => $this->formToken(),
        ], 'form')->setStatusCode($errors === [] ? 200 : 422);
    }

    private function findFlavor(Request $request): Flavor
    {
        $id = filter_var($request->get('id'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $flavor = $id === false ? null : Flavor::getOne($id);
        if ($flavor === null) {
            throw new HttpException(404, 'Príchuť sa nenašla.');
        }

        return $flavor;
    }

    private function allowFormMethods(Request $request): void
    {
        if (!$request->isGet() && !$request->isPost()) {
            throw new HttpException(405);
        }
    }

    private function formToken(): string
    {
        $session = $this->app->getSession();
        $token = $session->get('flavor_form_token');
        if (!is_string($token)) {
            $token = bin2hex(random_bytes(32));
            $session->set('flavor_form_token', $token);
        }

        return $token;
    }

    private function verifyFormToken(Request $request): void
    {
        $token = $request->post('token');
        if (!is_string($token) || !hash_equals($this->formToken(), $token)) {
            throw new HttpException(403, 'Otvorte formulár znova a zopakujte akciu.');
        }
    }

    private function backToList(string $message): Response
    {
        $this->app->getSession()->set('flavor_message', $message);

        return $this->redirect($this->url('flavor.index'))->setStatusCode(303);
    }
}
