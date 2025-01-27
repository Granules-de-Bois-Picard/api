<?php

namespace App\Repositories;

use App\Http\Requests\EmailSendRequest;
use App\Interfaces\EmailRepositoryInterface;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class EmailRepository implements EmailRepositoryInterface
{
    public function send(EmailSendRequest $request): void
    {
        $data = $request->validated();

        $emailData = [
            'subject' => $data['subject'],
            'body' => $data['body']
        ];

        Mail::to($data['to'])->send(new ContactMail($emailData));
    }
}
