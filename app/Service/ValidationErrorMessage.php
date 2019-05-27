<?php
/**
 * User: zjkiza
 * Date: 5/22/19
 * Time: 9:31 AM
 */

namespace App\Service;

class ValidationErrorMessage
{
    /**
     * @param array $requestParameters
     * @param string $parameters
     * @return string
     */
    public function getValidationErrorMessage(
        array $requestParameters,
        string $parameters = ''
    ): string
    {
        foreach ($requestParameters as $key => $errors) {
            $parameters .= $this->getErrors($errors, $key);
        }

        return $parameters;
    }

    /**
     * @param array $errors
     * @param string $variable
     * @param string $errorMessage
     * @return string
     */
    public function getErrors(
        array $errors,
        string $variable,
        string $errorMessage = ''
    ): string
    {
        foreach ($errors as $error) {
            $errorMessage .= $error;
        }

        return sprintf('%s - %s ', $variable, $errorMessage);
    }
}
