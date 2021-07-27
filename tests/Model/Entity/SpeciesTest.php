<?php

namespace App\Test\Model\Entity;

use App\Model\Entity\Species;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Model\Entity\Species
 */
class SpeciesTest extends TestCase
{
    /**
     * @var \App\Model\Entity\Species
     */
    private $species;

    public function setUp(): void
    {
        parent::setUp();

        $this->species = new Species([
            'id' => 1,
            'name' => 'Fanged Wyvern'
        ]);
    }

    public function testId()
    {
        $this->assertSame(1, $this->species->id());
    }

    public function testName()
    {
        $this->assertSame('Fanged Wyvern', $this->species->name());
    }

    public function testConvertingToJson()
    {
        $result = \json_encode($this->species);
        $expected = '{"id":1,"name":"Fanged Wyvern"}';

        $this->assertIsString($result);
        $this->assertSame($expected, $result);
    }
}
