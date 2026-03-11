<?php
require_once __DIR__ . '/../../config/database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    
    public function findByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }
    public function updateProfile($id, $first_name, $last_name, $email, $password)
    {
        $query = "UPDATE users 
                SET first_name='$first_name',
                    last_name='$last_name',
                    email='$email',
                    password='$password'
                WHERE id='$id'";

        return mysqli_query($this->conn, $query);
    }
}