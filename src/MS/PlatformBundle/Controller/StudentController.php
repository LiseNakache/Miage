<?php

namespace MS\PlatformBundle\Controller;

use MS\PlatformBundle\Entity\Course;
use MS\PlatformBundle\Entity\User;
use MS\PlatformBundle\Entity\Subject;
use MS\PlatformBundle\Entity\Student;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StudentController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
//        $user = $this->container->get('security.context')->getToken()->getUser();
        $currentUser = $user->getId();
        $student = $em->getRepository('MSPlatformBundle:Student')->find($currentUser);
//        $student = $em->getRepository('MSPlatformBundle:Student')->find(19);
        return $this->render("@MSPlatform/Student/homepage.html.twig",
            array('student' => $student));

//        if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) )
//{
//    $user = $this->container->get('security.token_storage')->getToken()->getUser();
//    $username = $user->getUsername();
//}


    }

    public function simulationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('MSPlatformBundle:Student')->find(19);


        return $this->render("@MSPlatform/Student/index.html.twig",
            array('student' => $student));
    }

    public function getGradesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('MSPlatformBundle:Student')->find(19);
        return $this->render("@MSPlatform/Student/getGrades.html.twig",
            array('student' => $student));
    }
}