<?php namespace NetSuite\Toolkit;

class Proxy
{

	private $service;
	private $config;

	// Hide the constructor
	private function __construct() {}

	/**
	 * The adapter must be instantiated and initialized before any
	 * NetSuite functionality can be utilized.
	 */
	public static function fromConfig($config)
	{
		// TODO: Validate the config
		$this->config = $config;

		// We are specifically not instantiating the service here.
		// We want to make sure it is known that dependencies are being initialized.
	}

	public function initalizeDependencies()
	{
		require_once('../../PHPToolkit/NetSuiteService.php');
		$this->service = NetSuiteService::fromConfig($this->config);
	}

	/**
	 * Proxies all calls through the original NetSuiteService.
	 * @param  string $name      Name of the function being called on the Proxy
	 * @param  array  $arguments Array of arguments being passed to the function
	 * @return *                 Value being returned from the NetSuiteService function call.
	 */
	public function __call($name, $arguments)
	{
		return call_user_func_array(array($this->service, $name), $args);
	}

}