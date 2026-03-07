<?php
require_once __DIR__ . '/../models/Brand.php';

class BrandController
{
    private $brand;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) 
        {
            session_start();
        }

        if (!isset($_SESSION['user'])) 
        {
            header("Location: /Phonexa-MVC/Login");
            exit;
        }
        $this->brand = new Brand();
    }

    public function index()
    {
        $brands = $this->brand->getAll();
        require_once __DIR__ . '/../views/Brand/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/Brand/create.php';
    }

    public function store()
    {
        $name = $_POST['name'];

        $image = $_FILES['image']['name'];
        $uploadPath = __DIR__ . "/../../public/uploads/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

        $this->brand->insert($name, $image);

        header("Location: /Phonexa-MVC/BrandList");
    }

    public function edit()
    {
        $id = $_GET['id'];
        $result = $this->brand->getById($id);
        $brand = mysqli_fetch_assoc($result);

        require_once __DIR__ . '/../views/Brand/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];

        $result = $this->brand->getById($id);
        $oldBrand = mysqli_fetch_assoc($result);

        $oldImage = $oldBrand['image'];

        if (!empty($_FILES['image']['name'])) 
        {
            $newImage = $_FILES['image']['name'];
            $tmpName = $_FILES['image']['tmp_name'];

            $uploadPath = __DIR__ . "/../../public/uploads/" . $newImage;
            move_uploaded_file($tmpName, $uploadPath);

            $oldImagePath = __DIR__ . "/../../public/uploads/" . $oldImage;

            if (!empty($oldImage) && file_exists($oldImagePath))
            {
                unlink($oldImagePath);
            }

            $imageToSave = $newImage;
        } 
        else 
        {
            $imageToSave = $oldImage;
        }

        $this->brand->update($id, $name, $imageToSave);

        $_SESSION['success'] = "Record $id updated successfully";
        header("Location: BrandList");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'];

        $result = $this->brand->getById($id);
        $brand = mysqli_fetch_assoc($result);

        if ($brand) 
        {
            $image = $brand['image'];

            $imagePath = __DIR__ . "/../../public/uploads/" . $image;

            if (!empty($image) && file_exists($imagePath))
            {
                unlink($imagePath);
            }

            $this->brand->delete($id);
        }

        header("Location: /Phonexa-MVC/BrandList");
    }

    public function view()
    {
        $id = $_GET['id'];
        $brandModel = new Brand();
        $brandResult = $brandModel->getById($id);
        $brand = mysqli_fetch_assoc($brandResult);
        $products = $brandModel->getProductsByBrand($id);

        require_once __DIR__ . '/../views/Brand/view.php';
    }
}