<?php

namespace MS\PlatformBundle\Controller;

use MS\PlatformBundle\Entity\Course;
use MS\PlatformBundle\Entity\Subject;
use MS\PlatformBundle\Form\CourseType;
use MS\PlatformBundle\Form\CourseEditType;
use MS\PlatformBundle\Form\SubjectType;
use MS\PlatformBundle\Form\SubjectEditType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $subjectslist = $em->getRepository('MSPlatformBundle:Subject')->findAll();
        $courseslist = $em->getRepository('MSPlatformBundle:Course')->findAll();
        return $this->render("@MSPlatform/Admin/index.html.twig",
            array('subjectslist' => $subjectslist, 'courseslist' => $courseslist));
    }

    public function addCourseAction(Request $request)
    {
        $course = new Course();
        $form   = $this->get('form.factory')->create(CourseType::class, $course);

          if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($course);
          $em->flush();
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

        return $this->redirectToRoute('ms_admin_homepage');
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

        return $this->redirectToRoute('ms_admin_homepage');
    }

}
