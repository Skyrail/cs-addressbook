<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\ContactRepositoryInterface;
use App\Services\ChurchSuiteService;

class ApiContactRepository implements ContactRepositoryInterface
{

    private $api;

    public function __construct(ChurchSuiteService $api)
    {

        $this->api = $api;
    }

    /**
     * @return array - an array of Contacts with meta information
     */
    public function find(string $query, int $page = 1, int $per_page = 50)
    {
        $data = [];

        $result = $this->api->get('/addressbook/contacts', [
            'q' => $query,
            'page' => $page,
            'per_page' => $per_page
        ]);

        $data['meta'] = [
            'page' => $result->pagination->page,
            'per_page' => $result->pagination->per_page,
            'result_count' => $result->pagination->no_results
        ];

        foreach ($result->contacts as $contact_data) {
            $contact = new Contact();
            $this->populateContact($contact, $contact_data);
            $data['contacts'][] = $contact;
        }

        return $data;
    }

    /**
     * @return array - an array of Contacts with meta information
     */
    public function findAll()
    {
        $result = $this->api->get('/addressbook/contacts');

        $data['meta'] = [
            'page' => $result->pagination->page,
            'per_page' => $result->pagination->per_page,
            'result_count' => $result->pagination->no_results
        ];

        foreach ($result->contacts as $contact_data) {
            $contact = new Contact();
            $this->populateContact($contact, $contact_data);
            $data['contacts'][] = $contact;
        }

        return $result;
    }

    /**
     * @param int $contact_id
     * @return Contact
     */
    public function findById(int $contact_id)
    {
        $result = $this->api->get('/addressbook/contact/' . $contact_id);

        $contact = new Contact();
        $this->populateContact($contact, $result);

        return $result;
    }

    private function populateContact(Contact &$contact, $contact_data)
    {
        // This works - for now.
        // Probably best building an array of the desired attributes and looping through that
        // instead. Means you can control what information is brought from the external API.
        foreach ($contact_data as $field => $value) {
            $contact->{$field} = $value;
        }
    }
}
