<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

 /*
 * Created by NextPay.ir
 * author: Nextpay Company
 * ID: @nextpay
 * Date: 09/22/2016
 * Time: 5:05 PM
 * Website: NextPay.ir
 * Email: info@nextpay.ir
 * @copyright 2016
 * @package NextPay_Gateway
 * @version 1.0
 * @UPDate
 */
 
class Nextpay_Payment
{
    //----- payment properties
    public $api_key = "";
    public $order_id = "";
    public $amount = 0;
    public $trans_id = "";
    public $params = array();
    public $server_soap = "https://api.nextpay.org/gateway/token.wsdl";
    //public $server_soap = "https://api.nextpay.org/gateway/token?wsdl";
    public $server_http = "https://api.nextpay.org/gateway/token.http";
    public $request_http = "https://api.nextpay.org/gateway/payment";
    public $request_verify_soap = "https://api.nextpay.org/gateway/verify.wsdl";
    //public $request_verify_soap = "https://api.nextpay.org/gateway/verify?wsdl";
    public $request_verify_http = "https://api.nextpay.org/gateway/verify.http";
    public $callback_uri = "http://example.com";
    private $keys_for_verify = array("api_key","order_id","amount","callback_uri");
    private $keys_for_check = array("api_key","order_id","amount","trans_id");

    //----- controller properties
    public $default_verify = Type_Verify::SoapClient;

    /**
     * Nextpay_Payment constructor.
     * @param array|bool $params
     * @param string|bool $api_key
     * @param string|bool $order_id
     * @param string|bool $url
     * @param int|bool $amount
     */
    public function __construct($params=false, $api_key=false, $order_id=false, $amount=false, $url=false)
    {
        $trust = true;
        if(is_array($params))
        {
            foreach ($this->keys_for_verify as $key )
            {
                if(!array_key_exists($key,$params))
                {
                    $error = "<h2>آرایه ارسالی دارای مشکل میباشد.</h2>";
                    $error .= "<h4>نمونه مثال برای آرایه ارسالی.</h4>";
                    $error .= /** @lang text */
                        "<pre>                        
                        array(\"api_key\"=>\"شناسه api\",
                              \"order_id\"=>\"شماره فاکتور\",
                              \"amount\"=>\"مبلغ\",
                              \"callback_uri\"=>\"مسیر باگشت\")

                        </pre>";
                    $trust = false;
                    $this->show_error($error);
                    break;
                }
            }
            if($trust)
            {
                $this->params = $params;
                $this->api_key = $params['api_key'];
                $this->order_id = $params['order_id'];
                $this->amount = $params['amount'];
                $this->callback_uri = $params['callback_uri'];
            }
            else
            {
                $this->show_error("برای مقدارهی پارامتر ها باید بصورت آرایه اقدام نمایید");
                exit("End with Error!!!");
            }
        }
        else
        {
            if($api_key)
                $this->api_key = $api_key;
            //else
            //    $this->show_error("شناسه مربوط به api مقدار دهی نشده است");

            if($order_id)
                $this->order_id = $order_id;
            //else
            //    $this->show_error("شماره فاکتور مقداردهی نشده است");

            if($amount)
                $this->amount = $amount;
            //else
            //    $this->show_error("مبلغ تعیین نشده است");

            if($url)
                $this->callback_uri = $url;
            //else
            //    $this->show_error("مسیر بازگشت تعیین نشده است");

            $this->params = array(
                "api_key"=>$this->api_key,
                "order_id"=>$this->order_id,
                "amount"=>$this->amount,
                "callback_uri"=>$this->callback_uri);
        }
    }

    /**
     * @return string
     * return trans_id
     */
    public function token()
    {
        $res = "";
        switch ($this->default_verify)
        {
            case Type_Verify::SoapClient:
                try
                {
                    $soap_client = new SoapClient($this->server_soap, array('encoding' => 'UTF-8'));
                    $res = $soap_client->TokenGenerator($this->params);

                    $res = $res->TokenGeneratorResult;

                    if ($res != "" && $res != NULL && is_object($res)) {
                        if (intval($res->code) == -1)
                            $this->trans_id = $res->trans_id;
                        /*else
                            $this->code_error($res->code);*/
                    }
                    else
                        $this->show_error("خطا در پاسخ دهی به درخواست با SoapClinet");
                }
                catch(Exception $e){
                    $this->show_error($e->getMessage());
                }
                break;
            case Type_Verify::NuSoap:
                try
                {
                    include_once ("include/nusoap/nusoap.php");

                    $client = new nusoap_client($this->server_soap,'wsdl');

                    $error = $client->getError();

                    if ($error)
                        $this->show_error($error);

                    $res = $client->call('TokenGenerator',array($this->params));

                    if ($client->fault)
                    {
                        echo "<h2>Fault</h2><pre>";
                        print_r ($res);
                        echo "</pre>";
                        exit(0);
                    }
                    else
                    {
                        $error = $client->getError();

                        if ($error)
                            $this->show_error($error);

                        $res = $res['TokenGeneratorResult'];

                        if ($res != "" && $res != NULL && is_array($res)) {
                            if (intval($res['code']) == -1) {
                                $this->trans_id = $res['trans_id'];
                                $res = (object)$res;
                            }/*else
                                $this->code_error($res['code']);*/
                        }
                        else
                            $this->show_error("خطا در پاسخ دهی به درخواست با NuSoap_Client");
                    }
                }
                catch(Exception $e){
                    $this->show_error($e->getMessage());
                }
                break;
            case Type_Verify::Http:
                try
                {
                    if( !$this->cURLcheckBasicFunctions() ) $this->show_error("UNAVAILABLE: cURL Basic Functions");
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $this->server_http);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_POSTFIELDS,
                        "api_key=".$this->api_key."&order_id=".$this->order_id."&amount=".$this->amount."&callback_uri=".$this->callback_uri);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    /** @var int | string $server_output */
                    $res = json_decode(curl_exec ($curl));
                    curl_close ($curl);

                    if ($res != "" && $res != NULL && is_object($res)) {

                        if (intval($res->code) == -1)
                            $this->trans_id = $res->trans_id;
                        /*else
                            $this->code_error($res->code);*/
                    }
                    /*else
                        $this->show_error("خطا در پاسخ دهی به درخواست با Curl");*/
                }
                catch (Exception $e){
                    $this->show_error($e->getMessage());
                }
                break;
            default:
                try
                {
                    $soap_client = new SoapClient($this->server_soap, array('encoding' => 'UTF-8'));
                    $res = $soap_client->TokenGenerator($this->params);

                    $res = $res->TokenGeneratorResult;

                    if ($res != "" && $res != NULL && is_object($res)) {
                        if (intval($res->code) == -1)
                            $this->trans_id = $res->trans_id;
                        /*else
                            $this->code_error($res->code);*/
                    }
                    else
                        $this->show_error("خطا در پاسخ دهی به درخواست با SoapClinet");
                }
                catch(Exception $e){
                    $this->show_error($e->getMessage());
                }
                break;
        }
        return $res;
    }

    /**
     * @param string $trans_id
     */
    public function send($trans_id)
    {
        if(isset($trans_id))
        {
            header_remove();
            ob_clean();
            if (headers_sent()) {
                echo "<script> location.replace(\"".$this->request_http."/$trans_id"."\"); </script>";
            }
            else
            {
                header('Location: '.$this->request_http."/$trans_id");
                exit(0);
            }
        }
        else
            $this->show_error("empty trans_id param send");
    }

    /**
     * @param array|bool $params
     * @param string|bool $api_key
     * @param string|bool $trans_id
     * @param int|bool $amount
     * @param string|bool $order_id
     * @return int|mixed
     */
    public function verify_request($params=false, $api_key=false, $order_id=false, $trans_id=false, $amount=false)
    {
        $res = 0;
        $trust = true;
        if(is_array($params))
        {
            foreach ($this->keys_for_check as $key )
            {
                if(!array_key_exists($key,$params))
                {
                    $error = "<h2>آرایه ارسالی دارای مشکل میباشد.</h2>";
                    $error .= "<h4>نمونه مثال برای آرایه ارسالی.</h4>";
                    $error .= /** @lang text */
                        "<pre>
                            array(\"api_key\"=>\"شناسه api\",
                                  \"order_id\"=>\"شماره فاکتور\",
                                  \"amount\"=>\"مبلغ\",
                                  \"trans_id\"=>\"شماره تراکنش\")

                        </pre>";
                    $trust = false;
                    $this->show_error($error);
                    break;
                }
            }
            if($trust)
            {
                $this->trans_id = $params['trans_id'];
                $this->api_key = $params['api_key'];
                $this->order_id = $params['order_id'];
                $this->amount = $params['amount'];
            }
            else
            {
                $this->show_error("برای مقدارهی پارامتر ها باید بصورت آرایه اقدام نمایید");
                exit("End with Error!!!");
            }
        }

        if($api_key){
            $this->api_key = $api_key;
            $this->params['api_key'] = $api_key;
        }elseif (isset($this->api_key)) {
            $this->params['api_key'] = $this->api_key;
        }
        //else
        //    $this->show_error("شناسه مربوط به api مقدار دهی نشده است");

        if($order_id){
            $this->order_id = $order_id;
            $this->params['order_id'] = $order_id;
        }elseif (isset($this->order_id)){
            $this->params['order_id'] = $this->order_id;
        }
        //else
        //    $this->show_error("شماره فاکتور مقداردهی نشده است");

        if($amount){
            $this->amount = $amount;
            $this->params['amount'] = $amount;
        }elseif (isset($this->amount)){
            $this->params['amount'] = $this->amount;
        }
        //else
        //    $this->show_error("مبلغ تعیین نشده است");

        if($trans_id){
            $this->trans_id = $trans_id;
            $this->params['trans_id'] = $trans_id;
        }elseif (isset($this->trans_id)){
            $this->params['trans_id'] = $this->trans_id;
        }
        //else
        //    $this->show_error("شماره نراکنش تعیین نشده است");


        switch ($this->default_verify)
        {
            case Type_Verify::SoapClient:
                try
                {
                    $soap_client = new SoapClient($this->request_verify_soap, array('encoding' => 'UTF-8'));
                    $res = $soap_client->PaymentVerification($this->params);

                    $res = $res->PaymentVerificationResult;

                    if ($res != "" && $res != NULL && is_object($res)) {
                        $res = $res->code;
                    }
                    else
                        $this->show_error("خطا در پاسخ دهی به درخواست با SoapClinet");
                }
                catch(Exception $e){
                    $this->show_error($e->getMessage());
                }
                break;
            case Type_Verify::NuSoap:
                try
                {
                    include_once ("include/nusoap/nusoap.php");

                    $client = new nusoap_client($this->server_soap,'wsdl');

                    $error = $client->getError();

                    if ($error)
                        $this->show_error($error);

                    $res = $client->call('PaymentVerification',array($this->params));

                    if ($client->fault)
                    {
                        echo "<h2>Fault</h2><pre>";
                        print_r ($res);
                        echo "</pre>";
                        exit(0);
                    }
                    else
                    {
                        $error = $client->getError();

                        if ($error)
                            $this->show_error($error);

                        $res = $res['PaymentVerificationResult'];

                        if ($res != "" && $res != NULL && is_array($res)) {
                            $res = $res['code'];
                        }
                        else
                            $this->show_error("خطا در پاسخ دهی به درخواست با NuSoap_Client");
                    }
                }
                catch(Exception $e){
                    $this->show_error($e->getMessage());
                }
                break;
            case Type_Verify::Http:
                try
                {
                    if( !$this->cURLcheckBasicFunctions() ) $this->show_error("UNAVAILABLE: cURL Basic Functions");
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $this->request_verify_http);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_POSTFIELDS,
                        "api_key=".$this->api_key."&order_id=".$this->order_id."&amount=".$this->amount."&trans_id=".$this->trans_id);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    /** @var int | string $server_output */
                    $res = json_decode(curl_exec ($curl));
                    curl_close ($curl);

                    if ($res != "" && $res != NULL && is_object($res)) {
                        $res = $res->code;
                    }
                    else
                        $this->show_error("خطا در پاسخ دهی به درخواست با Curl");
                }
                catch (Exception $e){
                    $this->show_error($e->getMessage());
                }
                break;
            default:
                try
                {
                    $soap_client = new SoapClient($this->request_verify_soap, array('encoding' => 'UTF-8'));
                    $res = $soap_client->PaymentVerification($this->params);

                    $res = $res->PaymentVerificationResult;

                    if ($res != "" && $res != NULL && is_object($res)) {
                        $res = $res->code;
                    }
                    else
                        $this->show_error("خطا در پاسخ دهی به درخواست با SoapClinet");
                }
                catch(Exception $e){
                    $this->show_error($e->getMessage());
                }
                break;
        }
        return $res;
    }

    /**
     * @param string | string $error
     */
    public function show_error($error)
    {
        echo "<h1>وقوع خطا !!!</h1>";
        echo "<h4>{$error}</h4>";
    }

    /**
     * @param int | string $error_code
     */
    public function code_error($error_code)
    {
        $error_code = intval($error_code);
        $error_array = array(
            0 => "Complete Transaction",
	    -1 => "Default State",
	    -2 => "Bank Failed or Canceled",
	    -3 => "Bank Payment Pending",
	    -4 => "Bank Canceled",
	    -20 => "api key is not send",
	    -21 => "empty trans_id param send",
	    -22 => "amount in not send",
	    -23 => "callback in not send",
	    -24 => "amount incorrect",
	    -25 => "trans_id resend and not allow to payment",
	    -26 => "Token not send",
	    -27 => "order_id incorrect",
	    -30 => "amount less of limit payment",
	    -31 => "fund not found",
	    -32 => "callback error",
	    -33 => "api_key incorrect",
	    -34 => "trans_id incorrect",
	    -35 => "type of api_key incorrect",
	    -36 => "order_id not send",
	    -37 => "transaction not found",
	    -38 => "token not found",
	    -39 => "api_key not found",
	    -40 => "api_key is blocked",
	    -41 => "params from bank invalid",
	    -42 => "payment system problem",
	    -43 => "gateway not found",
	    -44 => "response bank invalid",
	    -45 => "payment system deactivated",
	    -46 => "request incorrect",
	    -47 => "gateway is deleted or not found",
	    -48 => "commission rate not detect",
	    -49 => "trans repeated",
	    -50 => "account not found",
	    -51 => "user not found",
	    -60 => "email incorrect",
	    -61 => "national code incorrect",
	    -62 => "postal code incorrect",
	    -63 => "postal add incorrect",
	    -64 => "desc incorrect",
	    -65 => "name family incorrect",
	    -66 => "tel incorrect",
	    -67 => "account name incorrect",
	    -68 => "product name incorrect",
	    -69 => "callback success incorrect",
	    -70 => "callback failed incorrect",
	    -71 => "phone incorrect",
	    -72 => "bank not response",
	    -73 => "callback_uri incorrect"
        );
        
        if (array_key_exists($error_code, $error_array)) {
		return $error_array[$error_code];
        } else {
		return "error code : $error_code";
	}
    }

    /**
     * @return bool
     */
    public function cURLcheckBasicFunctions()
    {
        if( !function_exists("curl_init") &&
            !function_exists("curl_setopt") &&
            !function_exists("curl_exec") &&
            !function_exists("curl_close") ) return false;
        else return true;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @return string
     */
    public function getCallbackUri()
    {
        return $this->callback_uri;
    }

    /**
     * @return string
     */
    public function getTransId()
    {
        return $this->trans_id;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param int|int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        $this->params['amount'] = $this->amount;
    }

    /**
     * @param bool|string $api_key
     */
    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
        $this->params['api_key'] = $this->api_key;
    }

    /**
     * @param bool|string $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        $this->params['order_id'] = $this->order_id;
    }

    /**
     * @param string $trans_id
     */
    public function setTransId($trans_id)
    {
        $this->trans_id = $trans_id;
        $this->params['trans_id'] = $this->trans_id;
    }

    /**
     * @param string|string $callback_uri
     */
    public function setCallbackUri($callback_uri)
    {
        $this->callback_uri = $callback_uri;
        $this->params['callback_uri'] = $this->callback_uri;
    }

    /**
     * @param array|array $params
     */
    public function setParams($params)
    {
        $trust = true;
        if(is_array($params))
        {
            if (isset($this->keys_for_verify))
            {
                foreach ($this->keys_for_verify as $key )
                {
                    if(!array_key_exists($key,$params))
                    {
                        $trust = false;
                        $error = "<h2>آرایه ارسالی دارای مشکل میباشد.</h2>";
                        $error .= "<h4>نمونه مثال برای آرایه ارسالی.</h4>";
                        $error .= /** @lang text */
                            "<pre>
                                array(\"api_key\"=>\"شناسه api\",
                                      \"order_id\"=>\"شماره فاکتور\",
                                      \"amount\"=>\"مبلغ\",
                                      \"callback_uri\"=>\"مسیر باگشت\")
    
                            </pre>";
                        $this->show_error($error);
                        break;
                    }
                }
            }
            else
                $this->show_error("برای مقدارهی پارامتر ها باید بصورت آرایه اقدام نمایید");
            if($trust)
            {
                $this->params = $params;
                $this->api_key = $params['api_key'];
                $this->order_id = $params['order_id'];
                $this->amount = $params['amount'];
                $this->callback_uri = $params['callback_uri'];
            }
            else
                $this->show_error("برای مقدارهی پارامتر ها باید بصورت آرایه اقدام نمایید");

        }
        else
            $this->show_error("برای مقدارهی پارامتر ها باید بصورت آرایه اقدام نمایید");
    }

    /**
     * @param int $default_verify
     */
    public function setDefaultVerify($default_verify)
    {
        switch ($default_verify){
            case 0:
            case Type_Verify::NuSoap:
                $this->default_verify = Type_Verify::NuSoap;
                break;
            case 1:
            case Type_Verify::SoapClient:
                $this->default_verify = Type_Verify::SoapClient;
                break;
            case 2:
            case Type_Verify::Http:
                $this->default_verify = Type_Verify::Http;
                break;
            default:
                $this->default_verify = Type_Verify::SoapClient;
        }
    }
}

class Type_Verify
{
    const NuSoap = 0;
    const SoapClient = 1;
    const Http = 2;
}