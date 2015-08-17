<?php
namespace Calc\State;

use Prophecy\Argument;
use Calc\Lexeme\Number;
use Calc\Lexeme\AdditionSymbol;
use Calc\Lexeme\SubtractSymbol;

class InitialStateTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialStateMoveToANumberState()
    {
        $grammar = $this->prophesize("Calc\\Grammar");
        $grammar->setTotal("8")->shouldBeCalled();
        $grammar->setState(Argument::type("Calc\\State\\NumberState"))->shouldBeCalled();

        $state = new InitialState();

        $newState = $state->next($grammar->reveal(), new Number("8"));
    }

    /**
     * @expectedException Calc\SyntaxException
     * @dataProvider invalidSymbols
     */
    public function testSyntaxError($instance)
    {
        $grammar = $this->prophesize("Calc\\Grammar");

        $state = new InitialState();
        $newState = $state->next($grammar->reveal(), $instance);
    }

    public function invalidSymbols()
    {
        return [
            [new AdditionSymbol("+")],
            [new SubtractSymbol("-")],
        ];
    }
}
