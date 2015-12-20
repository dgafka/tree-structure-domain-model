<?php

namespace spec\Dgafka\Domain\Structure;

use Dgafka\Domain\Structure\Node;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class NodeSpec
 *
 * @package spec\Dgafka\Domain\Structure
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @mixin Node
 */
class NodeSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith('1','someName');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dgafka\Domain\Structure\Node');
        $this->name()->shouldReturn('someName');
        $this->ID()->shouldReturn('1');
    }

}
