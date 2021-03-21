<?php
namespace App\Http\Helper;


class ResponseHelper{

    public static function result( $intStatus = "", $strMessage="", $strData="" ) {

        return response([
            "success" => $intStatus,
            "Message" => $strMessage,
            "data" => $strData
        ], $intStatus, ['Content-Type' => 'Application/Json']);
    }

}

?>