<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

include "init.php";

if($_GET["whatpay"]  == 'zarinpal')
{
$Authority = $_GET['Authority'];
if ($_GET['Status'] == 'OK') {

$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentVerification(
[
'MerchantID' => $MerchantID,
'Authority' => $Authority,
'Amount' => $Amount,
]
);

if ($result->Status == 100)
{
    UpdateStatusPayPay($_COOKIE["phone22"]);
    setcookie("okpay","$Authority",time() + (1 * 1));
    header("location:check.php");
    exit;
} else
{
    setcookie("nopay","$Authority",time() + (1 * 1));
    header("location:check.php");
    exit;
}
} else
{
    setcookie("nopay","$Authority",time() + (1 * 1));
    header("location:check.php");
    exit;
}
}

if($_GET["whatpay"] == 'idpay')
{
$merchant = "$idpaykey";
$idpay = new IDPay($merchant);
if($_POST["status"] == 10){
	
	$data = array(
		"id" => $_POST["id"],
		"order_id" => $_POST["order_id"]
	);
	
	$check = $idpay->inquiry($data);
	if($check->amount == $_POST["amount"]){
	$result = $idpay->verify($data);
	if($result->status == 100)
	{
	UpdateStatusPayPay($_COOKIE["phone22"]);
    setcookie("okpay","okpay",time() + (1 * 1));
 	header("location:check.php");
 	exit;
}
else
{
    setcookie("nopay","nopay",time() + (1 * 1));
 	header("location:check.php");
 	exit;
}
}
else
{
    setcookie("nopay","nopay",time() + (1 * 1));
 	header("location:check.php");
 	exit;
}
}
else
{
    setcookie("nopay","nopay",time() + (2 * 2));
 	header("location:check.php");
 	exit;
}
}


if($_GET["whatpay"]  == 'nextpay')
{
$nextpay = new Nextpay_Payment();
$trans_id = isset($_POST['trans_id']) ? $_POST['trans_id'] : false ;
$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : false ;
$amount = $_GET['amount'];
$user = $_GET['id'];
if (!is_string($trans_id) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $trans_id) !== 1)) {
//     $message = ' شماره خطا: -34 <br />';
//     $message .='<br>'.$nextpay->code_error(intval(-34));
//     echo $message;
//     exit();
    setcookie("nopay","nopay",time() + (1 * 1));
 	header("location:check.php");
 	exit;
}
$parameters = array
(
    'api_key'	=> $nextpaykey,
    'order_id'	=> $order_id,
    'trans_id' 	=> $trans_id,
    'amount'	=> $Amount
);
try {
    $result = $nextpay->verify_request($parameters);
    if( $result < 0 )
    {
// 	$message ='<br>پرداخت موفق نبوده است';
// 	$message .='<br>شماره تراکنش : <span>' . $trans_id .'</span><br>';
// 	$message = ' شماره خطا: ' . $result . ' <br />';
// 	$message .='<br>'.$nextpay->code_error(intval($result));
// 	echo $message;
// 	exit();
    setcookie("nopay","nopay",time() + (1 * 1));
 	header("location:check.php");
 	exit;
    }
    if($result == 0)
    {
// 	$message ='<br>پرداخت موفق است';
// 	$message .='<br>شماره تراکنش : <span>' . $trans_id .'</span><br>';
// 	$message .='<br>شماره پیگیری : <span>' . $order_id .'</span><br>';
// 	$message .='<br>مبلغ : ' . $price .'<br>';
// 	echo $message;
    UpdateStatusPayPay($_COOKIE["phone22"]);
    setcookie("okpay","okpay",time() + (1 * 1));
 	header("location:check.php");
 	exit;
    }
    else
    {
// 	$message ='<br>پرداخت موفق نبوده است';
// 	$message .='<br>شماره تراکنش : ' . $trans_id .'<br>';
// 	echo $message;
    setcookie("nopay","nopay",time() + (1 * 1));
 	header("location:check.php");
 	exit;
    }
}
catch (Exception $e)
{
    // echo 'Error'. $e->getMessage();
    setcookie("nopay","nopay",time() + (1 * 1));
 	header("location:check.php");
 	exit;
}
}