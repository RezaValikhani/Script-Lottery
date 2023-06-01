<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

include "../init.php";

$id = $_POST["IdUser"];
$name = $_POST["NameUser"];
$phone = $_POST["PhoneUser"];

if(isset($_POST["BtnDeleteUser"]))
{
    DeleteUser($id);
    header("location:index.php");
    exit;
}

if(isset($_POST["mmd1"]))
{
    UpdateStatusPay($id);
    header("location:index.php");
    exit;
}

if(isset($_POST["mmd0"]))
{
    UpdateStatusPayTo0($id);
    header("location:index.php");
    exit;
}
if(isset($_POST["BtnDeleteWinner"]))
{
    DeleteWinner($id);
    header("location:winner.php");
    exit;
}
if(isset($_POST["BtnResetLottery"]))
{
    ResetLottery();
    ResetStatusWin();
    header("location:index.php");
    exit;
}
else
{
    header("location:../index.php");
    exit;
}