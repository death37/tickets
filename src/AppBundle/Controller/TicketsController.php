<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tickets;
use AppBundle\Entity\User;
use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Controller\DataTablesTrait;

/**
 * Ticket controller.
 *
 * @Route("tickets")
 */
class TicketsController extends Controller
{
    use DataTablesTrait;
    
    /**
     * Lists all ticket entities.
     *
     * @Route("/", name="tickets_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tickets = $em->getRepository('AppBundle:Tickets')->findAll();

        return $this->render('tickets/index.html.twig', array(
            'tickets' => $tickets,
        ));
    }

    /**
     * Creates a new ticket entity.
     *
     * @Route("/new", name="tickets_new")
     * @Method({"GET", "POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function newAction(Request $request)
    {
        $ticket = new Tickets();http://localhost:8000/tickets/new#
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $ticket->setUsers($user);
        
        $image = new Image();
        $ticket->addImage($image);
        $form = $this->createForm('AppBundle\Form\TicketsType',$ticket);
        $form->handleRequest($request);
        
        //https://omines.github.io/datatables-bundle/#installation

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($ticket);
            $em->flush();

            return $this->redirectToRoute('tickets_show', array('id' => $ticket->getId()));
        }

        return $this->render('tickets/new.html.twig', array(
            'user' => $user,
            'ticket' => $ticket,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ticket entity.
     *
     * @Route("/{id}", name="tickets_show")
     * @Method("GET")
     */
    public function showAction(Request $request,Tickets $ticket)
    {
        $table = $this->createDataTable()
            ->add('firstName', TextColumn::class, ['label' => 'customer.name', 'className' => 'bold'])
            ->add('lastName', TextColumn::class)
            ->createAdapter(ArrayAdapter::class, [
                ['firstName' => 'Donald', 'lastName' => 'Trump'],
                ['firstName' => 'Barack', 'lastName' => 'Obama'],
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        
        
        $deleteForm = $this->createDeleteForm($ticket);
        return $this->render('tickets/show.html.twig', [
            'datatable' => $table,
            'ticket' => $ticket,
            'delete_form' => $deleteForm->createView(),
            ]);
        
        
//        return $this->render('tickets/show.html.twig', array(
//            'ticket' => $ticket,
//            'delete_form' => $deleteForm->createView(),
//        ));
    }

    /**
     * Displays a form to edit an existing ticket entity.
     *
     * @Route("/{id}/edit", name="tickets_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tickets $ticket)
    {
        $deleteForm = $this->createDeleteForm($ticket);
        $editForm = $this->createForm('AppBundle\Form\TicketsType', $ticket);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tickets_edit', array('id' => $ticket->getId()));
        }

        return $this->render('tickets/edit.html.twig', array(
            'ticket' => $ticket,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ticket entity.
     *
     * @Route("/{id}", name="tickets_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tickets $ticket)
    {
        $form = $this->createDeleteForm($ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ticket);
            $em->flush();
        }

        return $this->redirectToRoute('tickets_index');
    }

    /**
     * Creates a form to delete a ticket entity.
     *
     * @param Tickets $ticket The ticket entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tickets $ticket)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tickets_delete', array('id' => $ticket->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
