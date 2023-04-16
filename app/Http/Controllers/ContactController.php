<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contacts\FullContactService;
use App\Services\Contacts\HunterService;

class ContactController extends Controller
{
    public function __construct(FullContactService $fullContactService, HunterService $hunterService)
    {
        $this->fullContactService = $fullContactService;
        $this->hunterService = $hunterService;
    }

    public function getContactsByDomain(Request $request)
    {
        $domain = $request->input('domain');
        $emailResults = $this->hunterService->getEmailsByDomain($domain);

        // go through the data nad get the emails and any other info
        if(isset($emailResults['data']['emails'])) {
            $contacts = [];
            foreach($emailResults['data']['emails'] as $email) {
                // $contactInfo = $this->fullContactService->getPersonInfoByEmail($email['value']);
                array_push($contacts, $email);
            }
            return response()->json($contacts);
        }

        return response()->json(['error' => 'No contacts found'], 404);
    }

    public function getPersonInfo(Request $request)
    {
        $email = $request->input('email');
        $personInfo = $this->fullContactService->getPersonInfoByEmail($email);

        if ($personInfo) {
            return response()->json($personInfo);
        }

        return response()->json(['error' => 'No person found'], 404);
    }
}
