<?php
namespace Calc\State;

use Calc\Grammar;
use Calc\State;

class FinalState implements State
{
    public function next(Grammar $context, $input)
    {
        return false;
    }
}
