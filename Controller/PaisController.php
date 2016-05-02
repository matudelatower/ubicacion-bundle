<?php

namespace Matudelatower\UbicacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Matudelatower\UbicacionBundle\Entity\Pais;
use Matudelatower\UbicacionBundle\Form\PaisType;

/**
 * Pais controller.
 *
 */
class PaisController extends Controller
{
    /**
     * Lists all Pais entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pais = $em->getRepository('UbicacionBundle:Pais')->findAll();

        return $this->render('UbicacionBundle:pais:index.html.twig', array(
            'pais' => $pais,
        ));
    }

    /**
     * Creates a new Pais entity.
     *
     */
    public function newAction(Request $request)
    {
        $pai = new Pais();
        $form = $this->createForm('Matudelatower\UbicacionBundle\Form\PaisType', $pai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pai);
            $em->flush();

            return $this->redirectToRoute('pais_show', array('id' => $pai->getId()));
        }

        return $this->render('UbicacionBundle:pais:new.html.twig', array(
            'pai' => $pai,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pais entity.
     *
     */
    public function showAction(Pais $pai)
    {
        $deleteForm = $this->createDeleteForm($pai);

        return $this->render('UbicacionBundle:pais:show.html.twig', array(
            'pai' => $pai,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pais entity.
     *
     */
    public function editAction(Request $request, Pais $pai)
    {
        $deleteForm = $this->createDeleteForm($pai);
        $editForm = $this->createForm('Matudelatower\UbicacionBundle\Form\PaisType', $pai);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pai);
            $em->flush();

            return $this->redirectToRoute('pais_edit', array('id' => $pai->getId()));
        }

        return $this->render('UbicacionBundle:pais:edit.html.twig', array(
            'pai' => $pai,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pais entity.
     *
     */
    public function deleteAction(Request $request, Pais $pai)
    {
        $form = $this->createDeleteForm($pai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pai);
            $em->flush();
        }

        return $this->redirectToRoute('pais_index');
    }

    /**
     * Creates a form to delete a Pais entity.
     *
     * @param Pais $pai The Pais entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pais $pai)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pais_delete', array('id' => $pai->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
