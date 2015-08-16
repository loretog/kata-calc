<?php
namespace Calc;

use Calc\State\NumberState;

class Grammar
{
    private $total;
    private $state;
    private $lexer;

    public function __construct(Lexer $lexer)
    {
        $this->total = 0;
        $this->lexer = $lexer;
    }

    public function compute()
    {
        $init = $this->getLexer()->next();

        if (!($init instanceOf Lexeme\Number)) {
            throw new SyntaxException("Invalid Sequence");
        }

        $this->setTotal((string)$init);
        $this->setState(new NumberState($init));

        while (($state = $this->getState()) !== false) {
            $this->getState()->next($this, $this->getLexer()->next());
        }

        return $this->getTotal();
    }

    public function getLexer()
    {
        return $this->lexer;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }
}
