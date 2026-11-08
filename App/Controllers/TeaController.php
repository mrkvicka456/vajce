<?php

namespace App\Controllers;

use App\Models\Tea;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class TeaController extends BaseController
{
    public function index(Request $request): Response
    {
        $teas = Tea::getAll(orderBy: 'id ASC');
        $session = $this->app->getSession();
        $message = $session->get('tea_message');
        $session->remove('tea_message');

        return $this->html(['teas' => $teas, 'message' => $message]);
    }

    public function create(Request $request): Response
    {
        return $this->form($request, new Tea());
    }

    public function edit(Request $request): Response
    {
        return $this->form($request, $this->findTea($request));
    }

    public function delete(Request $request): Response
    {
        $this->allowFormMethods($request);
        $tea = $this->findTea($request);

        if ($request->isPost()) {
            $this->verifyFormToken($request);
            $tea->delete();

            return $this->backToList('Čaj bol vymazaný.');
        }

        return $this->html(['tea' => $tea, 'token' => $this->formToken()]);
    }

    private function form(Request $request, Tea $tea): Response
    {
        $this->allowFormMethods($request);
        $isEdit = $tea->getId() !== null;
        $values = [
            'name' => $tea->getName(),
            'category' => $tea->getCategory(),
            'origin' => $tea->getOrigin(),
            'weight' => (string) $tea->getWeight(),
            'price' => $tea->getFormattedPrice(),
            'description' => $tea->getDescription(),
        ];
        $errors = [];

        if ($request->isPost()) {
            $this->verifyFormToken($request);
            foreach (array_keys($values) as $field) {
                $value = $request->post($field);
                $values[$field] = is_string($value) ? trim($value) : '';
            }

            $errors = $this->validate($values);
            if ($errors === []) {
                $tea->setName($values['name']);
                $tea->setCategory($values['category']);
                $tea->setOrigin($values['origin']);
                $tea->setWeight((int) $values['weight']);
                $tea->setPrice(str_replace(',', '.', $values['price']));
                $tea->setDescription($values['description']);
                $tea->save();

                return $this->backToList($isEdit ? 'Zmeny boli uložené.' : 'Čaj bol pridaný.');
            }
        }

        return $this->html([
            'tea' => $tea,
            'isEdit' => $isEdit,
            'values' => $values,
            'errors' => $errors,
            'categories' => Tea::CATEGORIES,
            'token' => $this->formToken(),
        ], 'form')->setStatusCode($errors === [] ? 200 : 422);
    }

    private function validate(array $values): array
    {
        $errors = [];

        if (preg_match('/\A.{1,80}\z/us', $values['name']) !== 1) {
            $errors[] = 'Zadajte názov čaju s najviac 80 znakmi.';
        }
        if (!isset(Tea::CATEGORIES[$values['category']])) {
            $errors[] = 'Vyberte kategóriu čaju.';
        }
        if (preg_match('/\A.{1,60}\z/us', $values['origin']) !== 1) {
            $errors[] = 'Zadajte pôvod čaju s najviac 60 znakmi.';
        }
        if (filter_var($values['weight'], FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1, 'max_range' => 10000],
        ]) === false) {
            $errors[] = 'Gramáž musí byť celé číslo od 1 do 10 000 g.';
        }
        if (preg_match('/\A[0-9]{1,5}(?:[.,][0-9]{1,2})?\z/', $values['price']) !== 1
            || (float) str_replace(',', '.', $values['price']) <= 0
        ) {
            $errors[] = 'Zadajte cenu od 0,01 do 99 999,99 € s najviac dvoma desatinnými miestami.';
        }
        if (preg_match('/\A.{0,240}\z/us', $values['description']) !== 1) {
            $errors[] = 'Popis môže obsahovať najviac 240 znakov.';
        }

        return $errors;
    }

    private function findTea(Request $request): Tea
    {
        $id = filter_var($request->get('id'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $tea = $id === false ? null : Tea::getOne($id);
        if ($tea === null) {
            throw new HttpException(404, 'Čaj sa nenašiel.');
        }

        return $tea;
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
        $token = $session->get('tea_form_token');
        if (!is_string($token)) {
            $token = bin2hex(random_bytes(32));
            $session->set('tea_form_token', $token);
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
        $this->app->getSession()->set('tea_message', $message);

        return $this->redirect($this->url('tea.index'))->setStatusCode(303);
    }
}
