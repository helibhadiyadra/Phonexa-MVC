<?php
/** @var array $brand */
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Brand</title>
</head>
<body>
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
    font-size: 30px;
    text-align: center;
}
p 
{
    width: 40%;
    margin: 8px auto;  
    background: #ffffff;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 19px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
strong 
{
    display: inline-block;
    width: 100px;
}
img 
{
    margin-top: 10px;
    border-radius: 8px;
    display: block;
    height: 150px;
}
a 
{
    display: inline-block;
    margin: 5px auto -18px;   
    padding: 8px 20px;
    background: #000000;
    color: white;
    font-size: 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
}
.product-card 3
{
    background: #ffffff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    font-size: 18px;
    line-height: 1.8;
}
h3
{
    font-size: 20px;
}
</style>
<h2>View Brand</h2>

<p><strong>ID:</strong> <?php echo $brand['id']; ?></p>
<p><strong>Name:</strong> <?php echo $brand['name']; ?></p>
<p><strong>Image:</strong><br>
    <img src="/Phonexa-MVC/public/uploads/<?php echo $brand['image']; ?>" height="200" width="200">
</p>
<hr style="width:40%; margin:25px auto;">

<h3 style="text-align:center;">Products of this Brand</h3>

<?php if(isset($products) && mysqli_num_rows($products) > 0): ?>
    
    <?php while($product = mysqli_fetch_assoc($products)) : ?>
        <p class="product-card">
            <strong style="width:120px; display:inline-block; margin-bottom:2px;">Name:</strong> <?php echo $product['name']; ?><br>
            <strong style="width:120px; display:inline-block; margin-bottom:2px;">Description:</strong> <?php echo $product['description']; ?><br>
            <strong style="width:120px; display:inline-block; margin-bottom:2px;">Price:</strong> <?php echo $product['price']; ?><br>
            <strong style="width:120px; display:inline-block; margin-bottom:2px;">Status:</strong> <?php echo $product['status']; ?><br>
            <strong>Image:</strong> <img style="vertical-align:middle; display:inline-block;" src="/Phonexa-MVC/public/uploads/<?php echo $product['image']; ?>" width="100"> 
        </p>
    <?php endwhile; ?>

<?php else: ?>
    <p style="text-align:center;">No products found for this brand</p>
<?php endif; ?>

<br>
<a href="/Phonexa-MVC/BrandList">Back</a>

</body>
</html>
