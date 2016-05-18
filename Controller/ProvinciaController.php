<?php

namespace Matudelatower\UbicacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Matudelatower\UbicacionBundle\Entity\Provincia;
use Matudelatower\UbicacionBundle\Form\Type\ProvinciaType;

/**
 * Provincia controller.
 *
 */
class ProvinciaController extends Controller
{
    /**
     * Lists all Provincia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $provincias = $em->getRepository('UbicacionBundle:Provincia')->findAll();

        return $this->render('UbicacionBundle:provincia:index.html.twig', array(
            'provincias' => $provincias,
        ));
    }

    /**
     * Creates a new Provincia entity.
     *
     */
    public function newAction(Request $request)
    {
        $provincium = new Provincia();
        $form = $this->createForm('Matudelatower\UbicacionBundle\Form\Type\ProvinciaType', $provincium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provincium);
            $em->flush();

            return $this->redirectToRoute('provincia_show', array('id' => $provincium->getId()));
        }

        return $this->render('UbicacionBundle:provincia:new.html.twig', array(
            'provincium' => $provincium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Provincia entity.
     *
     */
    public function showAction(Provincia $provincium)
    {
        $deleteForm = $this->createDeleteForm($provincium);

        return $this->render('UbicacionBundle:provincia:show.html.twig', array(
            'provincium' => $provincium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Provincia entity.
     *
     */
    public function editAction(Request $request, Provincia $provincium)
    {
        $deleteForm = $this->createDeleteForm($provincium);
        $editForm = $this->createForm('Matudelatower\UbicacionBundle\Form\Type\ProvinciaType', $provincium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($provincium);
            $em->flush();

            return $this->redirectToRoute('provincia_edit', array('id' => $provincium->getId()));
        }

        return $this->render('UbicacionBundle:provincia:edit.html.twig', array(
            'provincium' => $provincium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Provincia entity.
     *
     */
    public function deleteAction(Request $request, Provincia $provincium)
    {
        $form = $this->createDeleteForm($provincium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($provincium);
            $em->flush();
        }

        return $this->redirectToRoute('provincia_index');
    }

    /**
     * Creates a form to delete a Provincia entity.
     *
     * @param Provincia $provincium The Provincia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Provincia $provincium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('provincia_delete', array('id' => $provincium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
