<?php

namespace App\Interfaces;

use App\Http\Requests\EmailSendRequest;

interface EmailRepositoryInterface
{
    public function send(EmailSendRequest $request);
}
