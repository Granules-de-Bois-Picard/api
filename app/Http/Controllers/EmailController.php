<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\EmailSendRequest;
use App\Interfaces\EmailRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    private EmailRepositoryInterface $emailRepository;
    public function __construct(EmailRepositoryInterface $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    public function send(EmailSendRequest $request): JsonResponse
    {
        try {
            $this->emailRepository->send($request);
            return ApiResponseClass::sendResponse([],'Email sent successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}
