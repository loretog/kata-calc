<?php
namespace Calc\Lexeme;

class Symbol
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function append($token)
    {
        $this->value = $token;
    }

    public function __toString()
    {
        return $this->value;
    }
}

