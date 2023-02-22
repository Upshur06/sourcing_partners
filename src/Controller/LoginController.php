<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(UsersRepository $user, Request $request): Response
    {   
        $data = json_decode($request->getContent(), true); 
        // $password = $_POST['password'];  
        // $userPW = $data;
        // $userConfirm = password_verify($password, $userPW);
        // $response = $user->userData($data[$password]);

        // $response; 

        // if($userConfirm) {
        //     $response = ["auth"=>true];
        // } else {
        //     $reponse = ["auth"=>false];
        // }
        
        return $this->render('login/login.html.twig', []);
    }

    #[Route('/dashboard', name: 'app_welcome_page')]
    public function welcomePage(): Response
    {

        return $this->render('login/welcome.html.twig', []);
    }
}
