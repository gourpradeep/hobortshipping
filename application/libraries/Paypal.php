<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Paypal subscription Library
 * 
 * @package libraries
 *
 * @module Paypal
 * 
 * @class Paypal.php
 * 
 * @path application\libraries\Paypal.php
 * 
 */
class Paypal {

	private $USER=PAYPAL_USER;
	private $PWD=PAYPAL_PWD;
	private $SIGNATURE=PAYPAL_SIGNATURE;

	public function __construct(){

		if(PAYPAL_ACCOUNT_STATUS=='live'){
			 $this->CURLOPT_URL='https://api-3t.paypal.com/nvp';
			 $this->REDIRECT_URL='https://www.paypal.com/cgi-bin/webscr?%s';
		}else{
			 $this->CURLOPT_URL='https://api-3t.sandbox.paypal.com/nvp';
			 $this->REDIRECT_URL='https://www.sandbox.paypal.com/cgi-bin/webscr?%s';
		}
	}


	/*
	* Set Express Checkout for get token & payerId
	* @param amt,cancel_url,success_url
	*/
	public function SetExpressCheckout($param){
		$curl = curl_init();
 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, $this->CURLOPT_URL);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		    'USER' => $this->USER,
		    'PWD' => $this->PWD,
		    'SIGNATURE' => $this->SIGNATURE,
		 
		    'METHOD' => 'SetExpressCheckout',
		    'VERSION' => '108',
		    'LOCALECODE' => 'USD',
		 
		    'PAYMENTREQUEST_0_AMT' => $param['amt'],
		    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
		    'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
		    'PAYMENTREQUEST_0_ITEMAMT' => $param['amt'],
		 
		    'L_PAYMENTREQUEST_0_NAME0' => 'Exemplo',
		    'L_PAYMENTREQUEST_0_DESC0' => 'Assinatura de exemplo',
		    'L_PAYMENTREQUEST_0_QTY0' => 1,
		    'L_PAYMENTREQUEST_0_AMT0' => $param['amt'],

		    'L_BILLINGTYPE0' => 'RecurringPayments',
		    'L_BILLINGAGREEMENTDESCRIPTION0' => 'Exemplo',
		 
		    'CANCELURL' => $param['cancel_url'],
		    'RETURNURL' => $param['success_url']
		)));
		 
		$response = curl_exec($curl);
		 
		curl_close($curl);
		 
		$nvp = array();
		 
		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		    foreach ($matches['name'] as $offset => $name) {
		        $nvp[$name] = urldecode($matches['value'][$offset]);
		    }
		}

		if (isset($nvp['ACK']) && $nvp['ACK'] == 'Success') {
		    $query = array(
		        'cmd'    => '_express-checkout',
		        'token'  => $nvp['TOKEN']
		    );

		    $redirectURL = sprintf($this->REDIRECT_URL, http_build_query($query));

		    header('Location: ' . $redirectURL);
		}
	}// End


	/*
	* Set Express Checkout for Life time
	* @param amt,cancel_url,success_url
	*/
	public function SetExpressCheckoutLifeTime($param){
		$curl = curl_init();
 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, $this->CURLOPT_URL);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		    'USER' => $this->USER,
		    'PWD' => $this->PWD,
		    'SIGNATURE' => $this->SIGNATURE,
		 
		    'METHOD' => 'SetExpressCheckout',
		    'VERSION' => '108',
		    'LOCALECODE' => 'USD',
		 
		    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
		    'ADDROVERRIDE' => '1',
		    'PAYMENTREQUEST_0_AMT' => $param['amt'],
		    'PAYMENTREQUEST_0_PAYMENTACTION' => 'Order',
		 
		    'CANCELURL' => $param['cancel_url'],
		    'RETURNURL' => $param['success_url']
		)));
		 
		$response = curl_exec($curl);
		 
		curl_close($curl);
		 
		$nvp = array();
		 
		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		    foreach ($matches['name'] as $offset => $name) {
		        $nvp[$name] = urldecode($matches['value'][$offset]);
		    }
		}

		if (isset($nvp['ACK']) && $nvp['ACK'] == 'Success') {
		    $query = array(
		        'cmd'    => '_express-checkout',
		        'token'  => $nvp['TOKEN']
		    );

		    $redirectURL = sprintf($this->REDIRECT_URL, http_build_query($query));

		    header('Location: ' . $redirectURL);
		}

		return $nvp;
	}// End


	/*
	* DoExpress Checkout Payments Profile for Profile Id
	* @param token,payer_id,amt
	*/
	public function DoExpressCheckoutPayment($param){
		$curl = curl_init();
 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, $this->CURLOPT_URL);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		    'USER' => $this->USER,
		    'PWD' => $this->PWD,
		    'SIGNATURE' => $this->SIGNATURE,
		 
		    'METHOD' => 'DoExpressCheckoutPayment',
		    'VERSION' => '95',
		    'LOCALECODE' => 'USD',
		 
		    'TOKEN' => $param['token'],
		    'PayerID' => $param['payer_id'],
		 
		    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD',
		    'PAYMENTREQUEST_0_AMT' => $param['amt'],
		    'PAYMENTREQUEST_0_PAYMENTACTION' => 'Order',
		)));
		 
		$response = curl_exec($curl);
		 
		curl_close($curl);
		 
		$nvp = array();
		 
		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		    foreach ($matches['name'] as $offset => $name) {
		        $nvp[$name] = urldecode($matches['value'][$offset]);
		    }
		}

		$response=$this->DoAuthorization($nvp);
		return $response;
	}// End 


	/*
	* DoExpress Checkout Payments Profile for Profile Id
	* @param PAYMENTINFO_0_TRANSACTIONID,PAYMENTINFO_0_AMT
	*/
	public function DoAuthorization($param){
		$curl = curl_init();
 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, $this->CURLOPT_URL);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		    'USER' => $this->USER,
		    'PWD' => $this->PWD,
		    'SIGNATURE' => $this->SIGNATURE,
		 
		    'METHOD' => 'DoAuthorization',
		    'VERSION' => '95',
		    'CURRENCYCODE' => 'USD',
		    'TRANSACTIONID' => $param['PAYMENTINFO_0_TRANSACTIONID'],
		    'AMT' => $param['PAYMENTINFO_0_AMT'],
		)));
		 
		$response = curl_exec($curl);
		 
		curl_close($curl);
		 
		$nvp = array();
		 
		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		    foreach ($matches['name'] as $offset => $name) {
		        $nvp[$name] = urldecode($matches['value'][$offset]);
		    }
		}

		$response=$this->DoCapture($nvp);
		return $response;
	}// End 


	/*
	* DoExpress Checkout Payments Profile for Profile Id
	* @param TRANSACTIONID,AMT
	*/
	public function DoCapture($param){
		$curl = curl_init();
 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, $this->CURLOPT_URL);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		    'USER' => $this->USER,
		    'PWD' => $this->PWD,
		    'SIGNATURE' => $this->SIGNATURE,
		 
		    'METHOD' => 'DoCapture',
		    'VERSION' => '95',
		    'CURRENCYCODE' => 'USD',
		    'AUTHORIZATIONID' => $param['TRANSACTIONID'],
		    'AMT' => $param['AMT'],
		    'COMPLETETYPE' => 'NotComplete',
		)));
		 
		$response = curl_exec($curl);
		 
		curl_close($curl);
		 
		$nvp = array();
		 
		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		    foreach ($matches['name'] as $offset => $name) {
		        $nvp[$name] = urldecode($matches['value'][$offset]);
		    }
		}

		//pr($nvp); die;
		return $nvp;
	}// End

	/*
	* Create Recurring Payments Profile for Profile Id
	* @param token,payer_id,billing_period,billing_frequency,amt
	*/
	public function CreateRecurringPaymentsProfile($param){
		$curl = curl_init();
 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, $this->CURLOPT_URL);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		    'USER' => $this->USER,
		    'PWD' => $this->PWD,
		    'SIGNATURE' => $this->SIGNATURE,
		 
		    'METHOD' => 'CreateRecurringPaymentsProfile',
		    'VERSION' => '108',
		    'LOCALECODE' => 'USD',
		 
		    'TOKEN' => $param['token'],
		    'PayerID' => $param['payer_id'],
		 
		    'PROFILESTARTDATE' => date('Y-m-d').'T16:00:00Z',
		    'DESC' => 'Exemplo',
		    'BILLINGPERIOD' => $param['billing_period'],
		    'BILLINGFREQUENCY' => $param['billing_frequency'],
		    'TOTALBILLINGCYCLES' => 0,
		    'AMT' => $param['amt'],
		    'CURRENCYCODE' => 'USD',
		    'COUNTRYCODE' => 'BR',
		    'MAXFAILEDPAYMENTS' => 5
		)));
		 
		$response = curl_exec($curl);
		 
		curl_close($curl);
		 
		$nvp = array();
		 
		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		    foreach ($matches['name'] as $offset => $name) {
		        $nvp[$name] = urldecode($matches['value'][$offset]);
		    }
		}

		return $nvp;
	}// End 


	/*
	* Manage Recurring Payments Profile Status for Profile Id
	* @param profile_id
	*/
	public function ManageRecurringPaymentsProfileStatus($param){
		$curl = curl_init();
 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, $this->CURLOPT_URL);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		    'USER' => $this->USER,
		    'PWD' => $this->PWD,
		    'SIGNATURE' => $this->SIGNATURE,
		 
		    'METHOD' => 'ManageRecurringPaymentsProfileStatus',
		    'VERSION' => '108',
		    'LOCALECODE' => 'USD',
		 
		    'PROFILEID' => $param['profile_id'],
		    'ACTION' => 'Cancel',
		    'NOTE' => 'Cancel this plan',
		)));
		 
		$response = curl_exec($curl);
		 
		curl_close($curl);
		 
		$nvp = array();
		 
		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		    foreach ($matches['name'] as $offset => $name) {
		        $nvp[$name] = urldecode($matches['value'][$offset]);
		    }
		}

		return $nvp;
	}// End

	/*
	* Get profile details for check current plan status
	* @param profile_id,
	*/
	public function GetRecurringPaymentsProfileDetails($param){
		$curl = curl_init();
 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, $this->CURLOPT_URL);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
		    'USER' => $this->USER,
		    'PWD' => $this->PWD,
		    'SIGNATURE' => $this->SIGNATURE,
		 
		    'METHOD' => 'GetRecurringPaymentsProfileDetails',
		    'VERSION' => '108',
		 
		    'PROFILEID' => $param['profile_id']
		)));
		 
		$response = curl_exec($curl);
		 
		curl_close($curl);
		 
		$nvp = array();
		 
		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
		    foreach ($matches['name'] as $offset => $name) {
		        $nvp[$name] = urldecode($matches['value'][$offset]);
		    }
		}

		return $nvp;
	}// End
}