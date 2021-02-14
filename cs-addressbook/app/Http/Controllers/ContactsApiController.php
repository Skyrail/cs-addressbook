<?php

namespace App\Http\Controllers;

use App\Services\ChurchSuiteService;
use Illuminate\Http\Request;

class ContactsApiController extends Controller
{
    private $api;

    /**
     * @param ChurchSuiteService $api
     */
    public function __construct(ChurchSuiteService $api) {
        // TODO: Change this to be a ContactRepository
        $this->api = $api;
    }

    /**
     * Get list of contacts - list can be filtered as follows via the request:
     * 
     * query - filter by name/email/address
     * page - page number of the list
     * per_page - the amount of contacts to return per page
     * 
     * @param Request $request
     */
    public function getContacts(Request $request) {

        $result = $this->api->get('/addressbook/contacts', [
            'q' => $request->query('query'),
            'page' => $request->query('page'),
            'per_page' => $request->query('per_page')
        ]);

        return response()->json($result);
    }

    /**
     * Returns a specific contact
     * 
     * @param Request $request
     * @param int $contact_id
     */
    public function getContact(Request $requeset, int $contact_id) {

        $result = $this->api->get('/addressbook/contact/' . $contact_id);

        return response()->json($result);
    }
}
