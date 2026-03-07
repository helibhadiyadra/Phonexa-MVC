<?php
require_once __DIR__ . '/../../config/database.php';

class Product
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll()
    {
        $query = "SELECT products.*, brands.name AS brand_name 
                  FROM products 
                  LEFT JOIN brands ON products.brand_id = brands.id
                  ORDER BY products.id ASC";
        return mysqli_query($this->conn, $query);
    }

    public function getById($id)
    {
        $query = "SELECT products.*, brands.name AS brand_name 
                  FROM products 
                  LEFT JOIN brands ON products.brand_id = brands.id
                  WHERE products.id = $id";
        return mysqli_query($this->conn, $query);
    }

    public function insert($name, $description, $price, $status, $image, $brand_id)
    {
        $query = "INSERT INTO products (name, description, price, status, image, brand_id)
                  VALUES ('$name', '$description', '$price', '$status', '$image', '$brand_id')";
        return mysqli_query($this->conn, $query);
    }

    public function update($id, $name, $description, $price, $status, $image, $brand_id)
    {
        $query = "UPDATE products SET 
                  name='$name',
                  description='$description',
                  price='$price',
                  status='$status',
                  image='$image',
                  brand_id='$brand_id'
                  WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }

    public function delete($id)
    {
        $query = "DELETE FROM products WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }
    public function countProducts()
    {
        $query = "SELECT COUNT(*) as total FROM products";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
}