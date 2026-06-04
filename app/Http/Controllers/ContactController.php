<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($data);

        $redirectTo = $request->input('redirect_to') === 'home'
            ? route('home') . '#contact'
            : route('contact');

        return redirect($redirectTo)->with('success', 'Thank you — your message has been submitted.');
    }
}
