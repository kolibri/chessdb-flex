<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/** @Route("/game", name="game_") */
class GameController extends AbstractController
{
    /** @Route("/", name="list") */
    public function list(GameRepository $repository)
    {
        return $this->render('game/list.html.twig', ['games' => $repository->findAll()]);
    }

    /** @Route("/{id}", name="view") */
    public function view(Game $game)
    {
        return $this->render('game/view.html.twig', ['game' => $game]);
    }
}
