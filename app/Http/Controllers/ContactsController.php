<?php

namespace App\Http\Controllers;

use App\Repositories\ContactRepositoryInterface;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    private $repo;

    /**
     * @param ContactRepositoryInterface $repo
     */
    public function __construct(ContactRepositoryInterface $repo) {
        $this->repo = $repo;
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

        if($request->query('query') == null) {
            $result = ['error' => "The search query cannot be blank", 'code' => 400];
        } else {
            $result = $this->repo->find($request->query('query'), $request->query('page'), $request->query('per_page'));
        }

        return response()->json($result, $result['code']);
    }

    /**
     * Returns a specific contact
     * 
     * @param Request $request
     * @param $contact_id
     */
    public function getContact(Request $request, $contact_id) {

        if($contact_id == null) {
            $result = ['error' => "The contact ID cannot be blank", 'code' => 400];
        } else if (!is_numeric($contact_id)) {
            $result = ['error' => "The contact ID must be a number", 'code' => 400];
        } else {
            $result = $this->repo->findById($contact_id);
        }

        return response()->json($result, $result['code']);
    }
}
