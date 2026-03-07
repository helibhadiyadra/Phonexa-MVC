<?php
require_once __DIR__ . '/../../config/database.php';

class Brand
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll()
    {
        $query = "SELECT * FROM brands ORDER BY id ASC";
        return mysqli_query($this->conn, $query);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM brands WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }

    public function insert($name, $image)
    {
        $query = "INSERT INTO brands (name, image)
                  VALUES ('$name', '$image')";
        return mysqli_query($this->conn, $query);
    }

    public function update($id, $name, $image)
    {
        $query = "UPDATE brands SET 
                  name='$name',
                  image='$image'
                  WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }

    public function delete($id)
    {
        $query = "DELETE FROM brands WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }
    
    public function getProductsByBrand($brand_id)
    {
        $query = "SELECT * FROM products WHERE brand_id = $brand_id";
        return mysqli_query($this->conn, $query);
    }
    public function countBrands()
    {
        $query = "SELECT COUNT(*) as total FROM brands";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
}