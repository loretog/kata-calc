<?php
namespace Calc;

class LexemeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getAll
     */
    public function testExtractLexeme($clazz, $token)
    {
        $lexeme = Lexeme::fromToken($token);

        $this->assertInstanceOf($clazz, $lexeme);
        $this->assertEquals($token, $lexeme);
    }

    public function getAll()
    {
        return [
            ["Calc\\Lexeme\\Number", "0"],
            ["Calc\\Lexeme\\Number", "1"],
            ["Calc\\Lexeme\\Number", "2"],
            ["Calc\\Lexeme\\Number", "3"],
            ["Calc\\Lexeme\\Number", "4"],
            ["Calc\\Lexeme\\Number", "5"],
            ["Calc\\Lexeme\\Number", "6"],
            ["Calc\\Lexeme\\Number", "7"],
            ["Calc\\Lexeme\\Number", "8"],
            ["Calc\\Lexeme\\Number", "9"],
            ["Calc\\Lexeme\\AdditionSymbol", "+"],
            ["Calc\\Lexeme\\SubtractSymbol", "-"],
        ];
    }

    public function testInvalidSymbol()
    {
        $this->assertNull(Lexeme::fromToken("y"));
    }
}
