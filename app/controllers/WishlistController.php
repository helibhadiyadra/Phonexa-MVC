<?php
require_once '../app/models/Product.php';
require_once '../app/models/Wishlist.php';

class WishlistController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) 
        {
            header("Location: /Phonexa-MVC/UserLogin");
            exit;
        }

        require_once "../app/models/Wishlist.php";

        $wishlistModel = new Wishlist();
        $products = $wishlistModel->getWishlistProducts($_SESSION['user_id']);

        require "../app/views/Wishlist/index.php";
    }
    public function toggleWishlist()
    {

        if (!isset($_SESSION['user_id'])) 
        {
            echo json_encode(["status" => "not_logged_in"]);
            return;
        }

        require_once "../app/models/Wishlist.php";

        $wishlistModel = new Wishlist();

        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $action = $_POST['action'];

        if ($action == "add") 
        {
            $wishlistModel->add($user_id, $product_id);
            echo json_encode(["status" => "added"]);
        } 
        else
        {
            $wishlistModel->remove($user_id, $product_id);
            echo json_encode(["status" => "removed"]);
        }
    }
}