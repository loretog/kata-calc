<?php
namespace Calc;

class LexerTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractLexemes()
    {
        $scanner = new Scanner("8 + 42");
        $lexer = new Lexer($scanner);

        $lexeme = $lexer->next();

        $this->assertInstanceOf("Calc\\Lexeme\\Number", $lexeme);
        $this->assertEquals("8", $lexeme);

        $lexeme = $lexer->next();

        $this->assertInstanceOf("Calc\\Lexeme\\AdditionSymbol", $lexeme);
        $this->assertEquals("+", $lexeme);

        $lexeme = $lexer->next();

        $this->assertInstanceOf("Calc\\Lexeme\\Number", $lexeme);
        $this->assertEquals("42", $lexeme);

        $this->assertFalse($lexer->next());
    }

    /**
     * @expectedException Calc\SyntaxException
     */
    public function testInvalidSymbols()
    {
        $scanner = $this->prophesize("Calc\\Scanner");
        $scanner->next()->willReturn(null);
        $scanner->current()->willReturn('y', '+', '4', null);
        $scanner->valid()->willReturn(true, true, true, false);

        $lexer = new Lexer($scanner->reveal());

        $lexeme = $lexer->next();
    }

    public function testScannerStopAsIntegration()
    {
        $lexer = new Lexer(new Scanner("8+42"));

        $i = 0;
        while ($lexer->next() != false) {
            ++$i;
        }

        $this->assertEquals(3, $i);
    }
}

