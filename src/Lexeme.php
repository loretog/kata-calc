<?php
namespace Calc;

class Lexeme
{
    private static $numbers = ["0","1","2","3","4","5","6","7","8","9"];
    private static $symbols = ["+", "-"];

    public static function fromToken($token)
    {
        $lexeme = null;

        if ($token === null) {
            $lexeme = new Lexeme\EqualSymbol("=");
        } else if (self::isNumber($token)) {
            $lexeme = new Lexeme\Number($token);
        } else if (self::isSymbol($token)) {
            $lexeme = self::getSymbol($token);
        }

        return $lexeme;
    }

    private static function getSymbol($token)
    {
        switch ($token) {
        case '+':
            $symbol = new Lexeme\AdditionSymbol($token);
            break;
        case '-':
            $symbol = new Lexeme\SubtractSymbol($token);
            break;
        default:
            $symbol = new Lexeme\Symbol($token);
            break;
        }

        return $symbol;
    }

    private static function isNumber($token)
    {
        return in_array($token, self::$numbers, true);
    }

    private static function isSymbol($token)
    {
        return in_array($token, self::$symbols, true);
    }
}
