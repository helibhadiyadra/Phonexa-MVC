<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';

class ProductController
{
    private $product;

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
        $this->product = new Product();    
    }

    public function index()
    {
        $products = $this->product->getAll();
        require_once __DIR__ . '/../views/Product/index.php';
    }

    public function create()
    {
        $brandModel = new Brand();
        $brands = $brandModel->getAll();
        require_once __DIR__ . '/../views/Product/create.php';
    }

    public function store()
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $status = $_POST['status'];

        $images = [];

        if (!empty($_FILES['image']['name'][0])) {

            foreach ($_FILES['image']['name'] as $key => $filename) {

                $newName = time() . "_" . $filename;
                $tmpName = $_FILES['image']['tmp_name'][$key];

                $uploadPath = __DIR__ . "/../../public/uploads/" . $newName;
                move_uploaded_file($tmpName, $uploadPath);

                $images[] = $newName;
            }
        }

        $imageString = implode(',', $images);

        $brand_id = $_POST['brand_id'];
        $this->product->insert($name, $description, $price, $status, $imageString ,$brand_id);

        header("Location: /Phonexa-MVC/ProductList");
    }

    public function edit()
    {
        $id = $_GET['id'];
        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);
        $brandModel = new Brand();
        $brands = $brandModel->getAll();

        require_once __DIR__ . '/../views/Product/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $status = $_POST['status'];

        $result = $this->product->getById($id);
        $oldProduct = mysqli_fetch_assoc($result);

        $oldImages = explode(',', $oldProduct['image']);

        if (!empty($_FILES['image']['name'][0]))
        {
            foreach ($oldImages as $oldImage) 
            {
                $oldPath = __DIR__ . "/../../public/uploads/" . $oldImage;
                if (!empty($oldImage) && file_exists($oldPath)) 
                {
                    unlink($oldPath);
                }
            }

            $images = [];

            foreach ($_FILES['image']['name'] as $key => $filename) 
            {

                $newName = time() . "_" . $filename;
                $tmpName = $_FILES['image']['tmp_name'][$key];

                $uploadPath = __DIR__ . "/../../public/uploads/" . $newName;
                move_uploaded_file($tmpName, $uploadPath);

                $images[] = $newName;
            }

            $imageToSave = implode(',', $images);

        } else 
        {

            $imageToSave = $oldProduct['image'];
        }

        $brand_id = $_POST['brand_id'];

        $this->product->update($id, $name, $description, $price, $status, $imageToSave, $brand_id);

        $_SESSION['success'] = "Record $id updated successfully";
        header("Location: ProductList");
        exit;
    }

   
     public function delete()
    {
        $id = $_GET['id'];

        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);

        if ($product) 
        {
            $images = explode(',', $product['image']);

            foreach ($images as $img) {
                $imagePath = __DIR__ . "/../../public/uploads/" . $img;
                if (!empty($img) && file_exists($imagePath)) 
                {
                    unlink($imagePath);
                }
            }

            $this->product->delete($id);
        }

        header("Location: /Phonexa-MVC/ProductList");
    }
    public function view()
    {
        $id = $_GET['id'];
        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);

        require_once __DIR__ . '/../views/Product/view.php';
    }
}
