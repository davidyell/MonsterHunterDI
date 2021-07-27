<?php
/**
 * MonstersControllerTest
 *
 * Copyright (c) 2021 Comparison Technologies Ltd.
 *
 * @author David Yell <david.yell@comparisontech.com>
 */
declare(strict_types=1);

namespace App\Test\Controllers;

use App\Controllers\MonstersController;
use App\Datastore\Datastore;
use App\Model\Entity\Monster;
use App\Model\Entity\Species;
use App\Model\Repository\MonstersRepository;
use DI\Container;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;

class MonstersControllerTest extends TestCase
{
    /**
     * @var \DI\Container
     */
    private Container $container;

    public function setUp(): void
    {
        parent::setUp();

        $mockDatastore = $this->getMockBuilder(Datastore::class)
            ->getMock();

        $mockRepository = $this->getMockBuilder(MonstersRepository::class)
            ->setConstructorArgs([$mockDatastore])
            ->onlyMethods(['findAll', 'findOne'])
            ->getMock();

        $monster = new Monster([
            'id' => 1,
            'name' => 'Examplasaurus',
            'image' => 'examplasaurus.jpg',
            'species' => new Species([
                'id' => 1,
                'name' => 'Fanged Wyvern'
            ])
        ]);

        $mockRepository->expects($this->any())
            ->method('findAll')
            ->willReturn([$monster]);

        $mockRepository->expects($this->any())
            ->method('findOne')
            ->willReturn($monster);

        $this->container = new Container();
        $this->container->set('MonstersRepository', $mockRepository);
    }

    /**
     * @covers \App\Controllers\MonstersController::list
     * @covers \App\Controllers\MonstersController::__construct
     * @uses \App\Model\Repository\MonstersRepository
     * @uses \App\Datastore\Datastore
     * @uses \App\Model\Entity\Monster
     * @uses \App\Model\Entity\Species
     */
    public function testList()
    {
        $request = new ServerRequest();

        $controller = new MonstersController($request, $this->container);

        $result = $controller->list();

        $this->assertInstanceOf(Response::class, $result);
        $this->assertNotEmpty($result->getBody());
    }

    /**
     * @covers \App\Controllers\MonstersController::list
     * @covers \App\Controllers\MonstersController::__construct
     * @uses \App\Model\Repository\MonstersRepository
     * @uses \App\Datastore\Datastore
     * @uses \App\Model\Entity\Monster
     * @uses \App\Model\Entity\Species
     */
    public function testListCanOutputJson()
    {
        $request = new ServerRequest(
            [],
            [],
            '/',
            'get',
        'php://input',
            ['Content-Type' => 'application/json'],
        );

        $controller = new MonstersController($request, $this->container);

        $result = $controller->list();

        $this->assertInstanceOf(Response::class, $result);
        $this->assertNotEmpty($result->getBody());

        $bodyJson = \json_decode((string)$result->getBody(), true);
        $this->assertIsArray($bodyJson);
        $this->assertEquals('Examplasaurus', $bodyJson[0]['name']);
    }

    /**
     * @covers \App\Controllers\MonstersController::view
     * @covers \App\Controllers\MonstersController::__construct
     * @uses \App\Model\Repository\MonstersRepository
     * @uses \App\Datastore\Datastore
     * @uses \App\Model\Entity\Monster
     * @uses \App\Model\Entity\Species
     */
    public function testView()
    {
        $request = new ServerRequest([], [], '/monsters/view/1');

        $controller = new MonstersController($request, $this->container);

        $result = $controller->view(1);

        $this->assertInstanceOf(Response::class, $result);
        $this->assertNotEmpty($result->getBody());
    }

    /**
     * @covers \App\Controllers\MonstersController::view
     * @covers \App\Controllers\MonstersController::__construct
     * @uses \App\Model\Repository\MonstersRepository
     * @uses \App\Datastore\Datastore
     * @uses \App\Model\Entity\Monster
     * @uses \App\Model\Entity\Species
     */
    public function testViewCanOutputJson()
    {
        $request = new ServerRequest(
            [],
            [],
            '/monsters/view/1',
            'get',
            'php://input',
            ['Content-Type' => 'application/json'],
        );

        $controller = new MonstersController($request, $this->container);

        $result = $controller->view(1);

        $this->assertInstanceOf(Response::class, $result);
        $this->assertNotEmpty($result->getBody());

        $bodyJson = \json_decode((string)$result->getBody(), true);
        $this->assertIsArray($bodyJson);
        $this->assertEquals('Examplasaurus', $bodyJson['name']);
    }
}
