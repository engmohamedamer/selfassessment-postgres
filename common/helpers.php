<?php
/**
 * Yii2 Shortcuts
 * @author Eugene Terentev <eugene@terentev.net>
 * -----
 * This file is just an example and a place where you can add your own shortcuts,
 * it doesn't pretend to be a full list of available possibilities
 * -----
 */

/**
 * @return int|string
 */
function getMyId()
{
    return Yii::$app->user->getId();
}

/**
 * @param string $view
 * @param array $params
 * @return string
 */
function render($view, $params = [])
{
    return Yii::$app->controller->render($view, $params);
}

/**
 * @param $url
 * @param int $statusCode
 * @return \yii\web\Response
 */
function redirect($url, $statusCode = 302)
{
    return Yii::$app->controller->redirect($url, $statusCode);
}

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function env($key, $default = null)
{

    $value = getenv($key) ?? $_ENV[$key] ?? $_SERVER[$key];

    if ($value === false) {
        return $default;
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;

        case 'false':
        case '(false)':
            return false;
    }

    return $value;
}

function myArabicDate($date){
    // PHP Arabic Date

    $months = array(
        "Jan" => "يناير",
        "Feb" => "فبراير",
        "Mar" => "مارس",
        "Apr" => "أبريل",
        "May" => "مايو",
        "Jun" => "يونيو",
        "Jul" => "يوليو",
        "Aug" => "أغسطس",
        "Sep" => "سبتمبر",
        "Oct" => "أكتوبر",
        "Nov" => "نوفمبر",
        "Dec" => "ديسمبر"
    );

    $sentDate = new \DateTime();
    $sentDate->setTimestamp($date);

    $ymdNow = $sentDate->format('y-m-d');


    $your_date =  $ymdNow; // $date; //the date to convers (y-m-d)

    $en_month = date("M", strtotime($your_date));

    foreach ($months as $en => $ar) {
        if ($en == $en_month) {
            $ar_month = $ar;
        }
    }

    $find = array (

        "Sat",
        "Sun",
        "Mon",
        "Tue",
        "Wed" ,
        "Thu",
        "Fri"

    );

    $replace = array (

        "السبت",
        "الأحد",
        "الإثنين",
        "الثلاثاء",
        "الأربعاء",
        "الخميس",
        "الجمعة"

    );

    $ar_day_format = date('D',strtotime($your_date)); // The Current Day

    $ar_day = str_replace($find, $replace, $ar_day_format);


    header('Content-Type: text/html; charset=utf-8');
    $standard = array("0","1","2","3","4","5","6","7","8","9");
    $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
    $current_date = $ar_day.' '.date('d',strtotime($your_date)).' / '.$ar_month.' / '.date('Y');     //الخميس ٢٨ / مايو / ٢٠١٥
    $modifiedFormat= date('d',strtotime($your_date)).' '.$ar_month;

    $arabic_date = str_replace($standard , $eastern_arabic_symbols , $modifiedFormat);

    // Echo Out the Date
    return  $arabic_date;

}

//conver number to english
function myConvertNumbers($input)
{
    $unicode = array('۰', '۱', '۲', '۳', '٤', '٥', '٦', '۷', '۸', '۹');
    $english = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    $string = str_replace($unicode, $english , $input);

    return $string;
}

function myToArabicNumbers($input)
{
    $unicode = array('۰', '۱', '۲', '۳', '٤', '٥', '٦', '۷', '۸', '۹');
    $english = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    $string = str_replace($english,$unicode , $input);

    return $string;
}




function myClearPhone($phone){
    //check all is english numbers
    $phone = myConvertNumbers($phone);
    //remove country code
    $phone=  str_replace("+966","",$phone);
    $phone=  str_replace("00966","",$phone);
    $phone=  str_replace("966","",$phone);
    $phone=  intval($phone);

    return $phone ;
}

