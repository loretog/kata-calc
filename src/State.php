<?php
namespace Calc;

use Calc\Grammar;

interface State
{
    public function next(Grammar $context, $input);
}
