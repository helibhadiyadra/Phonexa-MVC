<?php
/** @var array $brand */
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Brand</title>
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
    overflow: hidden;
}
h2 
{
    margin-top: 20px;
    font-size: 30px;
    margin-bottom: 25px;
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
    padding: 10px;
    margin-top: 4px;
    margin-bottom: 20px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 18px;
    box-sizing: border-box;
}
img 
{
    margin-top: 8px;
    margin-bottom: 8px;
    border-radius: 6px;
    height: 100px;
    width: 90px;
}
form img 
{
    display: inline-block;
    vertical-align: middle;
    margin-left: 15px;
    border-radius: 8px;
    font-size: 17px;
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
    background: #000000;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 6px;
    cursor: pointer;
    display: block;
    margin: 25px auto 10px;
    transition: 0.3s;
    font-size: 20px;
}
label
{
    display: block;
    margin-top: 8px;
    margin-bottom: 2px;
    font-weight: bold;
    font-size: 20px;
    padding-top: 20px;
    padding-bottom: 5px;
}
input[type="submit"]:hover 
{
    background: #000;
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
    font-size: 20px;
}
</style>
<h2>Edit Brand</h2>

<form action="/Phonexa-MVC/UpdateBrand" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $brand['id']; ?>">

    <label>Brand Name:</label>
    <input type="text" name="name" value="<?php echo $brand['name']; ?>">

    Current Image:
    <img src="/Phonexa-MVC/public/uploads/<?php echo $brand['image']; ?>" width="100">

    Update Image:
    <input type="file" name="image">

    <input type="submit" name="update" value="Update Brand">

</form>

<br>
<a href="/Phonexa-MVC/BrandList">Back</a>

</body>
</html>