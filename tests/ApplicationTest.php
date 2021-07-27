<?php
declare(strict_types=1);

namespace App\Test;

use App\Application;
use DI\Container;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ServerRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Application
 */
class ApplicationTest extends TestCase
{
    /**
     * @covers \App\Application::__construct
     */
    public function testConstructor()
    {
        $app = new Application();

        $reflection = new \ReflectionClass($app);
        $property = $reflection->getProperty('container');
        $property->setAccessible(true);

        $this->assertInstanceOf(Container::class, $property->getValue($app));
    }

    /**
     * @covers \App\Application::dispatch
     * @uses \App\Controllers\MonstersController
     * @uses \App\Model\Repository\MonstersRepository
     * @uses \App\Datastore\Datastore
     * @uses \App\Model\Entity\Monster
     * @uses \App\Model\Entity\Species
     * @throws \Throwable
     */
    public function testDispatchReturnsAResponse()
    {
        $app = new Application();
        $request = new ServerRequest();

        $result = $app->dispatch($request);
        $this->assertInstanceOf(Response::class, $result);
    }

    /**
     * @covers \App\Application::dispatch
     * @throws \Throwable
     */
    public function testDispatchWithViewUrl()
    {
        $app = new Application();
        $request = new ServerRequest([], [], '/monsters/view/1');

        $result = $app->dispatch($request);
        $this->assertInstanceOf(Response::class, $result);
    }

    /**
     * @covers \App\Application::dispatch
     * @throws \Throwable
     */
    public function testDispatchedResponseContainsMarkup()
    {
        $app = new Application();
        $request = new ServerRequest();

        $result = $app->dispatch($request);

        $this->assertNotEmpty($result->getBody());
    }

}
