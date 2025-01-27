<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * @property mixed $title
 * @property mixed $short_description
 * @property mixed $thumbnail
 * @property mixed $content
 * @property mixed $is_published
 */
class EmailSendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'from' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'full_name' => 'required|string|max:255',
            'recaptchaToken' => ['required', function ($attribute, $value, $fail) {
                if (!$this->checkRecaptchaToken($value)) {
                    $fail('The recaptcha token is invalid.');
                }
            }],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function checkRecaptchaToken($token): bool
    {
        $recaptcha_secret = config('google.recaptcha.key');
        $url = config('google.recaptcha.url');

        $data = [
            'secret'   => $recaptcha_secret,
            'response' => $token
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        try {
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);

            if ($response === false) {
                return false;
            }

            $result = json_decode($response);

            return $result->success ?? false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
