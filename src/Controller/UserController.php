<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\DriverManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(): Response
    {
        return $this->render('register/register.html.twig');
    }

    #[Route('/users', name: 'app_show_users')]
    public function showAll(UsersRepository $user): JsonResponse
    {
        $response = $user->userData();
        return $this->json($response);        
    }
        
    #[Route('/showregister', name: 'app_show_user')]
    public function showUser(UsersRepository $user, Request $request): JsonResponse
    {

        $data = json_decode($request->getContent(), true);

        $response = $user->insertUserData($data['user'], $data['email'], $data['password'], $data['confirm']);

        // $response = $user->insertUserData($data['user'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT), password_hash($data['confirm'], PASSWORD_DEFAULT));

        // $userPW = $data['password'];
        // $userConfirm = password_verify($data['confirm'], $userPW);
        
        // if($userConfirm) {
        //     $response = ["auth"=>true];
        // } else {
        //     $reponse = ["auth"=>false];
        // }

        return $this->json($response);
    }


    #[Route('/recentuser', name: 'app_recentuser')]
    public function index(UsersRepository $user): JsonResponse
    {
        $response = $user->createdUser();
        return $this->json($response);
    }

    #[Route('/user', name: 'app_user')]
    public function recentUser(): Response
    {
        $user = new Users();
        return $this->render('user/index.html.twig', []);
    }

    #[Route('/userinfo', name: 'login_info')]
    public function loginInfo(UsersRepository $user): JsonResponse
    {
        $response = $user->logIn();
        return $this->json($response);
    }

    // STore This in DB
    // password_hash("string", PASSWORD_DEFAULT);
    // password_verify('password', "hash");
}
