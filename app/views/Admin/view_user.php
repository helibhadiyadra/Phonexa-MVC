<!DOCTYPE html>
<html>
<head>
    <title>View Product</title>
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
    margin: 10px auto;  
    background: #ffffff;
    white-space: nowrap;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 19px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
strong 
{
    display: inline-block;
    width: 100px;
    margin-right: 10px;
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
</style>
<h2>View User</h2>

<p><strong>ID:</strong> <?php echo $user['id']; ?></p>
<p><strong>First Name:</strong> <?php echo $user['first_name']; ?></p>
<p><strong>Last Name:</strong> <?php echo $user['last_name']; ?></p>
<p><strong>Email:</strong> <?php echo $user['email']; ?></p>
<p><strong>Role:</strong> <?php echo $user['role']; ?></p>

<a href="/Phonexa-MVC/UsersList">Back</a>

</body>
</html>