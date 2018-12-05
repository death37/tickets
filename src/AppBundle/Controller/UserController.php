<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller
{

    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function indexAction(AuthorizationCheckerInterface $authChecker)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        

        return $this->render('user/show.html.twig', array(
                'user' => $user,
        ));
    }
    /**
     * Lists all user entities.
     *
     * @Route("/usercsvtable", name="user_csv_table")
     * @Method("GET")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function usercsvtableAction(AuthorizationCheckerInterface $authChecker){
        
    return $this->render('user/addcsv.html.twig');
    }
    /**
     * Finds and displays a user entity.
     *
     * @Route("/show/{id}", name="user_show")
     * @Method("GET")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function showAction(User $user)
    {

        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
                    'user' => $user,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function newAction(Request $request, EventDispatcherInterface $eventDispatcher)
    {
        $user = $this->getUser();
        $dataEntreprise = $user->getEntreprise();
        
        $user1 = new User();
        
      
        $form = $this->createForm('AppBundle\Form\UserType', $user1);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
          
            $data = $form->getData();
            $eventDispatcher->dispatch(
                    'addMonoUser.event.mail', new UserMailEvent($user, $dataEntreprise, $data)
            );

        
         

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', array(
                    'user1' => $user1,
                    'form' => $form->createView(),
        ));
    }
    
    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     *
     */
    public function editAction(Request $request, User $user, FileUploader $fileUploader)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $dataEntreprise = $user->getEntreprise();
        

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            if ($user->isResponsable() == 1)
            {
                $user->addEntrepriseDroit($this->getUser()->getEntreprise());
            }
            else
            {
                if ($user->hasEntrepriseDroit($this->getUser()->getEntreprise()))
                {
                    $user->removeEntrepriseDroit($this->getUser()->getEntreprise());
                }
            }
            $manager = $this->get('oneup_uploader.orphanage_manager')->get('img_photo');
            $files = $manager->uploadFiles();

            if (count($files))
            {
                $imagePre = $em->getRepository('AppBundle:Image')->findOneBy([
                    'imagePlace' => 'photo',
                    'dataEntreprise' => $dataEntreprise,
                ]);

                if ($imagePre)
                    $imagePre->setImagePlace(null);

                $image = new Image();
                $image->setUser($user);
                $fileName = $fileUploader->upload($files[(count($files) - 1)], $image->getPath());
                $image->setDataEntreprise($dataEntreprise);
                $image->setDatecrea(new \DateTime());
                $image->setImageName($fileName);
                $image->setImagePlace("photo");
                $user->addImage($image);
                $user->setImageProfile($image);
                $em->persist($image);
                $em->flush();
            }
            
            
            $this->getDoctrine()->getManager()->flush();
            
            if($user->hasRole("ROLE_GERANT"))
                return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', array(
                    'user' => $user,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function deleteAction(AuthorizationCheckerInterface $authChecker, User $userSelect)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        if (!($listUsers = $authChecker->isGranted('ROLE_GERANT') ? $em->getRepository('AppBundle:User')->getUsersByEntreprises($user->getEntreprises()) : $em->getRepository('AppBundle:User')->getUsersByDataEntreprises($user->getEntrepriseDroits())))
            throw new AccessDeniedException('Unable to access this page!');

        if (!in_array($userSelect, $listUsers, true))
            throw new AccessDeniedException('Unable to access this page!');

        $em = $this->getDoctrine()->getManager();
        $em->remove($userSelect);
        $em->flush();

        return (new Response(json_encode(true), 200, array('Content-Type' => 'application/json')));
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     *
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }
    
}
