<?php require_once __DIR__.'/layouts/header.php'; ?>
<!DOCTYPE html>
<html>
<head>

<title>Home</title>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>

#productContainer
{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:40px;
    margin-top:30px;
}
.product-card
{
    width:220px;
    border:1px solid #ddd;
    border-radius:8px;
    padding:15px;
    background: #fff;
    text-align:center;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
    transition:0.3s;
}
.product-card:hover
{
    transform:translateY(-5px);
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}
.product-card h4
{
    margin-bottom:10px;
    color:#333;
    font-size: 18px;
}
.product-card p
{
    font-weight:bold;
    color:#333;
    font-size: 17px;
}
.product-card button
{
    margin-top:10px;
    padding:6px 12px;
    border:none;
    background:#333;
    color:white;
    border-radius:4px;
    cursor:pointer;
}
.product-card button:hover
{
    background:black;
}
h2
{
    text-align: center;
    margin-bottom: 20px;
    font-size: 26px;
}
select
{
    text-align: center;
    font-size: 19px;
}
.search-box
{
    text-align: center;
    margin-bottom: 20px;
}
input,
button
{
    font-size:18px;
}
#brandFilter,
#brandSearch,
#searchBtn
{
    margin:5px;
    padding:5px;
}
.product-card img
{
    width:100px;
    height:auto;
    margin:10px 25px;
    align-items: center;
}

</style>

</head>

<body>

<h2>Products</h2>

<!-- Brand Dropdown -->
<div class="search-box">
<select id="brandFilter">
<option value="">All Brands</option>

<?php foreach($brands as $brand){ ?>

<option value="<?= $brand['id'] ?>">
<?= $brand['name'] ?>
</option>

<?php } ?>

</select>

<!-- Search Bar-->
<input type="text" id="brandSearch" placeholder="Search Brand">

<button id="searchBtn">Search</button>

</div>
<br><br>

<div id="productContainer">

<?php foreach($products as $product){ ?>

<div class="product-card">

<h4><?= $product['name'] ?></h4>

<p><?= $product['price'] ?></p>

<img src="/Phonexa-MVC/public/uploads/<?= $product['image'] ?>" width="100">

<a href="/Phonexa-MVC/ProductDetail/<?= $product['id'] ?>">
<button style="font-size: 19px;">Details</button>
</a>

</div>

<?php } ?>

</div>


<script src="/Phonexa-MVC/public/js/Home.js"></script>

</body>
</html>
<?php require_once __DIR__.'/layouts/footer.php'; ?>