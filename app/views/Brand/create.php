
<!DOCTYPE html>
<html>
<head>
    <title>Add Brand</title>
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
    font-size: 30px;
    text-align: center;
    margin: 0 0 20px 0;  
    padding-top: -250px;
    padding-bottom: 15px;
}
form 
{
    width: 550px;
    height: 300px;
    justify-content: center;
    align-items: center;
    padding: 30px 15px 35px 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}
label
{
    display: block;
    padding-top: 15px;
    margin-top: 5px;
    margin-bottom: -9px;
    font-weight: bold;
    font-size: 20px;
}
input[type="text"],
input[type="number"],
input[type="file"],
textarea,
select
{
    width: 100%;
    font-family: Arial, Helvetica, sans-serif;
    padding: 9px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    font-size: 18px;
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
    font-size: 20px;
    cursor: pointer;
}
</style>
<h2>Add Brand</h2>

<form action="/Phonexa-MVC/CreateBrand" method="POST" enctype="multipart/form-data">

    <label>Brand Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Upload Image:</label><br>
    <input type="file" name="image" required><br><br>

    <input type="submit" name="submit" value="Add Brand">

</form>

</body>
</html>
