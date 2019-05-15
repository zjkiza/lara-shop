<?php
/**
 * User: zjkiza
 * Date: 5/15/19
 * Time: 8:03 PM
 */

namespace App\Http\Api;

class StructuringDataForApi
{
    private $message;

    private $data;

    private $success;

    /**
     * StructuringDataForApi constructor.
     *
     * @param $success
     * @param $data
     * @param $message
     */
    public function __construct($success, $data, $message)
    {
        $this->success = $success;
        $this->data = $data;
        $this->message = $message;
    }

    public function getStructuringDataForApi():array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}