<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body 
        {
            margin: 0;
            font-family: Arial;
            display: flex;
            height: 100vh;
        }
        .sidebar 
        {
            width: 220px;
            background: #111;
            color: white;
            height: 100vh;
            padding: 20px;
        }
        .sidebar a 
        {
            display: block;
            color: white;
            text-decoration: none;
            margin: 15px 0;
            font-size: 20px;
            padding-bottom: 7px;
            padding-left: 7px;
        }
        .sidebar h3
        {
            font-size: 22px;
            padding-top: -20px;
            padding-bottom: 18px;
        }
        .sidebar h3 i
        {
            margin-right: 8px;
        }

        .sidebar a:hover
        {
            background: grey;
            padding: 10px 15px 10px 25px;
        }
        .sidebar a i
        {
            margin-right: 9px;
        }
        .main 
        {
            flex: 1;
            background: #f4f6f9;
        }
        .topbar 
        {
            background: white;
            padding: 15px 20px;
            display: flex;
            justify-content: flex-end;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            align-items: right;
            font-size: 17px;
        }
        .content 
        {
            padding: 20px;
        }
        .profile-links a 
        {
            margin-right: 15px;
            text-decoration: none;
            color: black;
        }
        .topbar a
        {
            margin-left: 20px;
        }
        .topbar i
        {
            margin-right: 7px;
        }
        .topbar a:hover
        {
            color: #1e90ff;
        }
        .dashboard-cards
        {
            display:flex;
            justify-content:center;
            gap:40px;
            margin-top:40px;
        }
        .card
        {
            display:flex;
            align-items:center;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            gap:15px;
            padding:25px;
            width:180px;
            height: 80px;
            border-radius:10px;
            color:white;
            box-shadow:0 4px 10px rgba(0,0,0,0.2);
        }
        .card-icon
        {
            font-size:40px;
        }
        .card-info h3
        {
            margin:0;
            font-size:25px;
        }
        .card-info p
        {
            margin:5px 0 0 0;
            font-size:28px;
            font-weight:bold;
        }
        .products
        {
            background:#3498db;
        }
        .brands
        {
            background:#2ecc71;
        }
    </style>

</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main">
    <div class="topbar">
        
        <div class="profile-links">
            <a href="/Phonexa-MVC/Profile"><i class="fa-solid fa-user"></i>Profile</a>
            <a href="/Phonexa-MVC/Logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
        </div>
    </div>

    <div class="content">