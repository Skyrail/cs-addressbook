<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsApiController extends Controller
{
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

        $contact = array(
            'response' => 'Specific contact',
            'contact_id' => $contact_id
        );

        return response()->json($contact);

    }
}
