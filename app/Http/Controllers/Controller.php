<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Fitur Super Canggih: Format Response API Otomatis
     * Ini membuat balasan dari server selalu konsisten dan elegan.
     */
    protected function sendResponse($data, $message = 'Success', $code = 200)
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'status'  => 'error',
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
