<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

function GetPayZarin($MerchantID ,$Amount ,$Description ,$Mobile ,$CallbackURL)
{

$Email = "mohammad.aghlmand95@gmail.com";    

$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

$result = $client->PaymentRequest(
[
'MerchantID' => $MerchantID,
'Amount' => $Amount,
'Description' => $Description,
'Email' => $Email,
'Mobile' => $Mobile,
'CallbackURL' => $CallbackURL,
]
);

if ($result->Status == 100)
{
Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/Bpm');
}
else
{
echo'ERROR: '.$result->Status;
}
}

function GetPayIDPay($idpaykey, $OrderId, $Price, $Name, $Phone, $Desc, $Url)
{
    $idpay = new IDPay("$idpaykey");
    $data = array(
    "order_id" => $OrderId,
    "amount" => $Price."0",
    "name" => "$Name",
    "phone" => "$Phone",
    "mail" => "",
    "desc" => "$Desc", 
    "callback" => "$Url",
    "reseller" => null
    );
    $gateway = $idpay->create($data);
    $id = $gateway->id;
    $url = $gateway->link;
    if(!empty($url))
    {
    header("location: $url");
    }
    else
    {
    echo "<p dir='rtl'>{$gateway->error_message}</p>";
    }
}

function GetPayNextPay($nextpaykey, $Amount, $Url, $OrderId)
{
    $parameters = array(
        'api_key' 	=> $nextpaykey,
        'amount' 	=> $Amount,
        'callback_uri' 	=> $Url,
        'order_id' 	=> $OrderId
    );

    try {
        $nextpay = new Nextpay_Payment($parameters);
        $nextpay->setDefaultVerify(Type_Verify::SoapClient);
        $result = $nextpay->token();
        if(intval($result->code) == -1){
        return $nextpay->request_http."/{$result->trans_id}";
        }
        else
        {
            $message = ' شماره خطا: '.$result->code.'<br />';
            $message .='<br>'.$nextpay->code_error(intval($result->code));
            echo $message;
            exit();
        }
    }catch (Exception $e) { echo 'Error'. $e->getMessage();  }
}