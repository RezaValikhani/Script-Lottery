<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */


//* اطلاعات تکمیلی *//

$Domain = "https://namesite.ir/lottery"; // host domain
$lotteryname = "قرعه کشی"; // lottery name
$adminname = "رضا ولی خانی"; // admin name
$idtel = ""; // id tel
$idinsta = ""; // id insta
$adminid = "";  // id admin
$limit = "200"; // empty or count
$SmsUser = ""; // ip panel user
$SmsPass = ""; // ip panel password
$SmsFrom = ""; // ip panel from



//* درگاه پرداخت *//

$Amount = ""; // empty or Amount
$whatpay = 'zarinpal'; // zarinpal or idpay or nextpay
$MerchantID = ""; // zarinpal merchant or empty
$idpaykey = ""; // idpay merchant or empty
$nextpaykey = ""; // nextpay merchant or empty