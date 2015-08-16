<?php
namespace Calc;

use InvalidArgumentException;

class Scanner
{

    private $string;
    private $index;

    public function __construct($string)
    {
        $this->index = 0;
        $this->string = str_replace([" ", "\n", ], "", trim($string));
    }

    public function next()
    {
        ++$this->index;
        $token = $this->current();
        return $token;
    }

    public function current()
    {
        $token = false;

        if ($this->index < strlen($this->string)) {
            $token = $this->string[$this->index];
        }

        return $token;
    }
}
