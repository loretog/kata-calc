<?php
namespace Calc;

use Calc\State\InitialState;
use Calc\State;

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
        $this->setState(new InitialState());
        while ($this->getState()->next($this, $this->getLexer()->next()) !== false);

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

    public function setState(State $state)
    {
        $this->state = $state;
        return $this;
    }
}
