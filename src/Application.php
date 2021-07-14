<?php
/**
 * Application
 *
 * Copyright (c) 2021 Comparison Technologies Ltd.
 *
 * @author David Yell <david.yell@comparisontech.com>
 */
declare(strict_types=1);

namespace App;

use App\Controllers\MonstersController;
use App\Datastore\Datastore;
use App\Model\Repository\MonstersRepository;
use DI\Container;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Throwable
     */
    public function dispatch(ServerRequestInterface $request): ResponseInterface
    {
        $controller = new MonstersController($request, $this->container);

        if (\stristr($request->getUri()->getPath(), 'monsters/view') !== false) {
            \preg_match('@\/monsters\/view\/([\d]+)@', $request->getUri()->getPath(), $matches);
            return $controller->view((int)$matches[1]);
        }

        return $controller->list();
    }
}
