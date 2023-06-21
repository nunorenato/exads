<?php

namespace App;

class Response
{
    /**
     * Util method to print json encoded data
     *
     * @param $data
     * @param int $status
     * @return void
     */
    public static function sendJson($data, int $status):void{
        header("HTTP/1.1 ".$status);

        echo json_encode($data);
    }
}