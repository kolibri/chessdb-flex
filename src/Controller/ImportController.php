<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\ImportPgnHandler;
use App\Form\ImportPgnType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/import", name="import_")
 */
class ImportController extends Controller
{
    /**
     * @Route("/pgn", name="pgn")
     */
    public function pgn(Request $request, ImportPgnHandler $handler)
    {
        $form = $this->createForm(ImportPgnType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $handler->handle($form->getData());

            return $this->redirectToRoute('import_pgn');
        }

        return $this->render('import/pgn.html.twig', ['form' => $form->createView()]);
    }
}
