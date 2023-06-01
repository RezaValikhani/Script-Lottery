<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

$Host = "localhost";
$dataBase = "..."; // DataBase UserName
$userName = "..."; // DataBase UserName
$Password = "..."; // DataBase PassWord
$setName = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

try{
    $connect = new PDO("mysql:host=$Host;dbname=$dataBase",$userName,$Password,$setName);
//  echo 'با موفقیت به دیتابیس متصل شدید...';
}catch(PDOException $error) {
    echo 'خطا در اتصال به دیتابیس'. $error->getmessage();
}

$tbl_info = "zx_info";
$tbl_admin = "zx_admin";
$tbl_winner = "zx_winner";
