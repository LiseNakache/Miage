<?php

namespace MS\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MSPlatformBundle::generalHomepage.html.twig');
    }
}
