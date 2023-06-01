<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

session_start();
$_SESSION["LoginAdmin"] = null; 
$_SESSION["email"] = null; 
setcookie("SingIning","",time() - (86400 * 7));
header("location:index.php");
exit;