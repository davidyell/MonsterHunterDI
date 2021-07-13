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
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

class MonstersController
{
    /**
     * @var \App\Model\Repository\MonstersRepository
     */
    private RepositoryInterface $monstersRepository;

    /**
     * MonstersController constructor.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     * @return void
     */
    public function __construct(ServerRequestInterface $request)
    {
        $this->monstersRepository = new MonstersRepository();
        $this->request = $request;
    }

    /**
     * Get a list of all the available monsters
     *
     * @throws \Throwable
     */
    public function list(): ResponseInterface
    {
        $monsters = $this->monstersRepository->findAll();

        if (!empty($this->request->getHeader('Content-Type')) && $this->request->getHeader('Content-Type')[0] === 'application/json') {
            return new Response\JsonResponse($monsters);
        }

        $phpView = new PhpRenderer(\dirname(__DIR__) . '/Views/Monsters');
        $response = $phpView->render(new Response(), 'list.php', ['monsters' => $monsters]);

        return $response;
    }

    /**
     * View a single monster
     *
     * @param int $id
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Throwable
     */
    public function view(int $id): ResponseInterface
    {
        $monster = $this->monstersRepository->findOne($id);

        if (!empty($this->request->getHeader('Content-Type')) && $this->request->getHeader('Content-Type')[0] === 'application/json') {
            return new Response\JsonResponse($monster);
        }

        $phpView = new PhpRenderer(\dirname(__DIR__) . '/Views/Monsters');
        $response = $phpView->render(new Response(), 'view.php', ['monster' => $monster]);

        return $response;
    }
}
