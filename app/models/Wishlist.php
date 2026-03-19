<?php
require_once __DIR__ . '/../../config/database.php';

class Wishlist
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getWishlistProductIds($user_id)
    {
        $query = "SELECT product_id FROM wishlist WHERE user_id = '$user_id'";
        $result = mysqli_query($this->conn, $query);

        $ids = [];

        while ($row = mysqli_fetch_assoc($result)) 
        {
            $ids[] = $row['product_id'];
        }

        return $ids;
    }
    public function getProductsByIds($ids)
    {
        if (empty($ids)) return [];

        $ids = implode(',', $ids);

        $query = "SELECT * FROM products WHERE id IN ($ids)";
        $result = mysqli_query($this->conn, $query);

        $products = [];

        while ($row = mysqli_fetch_assoc($result)) 
        {
            $products[] = $row;
        }

        return $products;
    }
    public function getWishlistProducts($user_id)
    {
        $query = "SELECT p.* 
                FROM wishlist w
                JOIN products p ON w.product_id = p.id
                WHERE w.user_id = '$user_id'";

        $result = mysqli_query($this->conn, $query);

        $products = [];

        while ($row = mysqli_fetch_assoc($result)) 
        {
            $products[] = $row;
        }

        return $products;
    }

    public function add($user_id, $product_id)
    {
        $query = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";
        return mysqli_query($this->conn, $query);
    }

    public function remove($user_id, $product_id)
    {
        $query = "DELETE FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
        return mysqli_query($this->conn, $query);
    }

    public function exists($user_id, $product_id)
    {
        $query = "SELECT * FROM wishlist WHERE user_id='$user_id' AND product_id='$product_id'";
        $result = mysqli_query($this->conn, $query);

        return mysqli_num_rows($result) > 0;
    }
}