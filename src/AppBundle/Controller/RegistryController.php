<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Registry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Registry controller.
 *
 * @Route("registry")
 */
class RegistryController extends Controller
{
    /**
     * Lists all registry entities.
     *
     * @Route("/", name="registry_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();

        $registries = $em->getRepository('AppBundle:Registry')->findAll();

        return $this->render('registry/index.html.twig', array(
            'registries' => $registries,
        ));
    }

    /**
     * Creates a new registry entity.
     *
     * @Route("/new", name="registry_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $now = new \DateTime();
        $deadline = new \DateTime('2020-06-25');
        if($now >= $deadline){
            return $this->render('registry/closed.html.twig');
        }

        $registry = new Registry();
        $form = $this->createForm('AppBundle\Form\RegistryType', $registry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($registry);
            $em->flush();

            $mailer = $this->get('mailer');
            $message =  \Swift_Message::newInstance()
                ->setSubject('Iberoamerican Congress on Geometry 2020 - Registry')
                ->setFrom('icg@matmor.unam.mx')
                ->setTo($registry->getEmail())
                 ->setBcc(array('miguel@matmor.unam.mx'))
                ->setBody(
                    $this->renderView(
                        'registry/confirmation.txt.twig',
                        ['registry' => $registry]
                    ),
                    'text/plain'

                )
            ;

            $mailer->send($message);

            If($registry->getAdvisorEmail()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Iberoamerican Congress on Geometry 2020 - Recomendation ')
                    ->setFrom('icg@matmor.unam.mx')
                    ->setTo($registry->getAdvisorEmail())
                    ->setBcc(array('miguel@matmor.unam.mx'))
                    ->setBody(
                        $this->renderView(
                            'recommendation/email.txt.twig',
                            ['registry' => $registry]
                        ),
                        'text/plain'

                    );

                $mailer->send($message);
            }

            return $this->redirectToRoute('registry_confirmation', array('id' => $registry->getId()));
        }

        return $this->render('registry/new.html.twig', array(
            'registry' => $registry,
            'form' => $form->createView(),
        ));
    }

    /**
     * Confirmation.
     *
     * @Route("/confirmation/{id}", name="registry_confirmation")
     * @Method("GET")
     */
    public function confirmationAction(Registry $registry)
    {
        return $this->render('registry/confirmation.html.twig', array(
            'registry' => $registry,
        ));
    }

    /**
     * Finds and displays a registry entity.
     *
     * @Route("/{id}", name="registry_show")
     * @Method("GET")
     */
    public function showAction(Registry $registry)
    {
        $deleteForm = $this->createDeleteForm($registry);

        return $this->render('registry/show.html.twig', array(
            'registry' => $registry,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing registry entity.
     *
     * @Route("/{id}/edit", name="registry_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Registry $registry)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $deleteForm = $this->createDeleteForm($registry);
        $editForm = $this->createForm('AppBundle\Form\RegistryType', $registry);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('registry_edit', array('id' => $registry->getId()));
        }

        return $this->render('registry/edit.html.twig', array(
            'registry' => $registry,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a registry entity.
     *
     * @Route("/{id}", name="registry_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Registry $registry)
    {
        $form = $this->createDeleteForm($registry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($registry);
            $em->flush();
        }

        return $this->redirectToRoute('registry_index');
    }

    /**
     * Creates a form to delete a registry entity.
     *
     * @param Registry $registry The registry entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Registry $registry)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registry_delete', array('id' => $registry->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
