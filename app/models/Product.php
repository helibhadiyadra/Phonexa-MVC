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
        $id = intval($id);
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

    /*Website*/
    public function getAllProducts()
    {
        $query = "SELECT * FROM products";
        $result = mysqli_query($this->conn, $query);

        $products = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            $products[] = $row;
        }

        return $products;
    }

    public function getProductsByBrand($brand_id)
    {
        $query = "SELECT * FROM products WHERE brand_id = $brand_id";
        $result = mysqli_query($this->conn, $query);

        $products = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            $products[] = $row;
        }

        return $products;
    }

    public function searchBrandProducts($brand_name)
    {
        $query = "SELECT p.* FROM products p
                JOIN brands b ON p.brand_id = b.id
                WHERE b.name LIKE '%$brand_name%'";

        $result = mysqli_query($this->conn, $query);

        $products = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            $products[] = $row;
        }

        return $products;
    }

    /*Pagination*/
    public function getProductsPaginated($limit, $offset)
    {
        $sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";
        return $this->conn->query($sql);
    }
    public function getTotalProducts()
    {
        $sql = "SELECT COUNT(*) as total FROM products";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    public function filterProducts($search, $brand)
    {
        $sql = "SELECT * FROM products WHERE 1=1";

        if($search != '')
        {
            $sql .= " AND name LIKE '%$search%'";
        }

        if($brand != '')
        {
            $sql .= " AND brand_id = '$brand'";
        }

        return $this->conn->query($sql);
    }
}