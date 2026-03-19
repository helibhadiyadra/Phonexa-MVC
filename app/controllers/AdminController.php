<?php

class AdminController 
{
    public function __construct() 
    {

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

        $old_password = $_POST['old_password'];
        $new_password = $_POST['password'];

        if (!empty($new_password))
        {
            if (!password_verify($old_password, $user['password']))
            {
                $error = "Old password is incorrect";
            }
            else
            {
                $password = password_hash($new_password, PASSWORD_DEFAULT);
            }
        }
        else
        {
            $password = $user['password'];
        }

        if (!isset($error))
        {
            $userModel->updateProfile($user['id'], $first_name, $last_name, $email, $password);

            $_SESSION['user']['first_name'] = $first_name;
            $_SESSION['user']['last_name']  = $last_name;
            $_SESSION['user']['email']      = $email;
            $_SESSION['user']['password']   = $password;

            $success = "Profile updated successfully";
        }
    }
        require_once __DIR__ . '/../views/Admin/profile.php';
    }
    // To view users
    public function users() 
    {
        require_once __DIR__ . '/../models/User.php';

        $userModel = new User();
        $users = $userModel->getUsers();

        require_once __DIR__ . '/../views/Admin/users.php';
    }
    public function viewUser($id)
    {
        require_once __DIR__ . '/../models/User.php';

        $userModel = new User();
        $user = $userModel->getUserById($id);

        require_once __DIR__ . '/../views/Admin/view_user.php';
    }
    public function editUser($id)
    {
        require_once __DIR__ . '/../models/User.php';

        $userModel = new User();
        $user = $userModel->getUserById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {

            $first_name = $_POST['first_name'];
            $last_name  = $_POST['last_name'];
            $email      = $_POST['email'];

            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];

            if (!empty($new_password)) 
            {

                if (!password_verify($old_password, $user['password'])) 
                {
                    $error = "Old password is incorrect";
                } 
                else 
                {
                    $password = password_hash($new_password, PASSWORD_DEFAULT);
                }

            } 
            else 
            {
                $password = $user['password'];
            }

            if (!isset($error)) 
            {
                $userModel->updateUser($id, $first_name, $last_name, $email, $password);
                $success = "User updated successfully";

                $user = $userModel->getUserById($id);
            }
        }

        require_once __DIR__ . '/../views/Admin/edit_user.php';
    }
    public function deleteUser($id)
    {
        require_once __DIR__ . '/../models/User.php';

        $userModel = new User();
        $userModel->deleteUser($id);

        header("Location: /Phonexa-MVC/UsersList");
    }
    // Enable Disable Users
    public function disableUser($id)
    {
        require_once __DIR__ . '/../models/User.php';
        $model = new User();
        $model->updateUserStatus($id, 'inactive');
        $_SESSION['success'] = "User disabled successfully";
        header("Location: /Phonexa-MVC/UsersList");
        exit;
    }

    public function enableUser($id)
    {
        require_once __DIR__ . '/../models/User.php';
        $model = new User();
        $model->updateUserStatus($id, 'active');
        $_SESSION['success'] = "User enabled successfully";
        header("Location: /Phonexa-MVC/UsersList");
        exit;
    }
}