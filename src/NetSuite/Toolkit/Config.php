<?php namespace NetSuite\Toolkit;

/**
 * API configuration for the NetSuiteService.
 * Utilizes the Builder pattern.
 */
class Config
{

	private $email;
	private $password;
	private $endpoint = '2013_2';
	private $host = 'https://webservices.netsuite.com';
	private $role = "3";
	private $account;
	private $wsdl;
	private $options = array();

	// Hide constructor
	private function __construct() {}

	public static function fromEmailAndPassword($email, $password)
	{
		if (empty($email) {
			throw new InvalidArgumentException('Email cannot be empty');
		}
		if (empty($password)) {
			throw new InvalidArgumentException('Password cannot be empty');
		}

		$config = new Config();
		$config->email = (string) $email;
		$config->password = (string) $password;
		return $config;
	}

	public function email() { return $this->email; }
	public function password() { return $this->password; }

	public function setEndpoint($endpoint)
	{
		if (empty($endpoint)) {
			throw new InvalidArgumentException('Endpoint cannot be empty');
		}
		$this->endpoint = (string) $endpoint;
	}
	public function endpoint() { return $this->endpoint; }

	public function setHost($host)
	{
		if (empty($host)) {
			throw new InvalidArgumentException('Host cannot be empty');
		}
		$this->host = (string) $host;
	}
	public function host() { return $this->host; };

	public function setRole($role)
	{
		if (empty($role)) {
			throw new InvalidArgumentException('Role cannot be empty');
		}
		$this->role = (string) $role;
	}
	public function role() { return $this->role; }

	public function setAccount($account)
	{
		if (empty($account)) {
			throw new InvalidArgumentException('Account cannot be empty');
		}
		$this->account = (string) $account;
	}
	public function account() { return $this->account; }

	public function setWsdl($wsdl)
	{
		// WSDL can be null
		$this->wsdl = $wsdl;
	}
	public function wsdl() { return $this->wsdl; }

	public function setOptions($options)
	{
		// Options can be empty
		$this->options = (array) $options;
	}
	public function options() { return $this->options; }
	
}