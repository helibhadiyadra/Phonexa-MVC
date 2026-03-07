<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
<style>
body
{
    font-family: Arial, Helvetica, sans-serif;
    background:#f3f4f6;
    margin:0;
    padding:0;
}
h2
{
    text-align:center;
    margin-top:40px;
    font-size:30px;
}
form
{
    width:500px;
    margin:30px auto;
    background:white;
    padding:40px;
    border-radius:12px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}
label
{
    display:block;
    margin-top:25px;
    font-weight:bold;
    margin-bottom:6px;
    font-size: 19px;
    padding-bottom: 1px;
}
input
{
    width:100%;
    padding:8px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:18px;
}
button
{
    width:200px;
    margin:45px auto 0;
    display:block;
    padding:12px;
    background:black;
    color:white;
    border:none;
    border-radius:8px;
    font-size:20px;
    cursor:pointer;
}
p{
    text-align:center;
    font-weight:bold;
    font-size: 18px;
}
a
{
    display: block;
    width: fit-content;
    margin: 20px auto;   
    padding: 8px 20px;
    background: black;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 21px;
}
</style>

<h2>Update Profile</h2>

<?php if(isset($success)) { ?>
<p style="color:green;"><?php echo $success; ?></p>
<?php } ?>

<form method="POST">

<label>First Name</label>
<input type="text" name="first_name" class="form-control" value="<?php echo $_SESSION['user']['first_name']; ?>" required>

<label>Last Name</label>
<input type="text" name="last_name" class="form-control" value="<?php echo $_SESSION['user']['last_name']; ?>" required>

<label>Email</label>
<input type="email" name="email" class="form-control" value="<?php echo $_SESSION['user']['email']; ?>" required>

<label>New Password</label>
<input type="password" name="password" class="form-control"placeholder="Leave blank if not changing">

<button type="submit">Update Profile</button>

</form>

<a href="/Phonexa-MVC/Dashboard">Back</a>
</body>
</html>







