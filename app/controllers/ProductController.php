<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';
require_once __DIR__ . '/../models/Wishlist.php';

class ProductController
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();  
        
        $publicRoutes = ["ProductDetail", "FilterBrand", "SearchBrand", "FilterPrice"];

        $request = $_SERVER['REQUEST_URI'];

        foreach ($publicRoutes as $route)
        {
            if (strpos($request, $route) !== false)
            {
                return;
            }
        }
            
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')
        {
            header("Location: /Phonexa-MVC/AdminLogin");
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
        header("Location: /Phonexa-MVC/ProductList");
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


    /*Website*/
    public function filterByBrand()
    {
        $brand_id = $_POST['brand_id'];

        $productModel = new Product();
        $products = $productModel->getProductsByBrand($brand_id);

        $wishlistModel = new Wishlist();

        $user_id = $_SESSION['user_id'] ?? 0;
        $wishlistIds = $wishlistModel->getWishlistProductIds($user_id);

        echo json_encode([
        "products" => $products,
        "wishlist" => $wishlistIds
        ]);

    }

    public function searchBrand()
    {
        $brand = $_POST['brand'];

        $productModel = new Product();
        $products = $productModel->searchBrandProducts($brand);

        $wishlistModel = new Wishlist();

        $user_id = $_SESSION['user_id'] ?? 0;
        $wishlistIds = $wishlistModel->getWishlistProductIds($user_id);

        echo json_encode([
        "products" => $products,
        "wishlist" => $wishlistIds
        ]);

    }
    public function detail()
    {

        if (!isset($_GET['id']) || empty($_GET['id']))
        {
            echo "Product not found";
            return;
        }

        $id = $_GET['id'];

        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);

        require_once __DIR__ . '/../views/product_detail.php';
    }
    /*Wishlist*/
    public function toggleWishlist()
    {
        
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user')
        {
            echo json_encode(["status" => "not_logged_in"]);
            return;
        }
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $action = $_POST['action'];

        require_once "../app/models/Product.php";
        $model = new Product();

        if ($action === "add")
        {
            $model->addToWishlist($user_id, $product_id);
            echo json_encode(["status" => "added"]);
        }
        else
        {
            $model->removeFromWishlist($user_id, $product_id);
            echo json_encode(["status" => "removed"]);
        }
    }
    public function addToWishlist()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user')
        {
            echo json_encode(["status" => "not_logged_in"]);
            return;
        }

        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];

        require_once "../app/models/Product.php";
        $model = new Product();

        $model->addToWishlist($user_id, $product_id);

        echo json_encode(["status" => "success"]);
    }
    //Price Dropdown
    public function filterByPrice()
    {
        $price = $_POST['price'];

        $range = explode("-", $price);

        $min = $range[0] ?? 0;
        $max = $range[1] ?? 100000;

        $productModel = new Product();
        $wishlistModel = new Wishlist();

        $products = $productModel->getByPrice($min, $max);

        $wishlist = [];

        if(isset($_SESSION['user_id']))
        {
            $wishlist = $wishlistModel->getWishlistProductIds($_SESSION['user_id']);
        }

        echo json_encode([
            "products" => $products,
            "wishlist" => $wishlist
        ]);
    }
}
