<?php
namespace Calc\Lexeme;

class Number extends Symbol
{
    public function append($token)
    {
        $this->value .= $token;
    }
}
