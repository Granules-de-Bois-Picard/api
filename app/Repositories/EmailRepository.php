<?php

namespace App\Repositories;

use App\Http\Requests\EmailSendRequest;
use App\Interfaces\EmailRepositoryInterface;
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

        Mail::send([], [], function ($message) use ($data, $emailData) {
            $message->to($data['to'])
                ->subject($emailData['subject'])
                ->setBody($emailData['body'], 'text/html');
        });
    }
}
