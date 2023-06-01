<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

include "init.php";

$name = $_POST["name"];
$phone = $_POST["phone"];
$code = $_POST["code"];
$token = $_POST["token"];
$idlottery = CreateIdLottery($phone);
$verifycode = rand(11111,99999);
$checkinfo = $connect->query("SELECT `phone` FROM $tbl_info WHERE phone='$phone'");
$sal = jdate('Y');
$mah = jdate('F');
$rooz = jdate('j');
$saat = jdate('H');
$dagigeh = jdate('i');
$sanyeh = jdate('s');
$Date = $rooz." ".$mah." ".$sal . " | " .$sanyeh." : ".$dagigeh." : ".$saat;

if(isset($_POST["submitSendCode"]))
{
    if($token !== $_SESSION["Token"])
    {
        setcookie("ErrorToken","خطای نامشخصی رخ داده !",time() + (1 * 1));
        header("location:index.php");
        exit;
    }
    
    if(empty($name) || empty($phone))
    {
        setcookie("Empty","همه فیلد ها باید پر باشند !",time() + (1 * 1));
        header("location:index.php");
        exit;
    }
    
    if(!is_numeric($phone) || !preg_match('#^09(\d){9}#', $phone))
    {
       setcookie("ErrorPhone","شماره موبایل را درست وارد کنید !",time() + (1 * 1));
       header("location:index.php");
       exit;
    }
    
    if($checkinfo->rowCount() >= 1)
    {
       setcookie("SingIning","$phone",time() + (86400 * 7));
       setcookie("OkSignIn","با موفقیت وارد شدید !",time() + (1 * 1));
       header("location:index.php");
       exit; 
    }
    
    else
    {
        $_SESSION["verifycode"] = $verifycode;
        $Message = "سلام دوست عزیز
به قرعه کشی $lotteryname خوش آمدید !
کد تایید شما : $verifycode
موفق و پیروز باشید !";
        SendPm($Message ,$phone ,$SmsUser ,$SmsPass ,$SmsFrom);
        setcookie("name","$name",time() + (1 * 1));
        setcookie("phone","$phone",time() + (1 * 1));
        setcookie("NextVison","NextVison",time() + (1 * 1));
        setcookie("OkSendOTP","لطفا کد ارسالی را وارد کنید !",time() + (1 * 1));
        header("location:index.php");
        exit; 
    }
}

if(isset($_POST["submitSignUp"]))
{
    if($token !== $_SESSION["Token"])
    {
        setcookie("name","$name",time() + (1 * 1));
        setcookie("phone","$phone",time() + (1 * 1));
        setcookie("ErrorToken","خطای نامشخصی رخ داده !",time() + (1 * 1));
        setcookie("NextVison","NextVison",time() + (1 * 1));
        header("location:index.php");
        exit;
    }
    
    if(empty($name) || empty($phone) || empty($code))
    {
        setcookie("name","$name",time() + (1 * 1));
        setcookie("phone","$phone",time() + (1 * 1));
        setcookie("Empty","همه فیلد ها باید پر باشند !",time() + (1 * 1));
        setcookie("NextVison","NextVison",time() + (1 * 1));
        header("location:index.php");
        exit;
    }
    
    if(!is_numeric($phone) || !preg_match('#^09(\d){9}#', $phone))
    {
       setcookie("name","$name",time() + (1 * 1));
       setcookie("phone","$phone",time() + (1 * 1));
       setcookie("ErrorPhone","شماره موبایل را درست وارد کنید !",time() + (1 * 1));
       setcookie("NextVison","NextVison",time() + (1 * 1));
       header("location:index.php");
       exit;
    }
    
    else
    {
        if($code == $_SESSION["verifycode"])
        {
            CreateUser($name, $phone, $idlottery, $Date, $code);
            setcookie("SingIning","$phone",time() + (86400 * 7));
            setcookie("OkSignUp","شما با موفقیت ثبت نام کردید !",time() + (1 * 1));
            header("location:index.php");
            exit;  
        }
        else
        {
            setcookie("name","$name",time() + (1 * 1));
            setcookie("phone","$phone",time() + (1 * 1));
            setcookie("ErrorCode","کد نادرست است !",time() + (1 * 1));
            setcookie("NextVison","NextVison",time() + (1 * 1));
            header("location:index.php");
            exit;
        }
    }
}

if(isset($_POST["SendPay"]))
{
    if($limit !== "")
    {
    $FindUserPaying = null;
    $FindUserPaying = FindUserPaying();
    if($FindUserPaying)
    {
    if($FindUserPaying->rowCount() >= $limit)
    {
        setcookie("errorlimit","ظرفیت شرکت کننده ها پر شده است !",time() + (1 * 1));
        header("location:index.php");
        exit;
    }
    else
    {
    }
    }
    }
    if($Amount !== "")
    {
    setcookie("phone22","$phone",time() + (1000 * 1));
    if($whatpay == 'zarinpal')
    {
        GetPayZarin($MerchantID ,$Amount ,'خرید بلیط' ,$phone ,"$Domain/result.php?whatpay=zarinpal");
    }
    if($whatpay == 'idpay')
    {
        $OrderId = rand(1111111111,999999999);
        GetPayIDPay($idpaykey ,$OrderId ,$Amount ,$name ,$phone ,'خرید بلیط'  ,"$Domain/result.php?whatpay=idpay");
    }
    if($whatpay == 'nextpay')
    {
        $OrderId = rand(1111111111,999999999);
        GetPayNextPay($nextpaykey ,$Amount ,'خرید بلیط' ,$phone ,"$Domain/result.php?whatpay=nextpay", $OrderId);
    }
    exit;
    }
    else
    {
    UpdateStatusPayPay($_POST["phone"]);
    setcookie("okpaypart2","ثبت با موفقیت انجام شد !",time() + (1 * 1));
    header("location:index.php");
    exit; 
    }
}

if(isset($_COOKIE["okpay"]))
{
    UpdateStatusPayPay($_COOKIE["phone22"]);
    setcookie("okpaypart2","پرداخت با موفقیت انجام شد !",time() + (1 * 1));
    header("location:index.php");
    exit; 
}

if(isset($_COOKIE["nopay"]))
{
    $okpay = $_COOKIE["okpay"];
    setcookie("nopaypart2","پرداخت با موفقیت انجام نشد !",time() + (1 * 1));
    header("location:index.php");
    exit; 
}

if(isset($_POST["BtnRequestLogin"]))
{
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $checkinfoadmin = $connect->query("SELECT `email` FROM $tbl_admin WHERE email='$email'");
    $checkinfoadmin2 = $connect->query("SELECT `password` FROM $tbl_admin WHERE password='$password'");
    
    if(empty($email) || empty($password))
    {
        setcookie("empty","همه فیلد ها باید پر باشند !",time() + (1 * 1));
        header("location:login.php");
        exit;
    }
    if($checkinfoadmin->rowCount() >= 1 && $checkinfoadmin2->rowCount() >= 1)
    {
       $_SESSION["LoginAdmin"] = 'aqswdefrgt1t5yh13ujscsu9ssfvsrscsgwyrerwe';
       $_SESSION["email"] = $email;
       header("location:admin");
       exit; 
    }
    else
    {
       setcookie("NoSingIningAdmin","اطلاعات داده شده نادرست است !",time() + (1 * 1));
       header("location:login.php");
       exit; 
    }
}
if(isset($_POST["BtnGetLottery"]))
{
    setcookie("GetStartLottery","قرعه کشی با موفقیت انجام شده !",time() + (1 * 1));
       header("location:lottery.php");
       exit; 
}
else
{
    header("location:index.php");
    exit;
}


