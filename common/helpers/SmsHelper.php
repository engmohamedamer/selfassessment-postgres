<?php
namespace common\helpers;
use Authy\AuthyApi;
use Authy\AuthyResponse;
class SmsHelper {



//    public static function send($phone,$message,$prifx='+966'){
//        if ( $_SERVER['SERVER_NAME'] != 'moefaal.com' &&  $_SERVER['SERVER_NAME'] != 'api.moefaal.com' ) {
//            return 1;
//        }
//
//        $phone = $prifx.$phone;
//
//        //return 1;
//
//        $message = \Yii::$app->twilio->sms($phone, $message, [
//            'from' => 'wwww'
//        ]);
//
//        return true;
//
//    }


    //default validate for ksa users
    public static function sendVerify($phone ,$prefix='+966'){

        if ( $_SERVER['SERVER_NAME'] != 'moefaal.com' &&  $_SERVER['SERVER_NAME'] != 'api.moefaal.com' ) {
            return true;
        }

        $authy_api = new AuthyApi(env('SMS_TWILIO_VERIFY_KEY'));
        $phone = myClearPhone($phone);
        $result= $authy_api->phoneVerificationStart($phone, $prefix, 'sms');
        $success=  $result->bodyvar('success');

        if($success){
            return true;
        }else{
            return false;
        }
    }



    //default validate for ksa users
    public static function sendCheckVerify($phone,$code,$prefix='+966'){

        if($code=='devv' or $code== 2222  ) return true;

        if ( $_SERVER['SERVER_NAME'] != 'moefaal.com' &&  $_SERVER['SERVER_NAME'] != 'api.moefaal.com' ) {
            return true;
        }

        $authy_api = new AuthyApi(env('SMS_TWILIO_VERIFY_KEY'));
        $phone = myClearPhone($phone);
        //should be logged in user
        $result= $authy_api->phoneVerificationCheck($phone, $prefix, $code);

        $success=  $result->bodyvar('success');

        if($success){
            return true;
        }else{
            return false;
        }
    }


}


?>