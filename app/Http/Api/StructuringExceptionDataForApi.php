<?php
/**
 * User: zjkiza
 * Date: 5/16/19
 * Time: 1:25 PM
 */

namespace App\Http\Api;

class StructuringExceptionDataForApi
{
    private $error;

    private $code;

    /**
     * StructuringDataForApi constructor.
     *
     * @param $error
     * @param $code
     */
    public function __construct($error, $code)
    {
        $this->error = $error;
        $this->code = $code;
    }

    /**
     * @return array
     */
    public function getStructuringDataForApi():array
    {
        return [
            'error' => $this->error,
            'code' => $this->code,
        ];
    }
}