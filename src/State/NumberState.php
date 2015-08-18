<?php
namespace Calc\State;

use Calc\State;
use Calc\Lexeme\Number;
use Calc\Grammar;
use Calc\State\OperatorState;
use Calc\SyntaxException;
use Calc\State\FinalState;
use Calc\Lexeme\Symbol;

class NumberState implements State
{
    private $number;

    public function __construct(Number $number)
    {
        $this->number = $number;
    }

    public function next(Grammar $context, Symbol $input)
    {
        switch (get_class($input)) {
            case "Calc\\Lexeme\\AdditionSymbol":
            case "Calc\\Lexeme\\SubtractSymbol":
                $context->setState(new OperatorState($input));
                break;
            case "Calc\\Lexeme\\EqualSymbol":
                $context->setState(new FinalState());
                break;
            default:
                $context->setState(null);
                throw new SyntaxException("Invalid sequence");
        }
    }
}
