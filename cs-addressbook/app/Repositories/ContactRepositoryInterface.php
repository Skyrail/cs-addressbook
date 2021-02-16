<?php

namespace App\Repositories;

interface ContactRepositoryInterface {

    public function findAll();
    public function findById(int $contact_id);
    public function find(string $query);
}