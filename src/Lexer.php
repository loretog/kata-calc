<?php
namespace Calc;

class Lexer
{
    private $scanner;

    public function __construct(Scanner $scanner)
    {
        $this->scanner = $scanner;
    }

    public function next()
    {
        $token = $this->scanner->current();

        if ($token === false) {
            return false;
        }

        $lexeme = Lexeme::fromToken($token);

        if (!$lexeme) {
            throw new SyntaxException("Invalid token: {$token}");
        }

        $baseClass = get_class($lexeme);
        while (($nextLexeme = Lexeme::fromToken($this->scanner->next())) instanceOf $baseClass) {
            $lexeme->append($nextLexeme);
        }

        return $lexeme;
    }
}
