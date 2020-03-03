<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class roleController  extends AbstractController
{
    /**
     * @Route("/role", name="role")
     */
    public function viewRole(): Response
    {
        $lista=[];
        if(in_array("ROLE_ADMIN",$this->getUser()->getRoles())){
            $lista=$this->roleAdmin();
        }
        else if(in_array("ROLE_SUPER",$this->getUser()->getRoles())){
            $lista=$this->roleSuper();
        }
        else if(in_array("ROLE_USER",$this->getUser()->getRoles())){
            $lista=$this->roleUser();
        }
        return $this->render('roles/viewRoles.html.twig', ['users' => $lista]);

    }


    private function roleUser(){
        $entityManager=$this->getDoctrine()->getManager();
        return  $entityManager->getRepository(User::class)->findByRole(["ROLE_USER"]);
    }
    private function roleSuper(){
        $entityManager=$this->getDoctrine()->getManager();

        return $entityManager->getRepository(User::class)->findByRole(["ROLE_USER","ROLE_SUPER"]);
    }
    private function roleAdmin(){
        $entityManager=$this->getDoctrine()->getManager();

        return $entityManager->getRepository(User::class)->findAll();
    }



}
