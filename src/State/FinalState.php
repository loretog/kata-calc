<?php
namespace Calc\State;

use Calc\Grammar;
use Calc\State;
use Calc\Lexeme\Symbol;

class FinalState implements State
{
    public function next(Grammar $context, Symbol $input)
    {
        return false;
    }
}
