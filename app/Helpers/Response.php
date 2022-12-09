<?php

namespace App\Helpers;


class Response
{
    public static function responseHelper($action, $data, $isError, $msg)
    {
        if ($isError) {
            return [
                'action' => $action,
                'message' => 'error',
                'data' => $data,
                'error' => $msg
            ];
        }
        return [
            'action' => $action,
            'message' => $msg,
            'data' => $data,
            'error' => null
        ];
    }

    public static function setFlashData($action, $data, $isError, $msg)
    {
        $session = session();
        $status = 'success';
        if ($isError) {
            $status = 'error';
        }

        $setOfFlashData = [
            'action' => $action,
            'status' => $status,
            'message' => $msg,
            'data' => $data,
        ];
        foreach ($setOfFlashData as $k => $v) {
            $session->setFlashdata($k, $v);
        }
    }
}
