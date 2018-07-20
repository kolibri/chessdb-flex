<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Game;
use App\Form\Handler\GameHandler;
use App\Form\Handler\ImportPgnHandler;
use App\Form\Type\GameType;
use App\Form\Type\ImportPgnType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/** @Route("/import", name="import_") */
class ImportController extends Controller
{
    /** @Route("/pgn", name="pgn") */
    public function pgn(Request $request, ImportPgnHandler $handler)
    {
        $form = $this->createForm(ImportPgnType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game = $handler->handle($form->getData());

            return $this->redirectToRoute('import_game', ['id' => $game->getId()]);
        }

        return $this->render('import/pgn.html.twig', ['form' => $form->createView()]);
    }

    /** @Route("/game/{id}", name="game") */
    public function game(Request $request, Game $game, GameHandler $handler)
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game = $form->getData();
            $handler->handle($game);

            return $this->redirectToRoute('import_game', ['id' => $game->getId()]);
        }

        return $this->render('import/game.html.twig', ['form' => $form->createView()]);
    }
}
