<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Sujet;
use AppBundle\Form\SujetType;

/**
 * Sujet controller.
 *
 * @Route("/sujet")
 */
class SujetController extends Controller
{
    /**
     * Lists all Sujet entities.
     *
     * @Route("/", name="sujet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sujets = $em->getRepository('AppBundle:Sujet')->findAll();

        return $this->render('sujet/index.html.twig', array(
            'sujets' => $sujets,
        ));
    }

    /**
     * Creates a new Sujet entity.
     *
     * @Route("/new", name="sujet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sujet = new Sujet();
        $form = $this->createForm('AppBundle\Form\SujetType', $sujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sujet);
            $em->flush();

            return $this->redirectToRoute('sujet_show', array('id' => $sujet->getId()));
        }

        return $this->render('sujet/new.html.twig', array(
            'sujet' => $sujet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sujet entity.
     *
     * @Route("/{id}", name="sujet_show")
     * @Method("GET")
     */
    public function showAction(Sujet $sujet)
    {
        $deleteForm = $this->createDeleteForm($sujet);

        return $this->render('sujet/show.html.twig', array(
            'sujet' => $sujet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Sujet entity.
     *
     * @Route("/{id}/edit", name="sujet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sujet $sujet)
    {
        $deleteForm = $this->createDeleteForm($sujet);
        $editForm = $this->createForm('AppBundle\Form\SujetType', $sujet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sujet);
            $em->flush();

            return $this->redirectToRoute('sujet_edit', array('id' => $sujet->getId()));
        }

        return $this->render('sujet/edit.html.twig', array(
            'sujet' => $sujet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Sujet entity.
     *
     * @Route("/{id}", name="sujet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sujet $sujet)
    {
        $form = $this->createDeleteForm($sujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sujet);
            $em->flush();
        }

        return $this->redirectToRoute('sujet_index');
    }

    /**
     * Creates a form to delete a Sujet entity.
     *
     * @param Sujet $sujet The Sujet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sujet $sujet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sujet_delete', array('id' => $sujet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
