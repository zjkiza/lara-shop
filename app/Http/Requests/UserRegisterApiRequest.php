<?php

namespace App\Http\Requests;

use App\Exceptions\ApiUserRegisterException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $error = $validator->errors()->getMessages();
            if ($error) {
                throw new ApiUserRegisterException(
                    sprintf('Required parameter missing : %s', $this->getParameter($error))
                );
            }
        });
    }

    /**
     * @param array $requestParameters
     * @return string
     */
    private function getParameter(array $requestParameters): string
    {
        $parameters = '';

        foreach (array_keys($requestParameters) as $requestParameter) {
            $parameters .= $requestParameter . ', ';
        }

        return $parameters;
    }
}
