<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\Handler\UserRegistrationHandler;
use App\Form\Type\UserRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserRegistrationHandler $handler)
    {
        $user = new User();

        $form = $this->createForm(UserRegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $handler->handle($user);

            return $this->redirectToRoute('login');
        }

        return $this->render('security/register.html.twig', ['form' => $form->createView()]);
    }
}
