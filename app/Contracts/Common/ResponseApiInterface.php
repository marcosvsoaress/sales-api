<?php

namespace App\Contracts\Common;


interface ResponseApiInterface
{
    /**
     * Creates a response Formated to be sending to the client
     *
     * @return mixed
     */
    public function toResponse();

    /**
     * Standard json response
     *
     * @param string $message
     * @param array $data
     * @param bool $sucess
     * @return array
     */
    public static function responseJson($message = '', $data = [], $sucess = true) : array;

    /**
     * Standard json error response
     *
     * @param string $message
     * @return array
     */
    public static function errorResponseJson($message = '') : array;
}
