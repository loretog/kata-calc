<?php
namespace Calc;

use ArrayIterator;
use InvalidArgumentException;

class Scanner extends ArrayIterator
{
    public function __construct($string)
    {
        parent::__construct(str_split(str_replace([" ", "\n"], "", $string)));
    }
}
