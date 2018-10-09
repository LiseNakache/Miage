<?php

namespace MS\PlatformBundle\Controller;


use MS\PlatformBundle\Entity\Subject;
use MS\PlatformBundle\Entity\Teacher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TeacherController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $teacher = $em->getRepository('MSPlatformBundle:Teacher')->find(4);
        return $this->render("@MSPlatform/Teacher/homepage.html.twig",
            array('teacher' => $teacher));
    }
}