<?php
namespace Calc\State;

use Calc\State;
use Calc\Grammar;
use Calc\SyntaxException;
use Calc\Lexeme\Number;
use Calc\State\NumberState;
use Calc\Lexeme\Symbol;

class InitialState implements State
{
    public function next(Grammar $context, Symbol $input)
    {
        if (!($input instanceOf Number)) {
            throw new SyntaxException("Invalid Sequence");
        }

        $context->setTotal((string)$input);
        $context->setState(new NumberState($input));
    }
}
