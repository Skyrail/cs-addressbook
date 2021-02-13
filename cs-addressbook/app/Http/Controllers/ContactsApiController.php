<?php

namespace App\Http\Controllers;

use App\Services\ChurchSuiteService;
use Illuminate\Http\Request;

class ContactsApiController extends Controller
{
    private $api;

    public function __construct(ChurchSuiteService $api) {
        $this->api = $api;
    }

    public function getContacts(Request $request) {

        $contacts = array(
            'response' => 'All contacts, or filtered',
            'query' => $request->query('query'),
            'page' => $request->query('page'),
            'per_page' => $request->query('per_page')
        );

        return response()->json($contacts);

    }

    public function getContact(Request $requeset, $contact_id) {

        $result = $this->api->get('/addressbook/contact/' . $contact_id);

        return response()->json($result);

    }
}
