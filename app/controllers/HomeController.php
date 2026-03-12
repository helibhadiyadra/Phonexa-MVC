<?php

require_once "../app/models/Product.php";
require_once "../app/models/Brand.php";

class HomeController
{
    public function index()
    {
        $productModel = new Product();
        $brandModel = new Brand();

        $products = $productModel->getAllProducts();
        $brands = $brandModel->getAllBrands();

        require "../app/views/home.php";
    }
}