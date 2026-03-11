<?php
/** @var mysqli_result $products */
?>
<?php include __DIR__ . '/../layouts/admin_header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>

<style>
body 
{
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}
h2 
{
    text-align: center;
    margin-bottom: 30px;
    margin-top: -5px;
    font-size: 28px;
}
table 
{
    width: 90%;
    margin: auto;
    border-collapse: collapse;
    background: #ffffff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    border-radius: 8px;
}
th 
{
    background: #1e293b;
    color: white;
    padding: 14px;
    text-align: left;
}
td 
{
    padding: 5px;
    border-bottom: 1px solid #eee;
}
td img 
{
    width: 30px;
    height: auto;
}
a 
{
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 4px;
    font-size: 14px;
    margin-right: 5px;
}
.view-btn 
{
    background: #3b82f6;
    color: white;
}
.edit-btn 
{
    background: #10b981;
    color: white;
}
.delete-btn 
{
    background: #ef4444;
    color: white;
}
.add-btn 
{
    position: absolute;
    right: 110px;
    top: 6%;
    transform: translateY(-50%);
    background-color: black;
    color: white;
    padding: 8px 20px;
    text-decoration: none;
    border-radius: 8px;
    font-size: 18px;
    margin-top: 40px;
}
.status-active
{
    color: green;
    font-weight: bold;
}
.status-inactive 
{
    color: red;
    font-weight: bold;
}
.alert-success
{
    background:#d4edda;
    padding:12px;
    border-radius:5px;
    color:#155724;
    margin-bottom:15px;
}
</style>

<h2>Product List
<a href="/Phonexa-MVC/AddProduct" class="add-btn">
    Add Product
</a>
</h2>
<?php if(isset($_SESSION['success'])) { ?>

<div class="alert-success">
    <?php 
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    ?>
</div>

<?php } ?>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Price</th>
        <th>Brand</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($products)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
                <?php
                    if (!empty($row['image'])) 
                    {

                        $images = explode(',', $row['image']);

                        foreach ($images as $img) 
                        {
                            if (!empty($img)) 
                            {
                ?>
                    <img src="/Phonexa-MVC/public/uploads/<?php echo $img; ?>" width="50">
                <?php
                            }
                        }
                    }
                ?>
            </td>
            <td><?php echo $row['price']; ?></td>
            <td><?= $row['brand_name']; ?></td>
            <td>
                <?php
                    if($row['status'] == "Active") 
                    {
                        echo "<span class='status-active'>Active</span>";
                    } 
                    else 
                    {
                        echo "<span class='status-inactive'>Inactive</span>";
                    }
                ?>
            </td>
            <td>
                <a class="view-btn" href="/Phonexa-MVC/ViewProduct/<?= $row['id']; ?>">View</a> 
                <a class="edit-btn" href="/Phonexa-MVC/EditProduct/<?= $row['id']; ?>">Edit</a> 
                <a class="delete-btn" 
                   href="/Phonexa-MVC/DeleteProduct/<?= $row['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this product?');">
                   Delete
                </a>
            </td>
        </tr>
    <?php } ?>

</table>

</body>
</html>
<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>