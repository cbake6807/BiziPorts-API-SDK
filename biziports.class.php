<?php

/*
 * BiziPorts API SDK Class
 * Version 1.0
 * Author: Chris Bake
 * Company: BakedFinn, LLC
 *
 * Requirements: cURL, PHP 5+,
 */


class BiziPorts_API
{

	protected $api_version = '1.0';
	protected $username = null;
	protected $password = null;
	protected $endpoint = 'https://api.biziports.com';

	/*
	 * Set The global API Username
	 */
	public function setUsername($username=null)
	{
		if(empty($username)) throw new Exception("API Username Not Provided!");
		$this->username = $username;
	}

	/*
	 * Set The global API Password
	 */
	public function setPassword($password=null)
	{
		if(empty($password)) throw new Exception("API Password Not Provided!");
		$this->password = $password;
	}

	/*
	 * Login the API user session
	 */
	public function auth()
	{
		$return = $this->do_request('login/do');

		if($return['loggedIn'] == true) return true;
		else return false;
	}


	public function checkAPILogin()
	{
		$return = $this->do_request('login/check');

		if($return['loggedIn'] == true) return true;
		else return false;
	}




	/*
	 * Perform the actual request to the BiziPorts API Service
	 * Called internally only. You should never need to call this method
	 */
	final private function do_request($uri=null, $post=null)
	{
		if(empty($this->password) || empty($this->username)) throw new Exception("API Username or Password Not Provided!");

		if(empty($uri)) throw new Exception("API URI Not Provided!");

		$url = $this->endpoint . DS . $this->api_version . DS . $uri;

		$ch = curl_init();

		$headers = array(
			"Host: ".$url
		);

		curl_setopt($ch,	CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch,	CURLOPT_URL,	$url);
		curl_setopt($ch,	CURLOPT_HEADER,	0);
		curl_setopt($ch,	CURLOPT_RETURNTRANSFER,	true);

		$result = curl_exec($ch);
		curl_close($ch);

		// return and unserialize the json result from the API Request into a usable object
		try {
			return unserialize($result);
		}
		catch (Exception $e){
			throw new Exception("API Result Failed!");
		}
		return array("ERRORS" => $e);
	}

}

