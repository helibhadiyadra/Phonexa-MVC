<!DOCTYPE html>
<html>
<head>
    <title>My Wishlist</title>
</head>
<body>
<style>
body
{
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f4f6f9;
}
a 
{
    display: inline-block;
    margin: 15px auto;
    margin-left: 720px;
    padding: 8px 20px;
    background: #000000;
    color: white;
    font-size: 18px;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
    font-family: Arial, Helvetica, sans-serif;
    text-align: center;
}
</style>
<h2 style="text-align:center;">My Wishlist</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap; justify-content:center;">

<?php if (!empty($products)) : ?>
    <?php foreach ($products as $product) : ?>

        <div style="border:1px solid #ccc; background-color:#fff; padding:20px; width:200px; text-align:center; border-radius:4px;">

            <h4><?= $product['name'] ?></h4>
            <p><?= $product['price'] ?></p>

            <img src="/Phonexa-MVC/public/uploads/<?= $product['image'] ?>" width="120">   

        </div>

    <?php endforeach; ?>

<?php else : ?>

    <p>No items in wishlist</p>

<?php endif; ?>

</div>

<a href="/Phonexa-MVC/Home">Back</a>
</body>
</html>

