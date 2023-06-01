<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

function SaniTize($value)
{
    $level1 = trim($value);
    $level2 = strip_tags($level1);
    return $level2;
}

function SendPm($Message ,$Number ,$SmsUser ,$SmsPass ,$SmsFrom)
{
    $url = "https://ippanel.com/services.jspd";
	$param = array
	(
		'uname'=> $SmsUser,
		'pass'=> $SmsPass,
		'from'=> $SmsFrom,
		'message'=> $Message,
		'to'=> $Number,
		'op'=>'send'
	);
	$handler = curl_init($url);             
	curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($handler, CURLOPT_POSTFIELDS, $param);                      
	curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
	$response2 = curl_exec($handler);
	$response2 = json_decode($response2);
	$res_code = $response2[0];
	$res_data = $response2[1];
	return $res_data;
}

function GetIP($IP)
{   
    $ch = curl_init('https://api.ipgeolocationapi.com/geolocate/'.$IP.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($json, true);
    return $result;
}

function CreateIdLottery($phone)
{
$v1 = sha1($phone); 
$v2 = substr($v1, 1, 11);
return $v2;
}

function PhoneSunSor($phone)
{
    $v1 = substr($phone, 0, 4);
    $v3 = substr($phone, 7, 11);
    return $v3." ### ".$v1;
}

