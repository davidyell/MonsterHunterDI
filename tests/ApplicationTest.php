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
        $this->expectOutputString('<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

<div class="container">
    <h1>Examplasaurus</h1>

            <div class="row">
            <div class="col-md-12 text-center">
                <img src="/img/examplasaurus.jpg" alt="Examplasaurus">
            </div>
        </div>
    
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <tr>
                    <td>Species</td>
                    <td><strong>Fanged Wyvern</strong></td>
                </tr>
            </table>

            <p class="text-center">
                <a href="/" title="Back" class="btn btn-default btn-block">&leftarrow; Back</a>
            </p>
        </div>
    </div>
</div>
');

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
