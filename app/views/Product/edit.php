<?php
/** @var mysqli_result $brands */
/** @var array $product */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
<style>
body  
{
    margin: 0;
    padding: 40px 0;
    background-color: #f4f6f9;
    font-family: Arial, Helvetica, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
}
h2 
{
    margin-top: -20px;
    font-size: 28px;
    margin-bottom: 20px;
}
form 
{
    background: #ffffff;
    padding: 25px 40px;
    width: 680px;
    font-size: 18px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
form 
{
    font-weight: 600;
}
input[type="text"],
input[type="number"],
input[type="file"],
textarea,
select 
{
    width: 100%;
    padding: 6px;
    margin-top: 4px;
    margin-bottom: 20px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 16px;
    font-family: Arial, Helvetica, sans-serif;
    box-sizing: border-box;
}
textarea 
{
    resize: none;
    height: 70px;
}
img 
{
    margin-top: 8px;
    margin-bottom: 8px;
    border-radius: 6px;
}
form img {
    display: inline-block;
    vertical-align: middle;
    margin-left: 15px;
}
input[type="file"] 
{
    display: inline-block;
    vertical-align: middle;
    width: 39%;
}
form img 
{
    margin-right: 5px;   
}
input[type="submit"] 
{
    background: #020202;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 6px;
    cursor: pointer;
    display: block;
    margin: 12px auto 0px;
    transition: 0.3s;
    font-size: 18px;
}
label
{
    display: block;
    margin-top: -3px;
    margin-bottom: 2px;
    font-weight: bold;
    font-size: 18px;
}
a 
{
    display: inline-block;
    margin-top: 2px;
    padding: 8px 20px;
    background: black;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 18px;
}
</style>
<h2>Edit Product</h2>

<form action="/Phonexa-MVC/UpdateProduct" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

    <label>Product Name:</label>
    <input type="text" name="name" value="<?php echo $product['name']; ?>">

    <label>Description:</label>
    <textarea name="description"><?php echo $product['description']; ?></textarea>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>">

    <label>Brand</label>
    <select name="brand_id" class="form-control" required>
        <?php while($brand = mysqli_fetch_assoc($brands)) : ?>
            <option value="<?= $brand['id']; ?>"
                <?= ($brand['id'] == $product['brand_id']) ? 'selected' : ''; ?>>
                <?= $brand['name']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Status:</label>
    <select name="status">
        <option value="Active" <?php if($product['status']=="Active") echo "selected"; ?>>Active</option>
        <option value="Inactive" <?php if($product['status']=="Inactive") echo "selected"; ?>>Inactive</option>
    </select>

    Current Image:
    <img src="/Phonexa-MVC/public/uploads/<?php echo $product['image']; ?>" width="100">

    Update Image:
    <input type="file" name="image[]" multiple>

    <input type="submit" name="update" value="Update Product">

</form>

<br>
<a href="/Phonexa-MVC/ProductList">Back</a>

</body>
</html>