<?php

namespace Dgafka\Domain\Structure;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Composite
 *
 * @package Dgafka\Domain\Structure
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Composite
{
	/** @var  Node[] */
	protected $nodes;

	public function __construct()
	{
		$this->nodes = [];
	}

	/**
	 * @return Node[]
	 */
	public function childNodes()
	{
		return $this->nodes;
	}

	/**
	 * @param Node $node
	 * @param           $parentID
	 */
	public function add(Node $node, $parentID)
	{
		$parent = $this->findNodeByID($parentID);

		if (!$parent) {
			throw new \InvalidArgumentException('Parent doesnt exists, id: ' . $parentID);
		}

		$parent->addChild($node);
	}

	/**
	 * @param Node $node
	 */
	public function addChild(Node $node)
	{
		$this->nodes[$node->ID()] = $node;
	}

	/**
	 * @param $parentID
	 *
	 * @return Node|null
	 */
	public function findNodeByID($parentID)
	{
		if (isset($this->nodes[$parentID])) {
			return $this->nodes[$parentID];
		}

		foreach ($this->nodes as $node) {
			if ($foundNode = $node->findNodeByID($parentID)) {
				return $foundNode;
			};
		}

		return null;
	}

}