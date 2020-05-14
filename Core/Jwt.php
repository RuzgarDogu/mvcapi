<?php
/**
 * 
 */
class Jwt
{
	
	function __construct()
	{

	}

	public function olustur($pl)
	{
		$header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
		$payload = json_encode($pl);

		$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
		$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

		$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, JWT_SECRET, true);
		$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

		$jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

		return $jwt;
	}

	public function dogrula($jwt)
	{
		$payload = $this->payloadCozumle($jwt);
		$yenidenOlustur = $this->olustur($payload);

		if ($yenidenOlustur === $jwt && $payload->app_ip == $this->ipadresi()) {
			return $payload->app_id;
		} else {
			return false;
		}

	}

	public function payloadCozumle($jwt)
	{
		$ayristirilmis = explode('.', $jwt);
		$header = json_decode(base64_decode($ayristirilmis[0]));
		$payload = json_decode(base64_decode($ayristirilmis[1]));
		$signature = $ayristirilmis[2];
		return $payload;
	}


	public function ipadresi()
	{
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}	

}