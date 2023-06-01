<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

error_reporting(0);
session_start();

include "config.php";
include "actions/User.php";
include "info.php";
include "functions.php";
include "actions/jdf.php";
include "actions/idpay.php";
include "actions/NextPay.php";
include "actions/Pay.php";
include "actions/Admin.php";