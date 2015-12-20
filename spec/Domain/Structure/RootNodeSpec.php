<?php

namespace spec\Dgafka\Domain\Structure;

use Dgafka\Domain\Structure\Composite;
use Dgafka\Domain\Structure\Node;
use Dgafka\Domain\Structure\RootNode;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class TreeStructureSpec
 *
 * @package spec\Dgafka\Domain\Structure
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @mixin RootNode
 */
class RootNodeSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType(Composite::class);
    }

    function it_should_add_child_nodes()
    {
        $this->addLevel1();

        $childs = $this->childNodes();
        $childs[1]->name()->shouldReturn('child1');
        $childs[2]->name()->shouldReturn('child2');
    }

    function it_should_add_node_to_level_2()
    {
        $this->addLevel1();
        $this->addLevel2();

        $child3 = $this->findNodeByID(3);
        $child3->name()->shouldReturn('child3');
        $child4 = $this->findNodeByID(4);
        $child4->name()->shouldReturn('child4');
    }

    function it_should_add_node_to_level_3()
    {
        $this->addLevel1();
        $this->addLevel2();
        $this->addLevel3();

        $child3 = $this->findNodeByID(5);
        $child3->name()->shouldReturn('child5');
        $child4 = $this->findNodeByID(6);
        $child4->name()->shouldReturn('child6');
    }

    function it_should_exception_if_node_not_found()
    {
        $this->addLevel1();
        $this->addLevel2();
        $this->shouldThrow(\InvalidArgumentException::class)->during('add', [new Node(7, 'test'), 10]);
    }

    private function addLevel1()
    {
        $childNode1 = new Node(1, 'child1');
        $childNode2 = new Node(2, 'child2');

        $this->addChild($childNode1);
        $this->addChild($childNode2);
    }

    private function addLevel2()
    {
        $childLevel2Node1 = new Node(3, 'child3');
        $childLevel2Node2 = new Node(4, 'child4');
        $this->add($childLevel2Node1, 1);
        $this->add($childLevel2Node2, 2);
    }

    private function addLevel3()
    {
        $childLevel2Node1 = new Node(5, 'child5');
        $childLevel2Node2 = new Node(6, 'child6');
        $this->add($childLevel2Node1, 3);
        $this->add($childLevel2Node2, 4);
    }

}
