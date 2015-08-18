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
        $lexeme = $this->getLexeme();
        do {
            $baseClass = get_class($lexeme);

            $this->scanner->next();

            $nextLexeme = $this->getLexeme();

            if (!$lexeme->isSame($nextLexeme)) {
                break;
            }

            $lexeme->append($nextLexeme);
        } while ($this->scanner->valid());

        return $lexeme;
    }

    private function getLexeme()
    {
        $lexeme = Lexeme::fromToken($this->scanner->current());
        if (!$lexeme) {
            throw new SyntaxException("Invalid sequence");
        }
        return $lexeme;
    }
}
