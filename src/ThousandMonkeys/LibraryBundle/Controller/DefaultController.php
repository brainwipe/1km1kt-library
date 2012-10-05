<?php

namespace ThousandMonkeys\LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
		$user = $this->get('security.context');

        return $this->render('ThousandMonkeysLibraryBundle:Default:index.html.twig', array('name' => $name, 'user' => $user));
    }
}
