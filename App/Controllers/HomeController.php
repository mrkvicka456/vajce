<?php

namespace App\Controllers;

use App\Models\Tea;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class HomeController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->html();
    }

    public function katalog(Request $request): Response
    {
        $categories = ['vsetky' => 'Všetky čaje'] + Tea::CATEGORIES;
        $search = $request->get('q');
        $search = is_string($search) ? trim($search) : '';
        $category = $request->get('kategoria');
        $category = is_string($category) && isset($categories[$category]) ? $category : 'vsetky';

        $allTeas = Tea::getAll(orderBy: 'id ASC');
        $counts = array_fill_keys(array_keys($categories), 0);
        $counts['vsetky'] = count($allTeas);
        foreach ($allTeas as $tea) {
            if (isset(Tea::CATEGORIES[$tea->getCategory()])) {
                $counts[$tea->getCategory()]++;
            }
        }

        $conditions = [];
        $parameters = [];
        if ($category !== 'vsetky') {
            $conditions[] = 'category = ?';
            $parameters[] = $category;
        }
        if ($search !== '') {
            $conditions[] = 'LOCATE(?, name) > 0';
            $parameters[] = $search;
        }

        return $this->html([
            'teas' => $conditions === [] ? $allTeas : Tea::getAll(implode(' AND ', $conditions), $parameters, 'id ASC'),
            'categories' => $categories,
            'counts' => $counts,
            'search' => $search,
            'category' => $category,
        ]);
    }
}
