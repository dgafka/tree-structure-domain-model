<?php

namespace Dgafka\Domain\Structure;

/**
 * Class Node
 *
 * @package Dgafka\Domain\Structure
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Node extends Composite
{
	/**
	 * @var string
	 */
	private $ID;
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @param string $ID
	 * @param string $name
	 */
	public function __construct($ID, $name)
    {
	    $this->ID = $ID;
	    $this->name = $name;
	    parent::__construct();
    }

	/**
	 * @return string
	 */
    public function name()
    {
        return $this->name;
    }

	/**
	 * @return string
	 */
    public function ID()
    {
        return $this->ID;
    }
}
