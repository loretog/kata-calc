<?php
namespace Calc\State;

use Calc\State;
use Calc\Lexeme\Symbol;
use Calc\Grammar;
use Calc\Lexeme\AdditionSymbol;
use Calc\Lexeme\SubtractSymbol;
use Calc\SyntaxException;
use Calc\State\NumberState;

class OperatorState implements State
{
    private $symbol;

    public function __construct(Symbol $symbol)
    {
        $this->symbol = $symbol;
    }

    public function next(Grammar $context, Symbol $input)
    {
        $total = $context->getTotal();

        switch (get_class($input)) {
            case "Calc\\Lexeme\\Number":
                $context->setState(new NumberState($input));
                if ($this->symbol instanceOf AdditionSymbol) {
                    $total += (string)$input;
                } else if ($this->symbol instanceOf SubtractSymbol) {
                    $total -= (string)$input;
                }
                break;
            default:
                throw new SyntaxException("Invalid sequence");
        }

        $context->setTotal($total);
    }
}
