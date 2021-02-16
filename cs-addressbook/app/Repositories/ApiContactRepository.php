<?php

namespace App\Repositories;

use App\Repositories\ContactRepositoryInterface;
use App\Services\ChurchSuiteService;

class ApiContactRepository implements ContactRepositoryInterface {

    private $api;

    public function __construct(ChurchSuiteService $api) {

        $this->api = $api;
    }

    public function find($query, $page = 1, $per_page = 50) {

        $result = $this->api->get('/addressbook/contacts', [
            'q' => $query,
            'page' => $page,
            'per_page' => $per_page
        ]);

        return $result;
    }

    public function findAll() {
        $result = $this->api->get('/addressbook/contacts');

        return $result;
    }

    public function findById($contact_id) {

        $result = $this->api->get('/addressbook/contact/' . $contact_id);

        return $result;
    }
}