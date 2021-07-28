<?php
declare(strict_types=1);

namespace App\Test;

use App\Application;
use App\Model\Entity\Monster;
use App\Model\Entity\Species;
use App\Views\View;
use DI\Container;
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
     */
    public function testDispatchCallsRender()
    {
        $mockApplication = $this->getMockBuilder(Application::class)
            ->onlyMethods(['render'])
            ->getMock();

        $mockApplication->expects($this->once())
            ->method('render');

        $mockApplication->dispatch(new ServerRequest());
    }

    public function testRenderOutputs()
    {
        $this->expectOutputRegex("/Examplasaurus/i");

        $app = new Application();

        $monster = new Monster([
            'id' => 1,
            'name' => 'Examplasaurus',
            'image' => 'examplasaurus.jpg',
            'species' => new Species([
                'id' => 1,
                'name' => 'Fanged Wyvern'
            ])
        ]);

        $view = new View(
            ['monster' => $monster],
            \dirname(__DIR__) . '/src/Views/Monsters',
            'view.php'
        );

        $app->render(new ServerRequest(), $view);
    }
}
