<?php
/** @var mysqli_result $brands  */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
<style>
body
{
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f4f6f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    overflow: hidden;
}
h2 
{
    font-size: 28px;
    text-align: center;
    margin: 0 0 20px 0;  
}
form 
{
    width: 600px;
    padding: 18px 25px 20px 25px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}
label
{
    display: block;
    margin-top: 6px;
    margin-bottom: -10px;
    font-weight: bold;
    font-size: 18px;
}
input[type="text"],
input[type="number"],
input[type="file"],
textarea,
select
{
    width: 100%;
    font-family: Arial, Helvetica, sans-serif;
    padding: 6px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-size: 18px;
}
textarea
{
    height: 70px;
    resize: none;
}
input[type="submit"],
button 
{
    display: block;
    margin: 18px auto 0 auto;
    padding: 8px 25px;
    background-color: black;
    color: white;
    border: 2px solid black;
    border-radius: 6px;
    font-size: 18px;
    cursor: pointer;
}
</style>
<h2>Add Product</h2>

<form action="/Phonexa-MVC/CreateProduct" method="POST" enctype="multipart/form-data">

    <label>Product Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="40" required></textarea><br><br>

    <label>Upload Image:</label><br>
    <input type="file" name="image[]" multiple><br><br>

    <label>Price:</label><br>
    <input type="number" name="price" required><br><br>

    <label>Brand</label><br>
    <select name="brand_id" class="form-control" required>
        <option value="">Select Brand</option>
        <?php while($brand = mysqli_fetch_assoc($brands)) : ?>
            <option value="<?= $brand['id']; ?>">
                <?= $brand['name']; ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <label>Status:</label><br>
    <select name="status">
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
    </select><br>

    <input type="submit" name="submit" value="Add Product">

</form>

</body>
</html>
