<?php declare(strict_types=1);

namespace App\Controller;

use App\Form\Handler\UserRegistrationHandler;
use App\Form\Type\UserRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /** @Route("/login", name="login") */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        return $this->render(
            'security/login.html.twig',
            [
                'last_username' => $authenticationUtils->getLastUsername(),
                'error' => $authenticationUtils->getLastAuthenticationError(),
            ]
        );
    }

    /** @Route("/register", name="register") */
    public function register(Request $request, UserRegistrationHandler $handler)
    {
        $form = $this->createForm(UserRegistrationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $handler->handle($form->getData());

            return $this->redirectToRoute('login');
        }

        return $this->render('security/register.html.twig', ['form' => $form->createView()]);
    }
}
