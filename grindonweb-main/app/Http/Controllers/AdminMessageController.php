<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class AdminMessageController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->get(); // Fetch messages ordered by latest
        
        return view('admin.messages', compact('messages'));
    }
}
