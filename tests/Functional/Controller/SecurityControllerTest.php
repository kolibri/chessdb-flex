<?php declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testRegistrationAndLogin()
    {
        $client = static::createClient();
        $client->followRedirects(true);


        $crawler = $client->request('GET', '/register');
        static::assertTrue($client->getResponse()->isSuccessful());

        $form = $crawler->filter('form[name="user_registration"]')->selectButton('Register')->form();
        $client->submit($form, [
            'user_registration[email]' => 'torben@tester.dev',
            'user_registration[username]' => 'torben',
            'user_registration[password][first]' => 'tester',
            'user_registration[password][second]' => 'tester',
        ]);

        static::assertTrue($client->getResponse()->isSuccessful());

        $crawler = $client->request('GET', '/login');
        static::assertTrue($client->getResponse()->isSuccessful());
        $form = $crawler->filter('form[name="login"]')->selectButton('Login')->form();
        $client->submit($form, [
            '_username' => 'torben',
            '_password' => 'tester',
        ]);
        static::assertTrue($client->getResponse()->isSuccessful());
    }
}
