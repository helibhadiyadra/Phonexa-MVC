<?php
/** @var array $product */
?>
<!DOCTYPE html>
<html>
<head>
<title>Product Detail</title>

<style>
body 
{
    margin: 0;
    padding: 40px 0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f4f6f9;
    display: flex;
    flex-direction: column;
    align-items: center; 
}
h2 
{
    margin-top: -8px;
    margin-bottom: 20px;
    font-size: 28px;
    text-align: center;
}
p 
{
    width: 40%;
    margin: 8px auto;  
    background: #ffffff;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
strong 
{
    display: inline-block;
    width: 140px;
}
img 
{
    margin-top: 10px;
    height: 90px;
    display: inline-block;
    margin-right: 10px;
}
a 
{
    display: inline-block;
    margin: 15px auto;
    padding: 8px 20px;
    background: #000000;
    color: white;
    font-size: 18px;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
}
a:hover
{
    background:#333;
}
</style>

</head>

<body>

<h2>Product Detail</h2>

<p><strong>ID:</strong> <?php echo $product['id']; ?></p>
<p><strong>Name:</strong> <?php echo $product['name']; ?></p>
<p><strong>Description:</strong> <?php echo $product['description']; ?></p>
<p><strong>Price:</strong> <?php echo $product['price']; ?></p>
<p><strong>Brand Name:</strong> <?php echo $product['brand_name']; ?></p>
<p><strong>Status:</strong> <?php echo $product['status']; ?></p>

<p><strong>Images:</strong><br>
<?php 
$images = explode(',', $product['image']);
foreach ($images as $img) 
{
?>
    <img src="/Phonexa-MVC/public/uploads/<?php echo $img; ?>">
<?php 
}
?>
</p>

<br>

<a href="/Phonexa-MVC/Home">Back</a>

</body>
</html>