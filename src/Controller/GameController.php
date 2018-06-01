<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/game", name="game_")
 */
class GameController extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function list(GameRepository $repository)
    {
        return $this->render('game/list.html.twig', ['games' => $repository->findAll()]);
    }

    /**
     * @Route("/{id}", name="view")
     */
    public function view(Game $game)
    {
        return $this->render('game/view.html.twig', ['game' => $game]);
    }
}
