<?php
declare(strict_types=1);

namespace App;

use App\Controllers\MonstersController;
use App\Datastore\Datastore;
use App\Model\Repository\MonstersRepository;
use App\Views\View;
use DI\Container;
use Laminas\Diactoros\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

class Application
{
    /**
     * @var \Psr\Container\ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->container = $this->buildContainer();
    }

    /**
     * Create a dependency injection container
     *
     * @return \Psr\Container\ContainerInterface
     */
    private function buildContainer(): ContainerInterface
    {
        $container = new Container();
        $container->set('Datastore', \DI\create(Datastore::class));
        $container->set('MonstersRepository', \DI\autowire(MonstersRepository::class));

        return $container;
    }

    /**
     * Dispatch a response for rendering
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     */
    public function dispatch(ServerRequestInterface $request): void
    {
        $controller = new MonstersController($request, $this->container);

        if (\stristr($request->getUri()->getPath(), 'monsters/view') !== false) {
            \preg_match('@\/monsters\/view\/([\d]+)@', $request->getUri()->getPath(), $matches);
            $viewVars = $controller->view((int)$matches[1]);
        } else {
            $viewVars = $controller->list();
        }

        $this->render($request, $viewVars);
    }

    /**
     * Render a View
     *
     * @param \App\Views\View $view
     * @return void
     */
    public function render(ServerRequestInterface $request, View $view): void
    {
        if (!empty($request->getHeader('Content-Type'))
            && $request->getHeader('Content-Type')[0] === 'application/json') {
            $response = new Response\JsonResponse($view->vars);
        } else {
            $phpView = new PhpRenderer($view->templateFolder);
            $response = $phpView->render(new Response(), $view->template, $view->vars);
        }

        $headers = $response->getHeaders();
        foreach ($headers as $header => $values) {
            header($header . ': ' . $values[0]);
        }

        echo $response->getBody();
    }
}
