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
    margin-bottom: 10px;
}
form 
{
    background: #ffffff;
    padding: 25px 40px;
    width: 500px;
    font-size: 18px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
form 
{
    font-weight: 600;
}
input[type="text"],
input[type="email"],
input[type="password"] 
{
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    margin-bottom: 20px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 18px;
    box-sizing: border-box;
}
button
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
    margin-top: 10px;
    margin-bottom: 2px;
    font-weight: bold;
    font-size: 18px;
}
a 
{
    display: inline-block;
    margin: 20px auto -10px;   
    padding: 8px 20px;
    background: #000000;
    color: white;
    font-size: 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
}
p
{
    text-align:center;
    font-weight:bold;
    font-size: 18px;
}
</style>
<h2>Edit User</h2>

<?php if(isset($error)): ?>
    <p style="color:red; text-align:center;"><?= $error; ?></p>
<?php endif; ?>

<?php if(isset($success)): ?>
    <p style="color:green; text-align:center;"><?= $success; ?></p>
<?php endif; ?>

<form method="POST">
    <label>First Name:</label>
    <input type="text" name="first_name" value="<?= $user['first_name']; ?>">

    <label>Last Name:</label>
    <input type="text" name="last_name" value="<?= $user['last_name']; ?>">

    <label>Email:</label>
    <input type="email" name="email" value="<?= $user['email']; ?>">

    <label>Old Password:</label>
    <input type="password" name="old_password" placeholder="Enter Old Password">

    <label>New Password:</label>
    <input type="password" name="new_password" placeholder="Leave blank if not changing">

    <button type="submit">Update User</button>
</form>

<a href="/Phonexa-MVC/UsersList">Back</a>

</body>
</html>