<?php
namespace Calc;

use Calc\Lexeme\EqualSymbol;

class Lexer
{
    private $scanner;

    public function __construct(Scanner $scanner)
    {
        $this->scanner = $scanner;
    }

    public function next()
    {
        if (!$this->scanner->valid()) {
            return new EqualSymbol("=");
        }

        $token = $this->scanner->current();

        $lexeme = Lexeme::fromToken($token);

        if (!$lexeme) {
            throw new SyntaxException("Invalid token: {$token}");
        }

        $baseClass = get_class($lexeme);
        do {
            $this->scanner->next();
            $nextLexeme = Lexeme::fromToken($this->scanner->current());

            if (!($nextLexeme instanceOf $baseClass)) {
                break;
            }

            $lexeme->append($nextLexeme);
        } while ($this->scanner->valid());

        return $lexeme;
    }
}
