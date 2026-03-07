<?php

class AdminController 
{

    public function __construct() 
    {
        if (session_status() === PHP_SESSION_NONE) 
        {
            session_start();
        }

        if (!isset($_SESSION['user'])) 
        {
            header("Location: /Phonexa-MVC/Login");
            exit;
        }
    }

    public function dashboard() 
    {
        require_once __DIR__ . '/../models/Product.php';
        require_once __DIR__ . '/../models/Brand.php';

        $product = new Product();
        $brand = new Brand();

        $totalProducts = $product->countProducts();
        $totalBrands = $brand->countBrands();

        require_once __DIR__ . '/../views/Admin/dashboard.php';
    }
    public function profile()
    {
        if (!isset($_SESSION['user']))
        {
            header("Location: /Phonexa-MVC/Login");
            exit;
        }

        require_once __DIR__ . '/../models/User.php';
        $userModel = new User();

        $user = $_SESSION['user'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {

            $first_name = $_POST['first_name'];
            $last_name  = $_POST['last_name'];
            $email      = $_POST['email'];
            $password   = $_POST['password'];

            if (!empty($password)) 
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
            } 
            else 
            {
                $password = $user['password'];
            }

            $userModel->updateProfile($user['id'], $first_name, $last_name, $email, $password);

            $_SESSION['user']['first_name'] = $first_name;
            $_SESSION['user']['last_name']  = $last_name;
            $_SESSION['user']['email']      = $email;

            $success = "Profile updated successfully";
        }
        require_once __DIR__ . '/../views/Admin/profile.php';
    }
}