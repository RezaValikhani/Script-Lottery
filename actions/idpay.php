<?php

/*
 * script Name:  Script-Lottery
 * Description:  تمامی حقوق نزد رضا ولی خانی محفوظ میباشد.توسعه اسکریپت با ذکر منبع بلا مانع میباشد.
 * Author:       Reza Valikhani
 * Telegram:     @codweb
 * Github URI:   https://github.com/RezaValikhani
 */

class IDPay {
	private $api_key;
	private $sandbox;
	public function __construct($api_key, $sandbox=false){
		$this->api_key = $api_key;
		$this->sandbox = $sandbox;
	}
	private function sendRequest($method, $fields=[]){
		$url = "https://api.idpay.ir/v1.1/$method";
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'X-API-KEY: '.$this->api_key,
		'X-SANDBOX: '.$this->sandbox
		));
		
		$result = curl_exec($ch);
		curl_close($ch);
		
		return json_decode($result);
	}
	public function createPayment($order_id,$amount,$callback,$desc=null,$name=null,$phone=null,$mail=null,$reseller=null){
		$fields = compact('order_id','amount','callback','name','phone','mail','desc','reseller');
		return self::sendRequest('payment',$fields);
	}
	public function verifyPayment($id, $order_id){
		$fields = compact('order_id','id');
		return self::sendRequest('payment/verify', $fields);
	}
	public function inquiryPayment($id, $order_id){
		$fields = compact('order_id','id');
		return self::sendRequest('payment/inquiry', $fields);
	}
	public function Create(array $fields){
		return self::sendRequest('payment', $fields);
	}
	public function Verify(array $fields){
		return self::sendRequest('payment/verify', $fields);
	}
	public function Inquiry(array $fields){
		return self::sendRequest('payment/inquiry', $fields);
	}
}

?>