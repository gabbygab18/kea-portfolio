<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    public function index()
    {
        return view('admin.messages.index', [
            'messages' => ContactMessage::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function show(ContactMessage $contactMessage)
    {
        return view('admin.messages.show', [
            'message' => $contactMessage,
        ]);
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }
}
