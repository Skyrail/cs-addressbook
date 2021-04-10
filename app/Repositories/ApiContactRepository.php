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

        if($result->getStatusCode() == 200) {

            $result_data = json_decode($result->getBody()->getContents());

            foreach ($result_data->contacts as $contact_data) {
                $contact = new Contact();
                $this->populateContact($contact, $contact_data);
                $data['contacts'][] = $contact;
            }

            $data['code'] = 200;
            $data['meta'] = [
                'page' => $result_data->pagination->page,
                'per_page' => $result_data->pagination->per_page,
                'result_count' => $result_data->pagination->no_results
            ];
        } else {
            $data['error'] = json_decode($result->getBody()->getContents())->error->message;
            $data['code'] = $result->getStatusCode();
        }

        return $data;
    }

    /**
     * @return array - an array of Contacts with meta information
     */
    public function findAll()
    {
        $data = [];

        $result = $this->api->get('/addressbook/contacts');

        if($result->getStatusCode() == 200) {

            $result_data = json_decode($result->getBody()->getContents());

            foreach ($result_data->contacts as $contact_data) {
                $contact = new Contact();
                $this->populateContact($contact, $contact_data);
                $data['contacts'][] = $contact;
            }

            $data['code'] = 200;
            $data['meta'] = [
                'page' => $result_data->pagination->page,
                'per_page' => $result_data->pagination->per_page,
                'result_count' => $result_data->pagination->no_results
            ];
        } else {
            $data['error'] = json_decode($result->getBody()->getContents())->error->message;
            $data['code'] = $result->getStatusCode();
        }

        return $result;
    }

    /**
     * @param int $contact_id
     * @return Contact
     */
    public function findById(int $contact_id)
    {
        $data = [];

        $result = $this->api->get('/addressbook/contact/' . $contact_id);

        if($result->getStatusCode() == 200) {
            $contact = new Contact();
            $this->populateContact($contact, json_decode($result->getBody()->getContents()));

            $data['code'] = 200;
            $data['contact'] = $contact;
        } else {
            $data['error'] = json_decode($result->getBody()->getContents())->error->message;
            $data['code'] = $result->getStatusCode();
        }

        return $data;
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
