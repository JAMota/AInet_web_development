<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ComfirmacaoMail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from when.no.laravel@gmail.com',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('when.no.laravel@gmail.com')->send(new ComfirmacaoMail($mailData));

        dd("Email is sent successfully.");
    }
}
