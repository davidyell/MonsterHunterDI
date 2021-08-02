<?php
/**
 * MonstersController
 */
declare(strict_types=1);

namespace App\Controllers;

use App\Model\Entity\Monster;
use App\Model\Repository\RepositoryInterface;
use App\Views\View;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class MonstersController
{
    /**
     * @var \App\Model\Repository\MonstersRepository
     */
    private RepositoryInterface $monstersRepository;

    /**
     * MonstersController constructor.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Incoming request instance
     * @param \Psr\Container\ContainerInterface $container Built container
     */
    public function __construct(ServerRequestInterface $request, ContainerInterface $container)
    {
        $this->monstersRepository = $container->get('MonstersRepository');
        $this->request = $request;
    }

    /**
     * Get a list of all the monsters
     *
     * @return \App\Views\View
     */
    public function list(): View
    {
        $monsters = $this->monstersRepository->findAll();

        return new View(
            ['monsters' => $monsters],
            \dirname(__DIR__) . '/Views/Monsters',
            'list.php'
        );
    }

    /**
     * View a single monster
     *
     * @param int $id Monster id to view
     * @return \App\Views\View
     */
    public function view(int $id): View
    {
        $monster = $this->monstersRepository->findOne($id);

        if ($monster instanceof Monster) {
            return new View(
                ['monster' => $monster],
                \dirname(__DIR__) . '/Views/Monsters',
                'view.php'
            );
        }

        return new View(
            [],
            \dirname(__DIR__) . '/Views/Errors',
            '404.php'
        );
    }
}
