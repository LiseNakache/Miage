<?php

namespace MS\PlatformBundle\Controller;

use MS\PlatformBundle\Entity\Course;
use MS\PlatformBundle\Entity\Subject;
use MS\PlatformBundle\Entity\Student;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StudentController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('MSPlatformBundle:Student')->find(1);
        return $this->render("@MSPlatform/Student/homepage.html.twig",
            array('student' => $student));
    }

    public function simulationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('MSPlatformBundle:Student')->find(1);


        return $this->render("@MSPlatform/Student/index.html.twig",
            array('student' => $student));
    }

}