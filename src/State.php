<?php
namespace Calc;

use Calc\Grammar;
use Calc\Lexeme\Symbol;

interface State
{
    public function next(Grammar $context, Symbol $input);
}
