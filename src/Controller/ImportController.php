<?php declare(strict_types=1);

namespace App\Controller;

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
    public function pgn(Request $request)
    {
        $form = $this->createForm(ImportPgnType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // do stuff

            return $this->redirectToRoute('');
        }

        return $this->render('import/pgn.html.twig', ['form' => $form->createView()]);
    }
}
