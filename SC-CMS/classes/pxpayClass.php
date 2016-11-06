<?php
include "lib/pxpay/PxPay_Curl.inc.php";

class PxPay
{
	private $pxpay;
	public $trans;
	
	public function __construct()
	{
		$PxPay_Url    = "https://www.paymentexpress.com/pxpay/pxaccess.aspx";
		$PxPay_Userid = "Natcoll_Dev"; 
		$PxPay_Key    =  "fb9f7649ebcdcca74f427183b37c6c5fca3db775e1e04e09eadc612ac786c420"; 
		$this->pxpay = new PxPay_Curl( $PxPay_Url, $PxPay_Userid, $PxPay_Key );
	}
	
	public function sendToDPS($totalSale, $orderID)
	{
		$request = new PxPayRequest();

		$http_host   = getenv("HTTP_HOST");
		$request_uri = getenv("SCRIPT_NAME");
		$server_url  = "http://$http_host";
		#$script_url  = "$server_url/$request_uri"; //using this code before PHP version 4.3.4
		#$script_url  = "$server_url$request_uri"; //Using this code after PHP version 4.3.4
		$script_url = (version_compare(PHP_VERSION, "4.3.4", ">=")) ?"$server_url$request_uri" : "$server_url/$request_uri";

		#Generate a unique identifier for the transaction
		$TxnId = uniqid("OR");
	  
		#Set PxPay properties
		$request->setMerchantReference(uniqid("ID"));
		$request->setAmountInput($totalSale);
		$request->setTxnData1($orderID);
		$request->setTxnType("Purchase");
		$request->setCurrencyInput("NZD");
		$request->setEmailAddress("your_email@paymentexpress.com");
		$request->setUrlFail($script_url);			# can be a dedicated failure page
		$request->setUrlSuccess($script_url);			# can be a dedicated success page
		$request->setTxnId($TxnId);  

		#Call makeRequest function to obtain input XML
		$request_string = $this->pxpay->makeRequest($request);
	   
		#Obtain output XML
		$response = new MifMessage($request_string);
	  
		#Parse output XML
		$url = $response->get_element_text("URI");
		$valid = $response->get_attribute("valid");
	   
		#Redirect to payment page
		header("Location: ".$url);
	}
	
	public function processResultFromDPS($model, $enc_hex)
	{
		$rsp = $this->pxpay->getResponse($enc_hex);

		if ($rsp->getSuccess() == "1")
		{
			$result = "The transaction was approved.";
		}
		else
		{
			$result = "The transaction was declined.";
		}
		$this->trans = get_object_vars($rsp);
		$this->trans['resultText'] = $result;
		$model->updateOrderReceipt($this->trans);
		echo '<pre>';
		print_r($this->trans);
		echo '</pre>';
	}
}

?>