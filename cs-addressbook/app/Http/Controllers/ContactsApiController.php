<?php

namespace App\Http\Controllers;

use App\Repositories\ContactRepositoryInterface;
use Illuminate\Http\Request;

class ContactsApiController extends Controller
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

        $result = $this->repo->find($request->query('query'));

        return response()->json($result);
    }

    /**
     * Returns a specific contact
     * 
     * @param Request $request
     * @param int $contact_id
     */
    public function getContact(Request $requeset, int $contact_id) {

        $result = $this->repo->findById($contact_id);

        return response()->json($result);
    }
}
