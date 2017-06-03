<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{

	/**
	 * 
	 */
    public function sendEntryMail() {
        $this->validate(request(), [
            # all rooms requires a name
            'singlerooms.*.name' => 'required',
            'doublerooms.*.name' => 'required',
            'twinrooms.*.name' => 'required',
            # all rooms requires a birthdate
            'singlerooms.*.birthdate' => 'required',
            'doublerooms.*.birthdate' => 'required',
            'twinrooms.*.birthdate' => 'required',
            ###
            'name' => 'required',
            'mail' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'postalCode' => 'required',
            'postalAddress' => 'required'
        ]);

        // sendEmail();

        return ['message' => 'Påmelding sendt!'];
    }
}
