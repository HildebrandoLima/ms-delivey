<?php

namespace App\Http\Requests;

use App\Exceptions\HttpBadRequest;
use App\Exceptions\HttpConflict;
use App\Exceptions\HttpNotFound;
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
        $errors = $this->getErrors($validator);
        $details = $this->getDetails($validator);

        foreach ($this->createResponseError() as $response) {
            if ($response['condition']($errors)) {
                throw new HttpResponseException($response['response']::getResponse($errors, $details));
            }
        }

        throw new HttpResponseException(HttpBadRequest::getResponse($errors, $details));
    }

    private function getErrors(Validator $validator): Collection
    {
        return collect($validator->errors()->toArray())
            ->map(fn(array $error): string => count($error) === 0 ? '' : $error[0]);
    }

    private function getDetails(Validator $validator): Collection
    {
        return collect([
            'rules' => $this->mappedRules(),
            'error' => $validator->getMessageBag()
        ]);
    }

    private function mappedRules(): Collection
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

    private function createResponseError(): array
    {
        return [
            [
                'condition' => fn($errors) => $this->hasError($errors, DefaultErrorMessages::ALREADY_EXISTING),
                'response' => HttpConflict::class,
            ],
            [
                'condition' => fn($errors) => $this->hasError($errors, DefaultErrorMessages::NOT_FOUND),
                'response' => HttpNotFound::class,
            ],
        ];
    }

    private function hasError($errors, $errorMessage): bool
    {
        return $errors->contains(fn($error) => str_contains($error, $errorMessage));
    }
}
