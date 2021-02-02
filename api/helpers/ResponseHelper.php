<?php
namespace  api\helpers;

use Yii;

class ResponseHelper {



    public static function sendFailedResponse($message,$code=401)
    {
        Yii::$app->response->setStatusCode($code);
        return [ 'success' => false, 'status' => $code, 'errors' => $message];
    }

//    public static function sendSuccessResponse($data = false)
//    {
//        Yii::$app->response->setStatusCode(200);
//        $response = [];
//        $response['success'] = true;
//        $response['status'] = 200;
//        if($data) $response['data'] = $data;
//        return  $response;
//    }




    public static function sendSuccessResponse($data = false ,$code= 200 ,$location= false )
    {
       Yii::$app->response->setStatusCode($code);
        $response = [];
        $response['success'] = true;
        $response['status'] = $code;
        if($data) $response['data'] = $data;
        return  $response;
    }


    public static function customResponseError($errors)
    {
        $data = [];
        foreach ($errors as $key => $value) {
            $data[$key] = str_replace('"', ' ', $value[0]);
        }
        return $data;
    }

}


?>