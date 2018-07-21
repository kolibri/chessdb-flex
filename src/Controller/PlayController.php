<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\CreateInviteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/** @Route("/play", name="play_") */
class PlayController extends Controller
{
    /** @Route("/invite/create", name="create_invite") */
    public function createGameOffer(Request $request)
    {
        $form = $this->createForm(CreateInviteType::class);

        return $this->render('play/invite_new.html.twig', ['form' => $form->createView()]);
    }

    /** @Route("/invite", name="list_invite") */
    public function listOffers(Request $request)
    {
        return $this->render('play/invite_list.html.twig');
    }

    /** @Route("/invite/{id}/accept", name="accept_invite") */
    public function acceptGameOffer(Request $request)
    {
        return $this->render('play/invite_accept.html.twig');
    }
}
