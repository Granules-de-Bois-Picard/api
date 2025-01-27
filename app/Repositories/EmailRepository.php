<?php

namespace App\Repositories;

use App\Http\Requests\EmailSendRequest;
use App\Interfaces\EmailRepositoryInterface;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class EmailRepository implements EmailRepositoryInterface
{
    private string $to;
    public function __construct()
    {
        $this->to = config('mail.from.address');
    }

    public function send(EmailSendRequest $request): void
    {
        $data = $request->validated();

        $emailData = [
            'title' => $data['subject'],
            'from' => $data['from'],
            'body' => $data['body'],
            'full_name' => $data['full_name'],
        ];

        Mail::to($this->to)->send(new ContactMail($emailData));
    }
}
