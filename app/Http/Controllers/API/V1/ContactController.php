<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Contactus;
use App\Models\Newsletter;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Submit a contact form
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $contactus = Contactus::create($request->all());

        // Send notification to admin
        $data = [
            'message' => 'New contact us message from: ' . $request->name,
        ];
        Mail::to('info@farahnilecruise.com')->send(new SendMail($data));

        // Send confirmation to user
        $confirmationData = [
            'message' => 'Many Thanks for contacting us via the website.
            Your message has been received by Farah Nile Cruise Management.
            Please expect to receive our reply ASAP.
            Business hours are Sunday to Thursday from 09:00 am to 18:00 pm (Cairo Local time),
            Telephone number: +20 2 22731921 - 01121479292
            Email: info@farahnilecruise.com',
        ];
        Mail::to($request->email)->send(new SendMail($confirmationData));

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully.',
            'data' => $contactus
        ]);
    }

    /**
     * Subscribe to newsletter
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:newsletters,email',
        ]);

        $newsletter = Newsletter::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Successfully subscribed to newsletter.',
            'data' => $newsletter
        ]);
    }
}
