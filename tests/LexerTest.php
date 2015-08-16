<?php
namespace Calc;

class LexerTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractNumbers()
    {
        $scanner = $this->prophesize("Calc\\Scanner");
        $scanner->next()->willReturn(false);
        $scanner->current()->willReturn('8');

        $lexer = new Lexer($scanner->reveal());

        $lexeme = $lexer->next();

        $this->assertInstanceOf("Calc\\Lexeme\\Number", $lexeme);
        $this->assertEquals("8", $lexeme);
    }

    public function testExtractBigNumbers()
    {
        $scanner = $this->prophesize("Calc\\Scanner");
        $scanner->next()->willReturn('4', '2', false);
        $scanner->current()->willReturn('8', '4', '2', false);

        $lexer = new Lexer($scanner->reveal());

        $lexeme = $lexer->next();

        $this->assertInstanceOf("Calc\\Lexeme\\Number", $lexeme);
        $this->assertEquals("842", $lexeme);
    }


    public function testExtractConsecutivesStrings()
    {
        $scanner = $this->prophesize("Calc\\Scanner");
        $scanner->next()->willReturn('+', '4', '2', false, false);
        $scanner->current()->willReturn('8', '+', '4', false);

        $lexer = new Lexer($scanner->reveal());

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
        $scanner->next()->willReturn('+', '4', '2', false);
        $scanner->current()->willReturn('y', '+', '4', false);

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

