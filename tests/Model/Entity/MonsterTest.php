<?php

namespace App\Test\Model\Entity;

use App\Model\Entity\Monster;
use App\Model\Entity\Species;
use PHPUnit\Framework\TestCase;

class MonsterTest extends TestCase
{
    /**
     * @var \App\Model\Entity\Monster
     */
    private $monster;

    /**
     * @covers \App\Model\Entity\Monster::__construct
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->monster = new Monster([
            'id' => 1,
            'name' => 'Examplasaurus',
            'image' => 'examplasaurus.jpg',
            'species' => new Species([
                'id' => 1,
                'name' => 'Fanged Wyvern'
            ])
        ]);
    }

    /**
     * @covers \App\Model\Entity\Monster::id
     */
    public function testId()
    {
        $this->assertSame(1, $this->monster->id());
    }

    /**
     * @covers \App\Model\Entity\Monster::name
     */
    public function testName()
    {
        $this->assertSame('Examplasaurus', $this->monster->name());
    }

    /**
     * @covers \App\Model\Entity\Monster::species
     */
    public function testSpecies()
    {
        $this->assertInstanceOf(Species::class, $this->monster->species());
    }

    /**
     * @covers \App\Model\Entity\Monster::image
     */
    public function testImage()
    {
        $this->assertSame('examplasaurus.jpg', $this->monster->image());
    }

    /**
     * @covers \App\Model\Entity\Monster::jsonSerialize
     */
    public function testConvertingToJson()
    {
        $result = \json_encode($this->monster);
        $expected = '{"id":1,"name":"Examplasaurus","image":"examplasaurus.jpg","species":{"id":1,"name":"Fanged Wyvern"}}';

        $this->assertIsString($result);
        $this->assertSame($expected, $result);
    }
}
