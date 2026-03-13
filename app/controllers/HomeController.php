<?php

require_once "../app/models/Product.php";
require_once "../app/models/Brand.php";

class HomeController
{
    public function index()
    {
        $productModel = new Product();
        $brandModel = new Brand();

        $brands = $brandModel->getAllBrands();

        $limit = 4;

        $page = isset($_POST['page']) ? $_POST['page'] : 1;

        $offset = ($page - 1) * $limit;

        // If search or brand filter used
        if(isset($_POST['search']) || isset($_POST['brand']))
        {
            $search = $_POST['search'] ?? '';
            $brand = $_POST['brand'] ?? '';

            $products = $productModel->filterProducts($search, $brand);

            $totalPages = 0; // disable pagination
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