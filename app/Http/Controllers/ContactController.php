<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Inquiry;
use App\Notifications\InquiryReceived;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    /**
     * Store a new inquiry and send notification email.
     */
    public function store(ContactRequest $request)
    {
        // Create the inquiry
        $inquiry = Inquiry::create($request->validated());

        // Send email notification to your address
        Notification::route('mail', 'Charles.Jaeric@gmail.com')
            ->notify(new InquiryReceived($inquiry));

        return back()->with('success', 'Thank you for your message! I\'ll get back to you soon.');
    }
}
