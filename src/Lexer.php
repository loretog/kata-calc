<?php
namespace Calc;

class Lexer
{
    const EOF = "";
    const NUMBER = "NUMBER";
    const SYMBOL = "SYMBOL";

    private $numbers = ["0","1","2","3","4","5","6","7","8","9"];
    private $symbols = ["+", "-"];

    private $scanner;

    public function __construct(Scanner $scanner)
    {
        $this->scanner = $scanner;
    }

    public function next()
    {
        $token = $this->scanner->current();

        $lexeme = $this->tokenToLexeme($token);

        if (!$lexeme) {
            throw new SyntaxException("Invalid token: {$token}");
        }

        $baseClass = get_class($lexeme);
        while (($nextToken = $this->tokenToLexeme($this->scanner->next())) instanceOf $baseClass) {
            $lexeme->append($nextToken);
        }

        return $lexeme;
    }

    private function tokenToLexeme($token)
    {
        $lexeme = false;

        if ($this->isNumber($token)) {
            $lexeme = new Lexeme\Number($token);
        } else if ($this->isSymbol($token)) {
            $lexeme = new Lexeme\Symbol($token);
        }

        return $lexeme;
    }

    private function isNumber($token)
    {
        return in_array($token, $this->numbers, true);
    }

    private function isSymbol($token)
    {
        return in_array($token, $this->symbols, true);
    }
}
