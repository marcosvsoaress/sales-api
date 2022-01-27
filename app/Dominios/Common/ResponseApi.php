<?php

namespace App\Dominios\Common;

class ResponseApi
{
    /**
     * Standard json response
     *
     * @param string $message
     * @param array $data
     * @param bool $sucess
     * @return array
     */
    public static function responseJson($message = '', $data = [], $sucess = true): array
    {
        return [
            'success' => $sucess,
            'message' => $message,
            'data' => $data
        ];
    }

    /**
     * Standard json error response
     *
     * @param string $message
     * @return array
     */
    public static function errorResponseJson($message = ''): array
    {
        return self::responseJson($message, false);
    }
}
