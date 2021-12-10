<?php

namespace App\Http\Controllers;


use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send()
    {
        $detail = [
          'title' => 'Test Email from Laravel',
            'body' => 'Test Body '
        ];

        Mail::to("aprilanjanettenacario@gmail.com")->send(new TestMail($detail));
        return "Email sent!";
    }
}
