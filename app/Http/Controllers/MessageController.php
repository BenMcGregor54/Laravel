<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:32768', // Max size 32MB
        ]);

        // Handle file upload
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentPath = $file->store('attachments', 'public');
        }

        // Create the message
        Message::create([
            'to' => $request->input('to'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'attachment' => $attachmentPath,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
    public function index()
    {
        $messages = Message::all(); // You can also use pagination if needed
        return view('adminview.pages.index', compact('messages'));
    }
}
