<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserManagType; 
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="app_users")
     */
    public function index(UserRepository $repo): Response
    {
        return $this->render('user/index.html.twig', [
            'user' =>$repo-> findAll(),
        ]);
    }
    /**
     * @Route("/user/account", name="user_account", methods={"GET"})
     */
    public function cusAccountAction(): Response
    {
        $user = $this->getUser();
        return $this->render('user/show.html.twig', [
            'user'=>$user]);
    }

    
}
