<?php
namespace Calc;

class Lexeme
{
    public static function fromToken($token)
    {
        $lexeme = null;

        if ($token === null) {
            $lexeme = new Lexeme\EqualSymbol("=");
        } else if (is_number($token)) {
            $lexeme = new Lexeme\Number($token);
        } else if (is_symbol($token)) {
            $lexeme = get_symbol($token);
        }

        return $lexeme;
    }
}

function is_number($token)
{
    static $numbers = ["0","1","2","3","4","5","6","7","8","9"];
    return in_array($token, $numbers, true);
}

function is_symbol($token)
{
    static $symbols = ["+", "-"];
    return in_array($token, $symbols, true);
}

function get_symbol($token)
{
    $symbol = null;
    switch ($token) {
        case '+':
            $symbol = new Lexeme\AdditionSymbol($token);
            break;
        case '-':
            $symbol = new Lexeme\SubtractSymbol($token);
            break;
    }

    return $symbol;
}

