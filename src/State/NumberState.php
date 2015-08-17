<?php
namespace Calc\State;

use Calc\State;
use Calc\Lexeme\Number;
use Calc\Grammar;
use Calc\State\OperatorState;
use Calc\SyntaxException;
use Calc\State\FinalState;

class NumberState implements State
{
    private $number;

    public function __construct(Number $number)
    {
        $this->number = $number;
    }

    public function next(Grammar $context, $input)
    {
        if ($input == false) {
            $context->setState(new FinalState());
            return;
        }

        switch (get_class($input)) {
            case "Calc\\Lexeme\\AdditionSymbol":
            case "Calc\\Lexeme\\SubtractSymbol":
                $context->setState(new OperatorState($input));
                break;
            default:
                throw new SyntaxException("Invalid sequence");
        }
    }
}
