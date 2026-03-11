<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {

    private $user;

    public function __construct() 
    {
        $this->user = new User();
    }

    public function login() 
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->user->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) 
            {

                $_SESSION['user'] = $user;

                header("Location: /Phonexa-MVC/Dashboard");
                exit;

            } 
            else 
            {
                $error = "Invalid Email or Password";
            }
        }

        require_once __DIR__ . '/../views/Auth/login.php';
    }

    public function logout() 
    {
        session_destroy();
        header("Location: /Phonexa-MVC/Login");
        exit;
    }
}