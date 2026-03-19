<?php

require_once "../app/models/Product.php";
require_once "../app/models/Brand.php";
require_once "../app/models/Wishlist.php";

class HomeController
{
    public function index()
    {
        $productModel = new Product();
        $brandModel = new Brand();

        $brands = $brandModel->getAllBrands(); 

        $wishlistModel = new Wishlist();
        $user_id = $_SESSION['user_id'] ?? 0;
        $wishlistIds = $wishlistModel->getWishlistProductIds($user_id);
        $user_id = $_SESSION['user_id'] ?? 0;

        if($user_id)
        {
            $wishlistIds = $wishlistModel->getWishlistProductIds($user_id);
        } 
        else 
        {
            $wishlistIds = []; 
        }

        $wishlistCount = 0;

        if ($user_id) 
        {
            $wishlistItems = $wishlistModel->getWishlistProducts($user_id);
            $wishlistCount = count($wishlistItems);
        }

        $limit = 4;

        $page = isset($_POST['page']) ? $_POST['page'] : 1;

        $offset = ($page - 1) * $limit;

        if(!empty($_POST['search']) || !empty($_POST['brand']))
        {
            $search = $_POST['search'] ?? '';
            $brand = $_POST['brand'] ?? '';

            $products = $productModel->filterProducts($search, $brand);

            $totalPages = 0; 
        }
        else
        {
            $products = $productModel->getProductsPaginated($limit, $offset);

            $totalProducts = $productModel->getTotalProducts();

            $totalPages = ceil($totalProducts / $limit);
        }

        require "../app/views/Home.php";
    }

}