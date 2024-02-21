<?php

namespace App\Http\Requests;

use App\Exceptions\BaseResponseError;
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
        $details = collect([
            'rules' => $this->mappedRules(),
            'error' => $validator->getMessageBag()
        ]);
        $errors = $this->mappedErros($errors);

        throw new HttpResponseException(BaseResponseError::httpBadRequest($errors, $details));
    }

    private function mappedRules(): Collection
    {
        return collect($this->rules())->map(function ($rule) {
            if (gettype($rule) !== 'array'):
                return explode( '|', $rule);
            endif;

            foreach ($rule as $i => $subRule):
                if (gettype($subRule) === 'object'):
                    $rule[$i] = get_class($subRule);
                endif;
            endforeach;
            return $rule;
        });
    }

    private function mappedErros(Collection $errors): Collection
    {
        $errorsArray = [];
        foreach ($errors as $key => $error):
            $matches = [];
            if (preg_match('/(\w+)\.(\d)+/', $key, $matches)):
                $newKey = $matches[1] . "[" . $matches[2] . "]";
                $errorsArray[$newKey] = $error;
            else:
                $errorsArray[$key] = $error;
            endif;
        endforeach;
        return collect($errorsArray);
    }
}
