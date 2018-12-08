<?php

namespace MS\PlatformBundle\Controller;

use MS\PlatformBundle\Entity\Course;
use MS\PlatformBundle\Entity\Subject;
use MS\PlatformBundle\Form\CourseType;
use MS\PlatformBundle\Form\CourseEditType;
use MS\PlatformBundle\Form\SubjectType;
use MS\PlatformBundle\Form\SubjectEditType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{


    public function homepageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $currentUser = $user->getId();
        $admin = $em->getRepository('MSPlatformBundle:User')->find($currentUser);
        return $this->render("@MSPlatform/Admin/homepage.html.twig", array('admin' => $admin));
    }


    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        //Recherche par ordre alphabetique
        $subjectslist = $em->getRepository('MSPlatformBundle:Subject')->findBy(
            array(),
            array('type' => 'ASC'));
        $courseslist = $em->getRepository('MSPlatformBundle:Course')->findBy(
            array(),
            array('type' => 'ASC'));
        return $this->render("@MSPlatform/Admin/index.html.twig",
            array('subjectslist' => $subjectslist, 'courseslist' => $courseslist));
    }


    public function subjectAction()
    {
        $em = $this->getDoctrine()->getManager();
        //Recherche par ordre alphabetique
        $subjectslist = $em->getRepository('MSPlatformBundle:Subject')->findBy(
            array(),
            array('type' => 'ASC'));
        return $this->render("@MSPlatform/Admin/subject.html.twig",
            array('subjectslist' => $subjectslist));
    }

    public function addCourseAction(Request $request)
    {
        $course = new Course();
        $form   = $this->get('form.factory')->create(CourseType::class, $course);

          if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($course);
          $em->flush();

            //Flash msg si la filière a été créee
              $this->addFlash('success', 'Filière créee!');
              return $this->redirectToRoute('ms_admin_addCourse');
          }



        return $this->render("@MSPlatform/Admin/addCourse.html.twig", array(
            'form' => $form->createView(),
        ));
    }

    public function addSubjectAction(Request $request)
    {
        $subject = new Subject();
        $form   = $this->get('form.factory')->create(SubjectType::class, $subject);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subject);
            $em->flush();
            $this->addFlash('success', 'Matière créee!');
            return $this->redirectToRoute('ms_admin_addSubject');

        }

        return $this->render("@MSPlatform/Admin/addSubject.html.twig", array(
            'form' => $form->createView(),
        ));
    }

    public function editCourseAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository('MSPlatformBundle:Course')->find($id);

        if (null === $course) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        $form = $this->get('form.factory')->create(CourseEditType::class, $course);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Filière modifiée!');
            return $this->redirectToRoute('ms_admin_editCourse', array('id' => $id));
        }
        return $this->render("@MSPlatform/Admin/editCourse.html.twig", array('form'   => $form->createView()));
    }


    public function editSubjectAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $subject = $em->getRepository('MSPlatformBundle:Subject')->find($id);

        if (null === $subject) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        $form = $this->get('form.factory')->create(SubjectEditType::class, $subject);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Matière modifiée!');
            return $this->redirectToRoute('ms_admin_editSubject', array('id' => $id));
        }
        return $this->render("@MSPlatform/Admin/editSubject.html.twig", array('form'   => $form->createView()));
    }


    public function deleteCourseAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository('MSPlatformBundle:Course')->find($id);
        if (null === $course) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
            $em->remove($course);
            $em->flush();

        return $this->redirectToRoute('ms_admin_university');
    }


    public function deleteSubjectAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $subject = $em->getRepository('MSPlatformBundle:Subject')->find($id);
        if (null === $subject) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }

        $em->remove($subject);
        $em->flush();

        return $this->redirectToRoute('ms_admin_university');
    }

}
