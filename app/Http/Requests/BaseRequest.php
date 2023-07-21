<?php

namespace App\Http\Requests;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): Response
    {
        $errors = collect($validator->errors()->toArray())
            ->map(fn(array $error): string => count($error) === 0 ? '' : $error[0]);
        $details = [
            'rules' => $this->mappedRules(),
            'error' => $validator->getMessageBag()
        ];

        throw new HttpResponseException
        (
            response()->json([
                "message" => DefaultErrorMessages::VALIDATION_FAILURE,
                "data" => $this->mappedErros($errors),
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => $details
            ], Response::HTTP_BAD_REQUEST)
        );
    }

    private function mappedRules()
    {
        return collect($this->rules())->map(function ($rule) {
            if (gettype($rule) !== 'array') {
                return explode( '|', $rule);
            }
            foreach ($rule as $i => $subRule) {
                if (gettype($subRule) === 'object') {
                    $rule[$i] = get_class($subRule);
                }
            }
            return $rule;
        });
    }

    private function mappedErros(Collection $errors): array
    {
        $errorsArray = [];
        foreach ($errors as $key => $error) {
            $matches = [];
            if (preg_match('/(\w+)\.(\d)+/', $key, $matches)) {
                $newKey = $matches[1] . "[" . $matches[2] . "]";
                $errorsArray[$newKey] = $error;
            } else {
                $errorsArray[$key] = $error;
            }
        }
        return $errorsArray;
    }
}
