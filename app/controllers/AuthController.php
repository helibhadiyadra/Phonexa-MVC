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
        if (!isset($_SESSION['login_type'])) 
        {
            $_SESSION['login_type'] = "user";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->user->findByEmail($email);

        if($user)
        {
            if($user['status'] == 'inactive')
            {
                echo "Your account is disabled by admin";
                return;
            }

            if ($user && password_verify($password, $user['password'])) 
            {

                if ($_SESSION['login_type'] == "admin" && $user['role'] != "admin") 
                {
                    $error = "You are not an admin!";
                }
                else if ($_SESSION['login_type'] == "user" && $user['role'] != "user") 
                {
                    $error = "You are not a user!";
                }
                else 
                {

                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user'] = $user;
                    $_SESSION['role'] = $user['role'];

                    if ($user['role'] == 'admin') 
                    {
                        header("Location: /Phonexa-MVC/Dashboard");
                    } else 
                    {
                        header("Location: /Phonexa-MVC/Home");
                    }
                    exit;
                }
            }
            else 
            {
                $error = "Invalid Email or Password";
            }
        }
        else 
        {
            echo "User not found";
        }
    }
        require_once __DIR__ . '/../views/Auth/login.php';
    }

    public function logout() 
    {
        session_destroy();
        header("Location: /Phonexa-MVC/AdminLogin");
        exit;
    }
}