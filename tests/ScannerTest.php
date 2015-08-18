<?php
namespace Calc;

class ScannerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validExtractions
     */
    public function testExtractFirstNumber($input, $data)
    {
        $scanner = new Scanner($input);
        $token = $scanner->current();

        $this->assertEquals($data, $token);
    }

    public function validExtractions()
    {
        return [
            ["8 + 4", "8"],
            ["8+4", "8"],
            ["8-4", "8"],
            ["8 - 4", "8"],
            ["    8         -     4", "8"],
            ["92123", "9"],
        ];
    }

    public function testExtractOnlyValuableElements()
    {
        $scanner = new Scanner("8 + 4");

        $token = $scanner->current();
        $this->assertEquals("8", $token);

        $scanner->next();
        $token = $scanner->current();
        $this->assertEquals("+", $token);

        $scanner->next();
        $token = $scanner->current();
        $this->assertEquals("4", $token);

        $scanner->next();
        $this->assertSame(false, $scanner->valid());
    }
}
