<?php

namespace Dgafka\Infrastructure;

use Predis\Client;

/**
 * Class Cache
 *
 * @package Dgafka\Infrastructure
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Cache
{

	/** @var Client  */
	private $predis;

	public function __construct()
	{
		$this->predis = new Client();
	}

	/**
	 * @param $key
	 * @param $value
	 *
	 * @return void
	 */
	public function set($key, $value)
	{
		$this->predis->set($key, $value);
	}

	/**
	 * @param $key
	 *
	 * @return string
	 */
	public function get($key)
	{
		return $this->predis->get($key);
	}

}