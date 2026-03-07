<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <style>
        body 
        {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form 
        {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            width: 400px;
            height: 250px;
            margin-top: 25px;
        }
        h2 
        {
            position: absolute;
            top: 100px;
            font-size: 30px;
            text-align: center;
        }
        input[type="email"],
        input[type="password"] 
        {
            width: 100%;
            padding: 10px;
            margin-top: 7px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        label
        {
            padding-bottom: 8px;
            font-size: 18px;
            font-weight: bold;
        }
        button 
        {
            width: 35%;
            padding: 12px 35px;
            background: black;
            display: block;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 20px;    
            margin: 6px auto;
        }
        button:hover 
        {
            background: #333;
        }
        h2 p 
        {
            color: red;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
        }
    </style>
<h2>Admin Login

<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
</h2>
<form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>