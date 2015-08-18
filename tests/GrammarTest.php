<?php
namespace Calc;

class GrammarTest extends \PHPUnit_Framework_TestCase
{
    public function testDirectNumbers()
    {
        $lexer = $this->prophesize("Calc\\Lexer");
        $lexer->next()->willReturn(
            new Lexeme\Number("91"),
            new Lexeme\EqualSymbol("=")
        );

        $grammar = new Grammar($lexer->reveal());

        $this->assertEquals(91, $grammar->compute());
    }

    /**
     * @expectedException Calc\SyntaxException
     */
    public function testInvalidSequence()
    {
        $lexer = $this->prophesize("Calc\\Lexer");
        $lexer->next()->willReturn(new Lexeme\SubtractSymbol("-"));

        $grammar = new Grammar($lexer->reveal());

        $grammar->compute();
    }

    public function testBaseAdditionsGrammar()
    {
        $lexer = $this->prophesize("Calc\\Lexer");
        $lexer->next()->willReturn(
            new Lexeme\Number("8"),
            new Lexeme\AdditionSymbol("+"),
            new Lexeme\Number("42"),
            new Lexeme\EqualSymbol("=")
        );

        $grammar = new Grammar($lexer->reveal());

        $this->assertEquals(50, $grammar->compute());
    }

    public function testBaseSubtractsGrammar()
    {
        $lexer = $this->prophesize("Calc\\Lexer");
        $lexer->next()->willReturn(
            new Lexeme\Number("8"),
            new Lexeme\SubtractSymbol("-"),
            new Lexeme\Number("42"),
            new Lexeme\EqualSymbol("=")
        );

        $grammar = new Grammar($lexer->reveal());

        $this->assertEquals(-34, $grammar->compute());
    }

    public function testLongGrammar()
    {
        $lexer = $this->prophesize("Calc\\Lexer");
        $lexer->next()->willReturn(
            new Lexeme\Number("8"),
            new Lexeme\SubtractSymbol("-"),
            new Lexeme\Number("42"),
            new Lexeme\AdditionSymbol("+"),
            new Lexeme\Number("42"),
            new Lexeme\AdditionSymbol("+"),
            new Lexeme\Number("91"),
            new Lexeme\EqualSymbol("=")
        );

        $grammar = new Grammar($lexer->reveal());

        $this->assertEquals(99, $grammar->compute());
    }
}
