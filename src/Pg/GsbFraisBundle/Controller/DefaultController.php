<?php

namespace Pg\GsbFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PgGsbFraisBundle:Default:index.html.twig', array('name' => $name));
    }
}
