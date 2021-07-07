<?php
/**
 * MonstersController
 */
declare(strict_types=1);

namespace App\Controllers;

use App\Model\Repository\MonstersRepository;
use App\Model\Repository\RepositoryInterface;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class MonstersController
{
    /**
     * @var \App\Model\Repository\MonstersRepository
     */
    private RepositoryInterface $monstersRepository;

    /**
     * MonstersController constructor.
     */
    public function __construct()
    {
        $this->monstersRepository = new MonstersRepository();
    }

    /**
     * Get a list of all the available monsters
     *
     * @throws \Throwable
     */
    public function list(): ResponseInterface
    {
        $monsters = $this->monstersRepository->findAll();

        $phpView = new PhpRenderer(\dirname(__DIR__) . '/Views/Monsters');
        $response = $phpView->render(new Response(), 'list.php', ['monsters' => $monsters]);

        return $response;
    }
}
