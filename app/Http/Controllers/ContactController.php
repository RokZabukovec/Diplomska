<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactInsertRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function save(ContactInsertRequest $request){
        $data = $request->validated();
        $contact = Contact::create($data);

        return $contact;
    }
}
