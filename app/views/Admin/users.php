<?php include __DIR__ . '/../layouts/admin_header.php'; ?>

<style>
    h2
    {
        text-align: center;
    }
    table 
    {
        width: 90%;
        margin: auto;
        border-collapse: collapse;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        border-radius: 8px;
        text-align: center;
    }
    th 
    {
        background: #1e293b;
        color: white;
        padding: 14px;
    }
    td 
    {
        padding: 15px;
        border-bottom: 1px solid #eee;
        font-size: 17.5px;
    }
    .view-btn 
    {
        background: #3b82f6;
        color: white;
        padding: 7px 9px;
        text-decoration: none;
        border-radius: 4px;
        margin-left: 4px;
        font-size: 15px;
    }
    .edit-btn 
    {
        background: #10b981;
        color: white;
        padding: 7px 9px;
        text-decoration: none;
        border-radius: 4px;
        margin-left: 4px;
        font-size: 15px;
    }
    .delete-btn 
    {
        background: #ef4444;
        color: white;
        padding: 7px 9px;
        text-decoration: none;
        border-radius: 4px;
        margin-left: 4px;
        font-size: 15px;
    }
</style>

<h2>Users List</h2>

<?php if(isset($_SESSION['success'])): ?>
    <p style="color: green; text-align:center; font-weight:bold;">
        <?= $_SESSION['success']; ?>
    </p>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Action</th>
        <th>Admin Action</th>
    </tr>

    <?php foreach($users as $user): ?>
    <tr>
        <td><?= $user['id']; ?></td>
        <td><?= $user['first_name']; ?></td>
        <td><?= $user['last_name']; ?></td>
        <td><?= $user['email']; ?></td>

        <td>
            <a class="view-btn" href="/Phonexa-MVC/ViewUser/<?= $user['id']; ?>">View</a> 
                <a class="edit-btn" href="/Phonexa-MVC/EditUser/<?= $user['id']; ?>">Edit</a> 
                <a class="delete-btn" href="/Phonexa-MVC/DeleteUser/<?= $user['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this user?');">
                   Delete
                </a>
        </td>
        <td>
            <?php if($user['status'] == 'active'): ?>
                <a href="/Phonexa-MVC/DisableUser/<?= $user['id'] ?>" 
                style="background: orange; color:white; padding:7px; border-radius:4px; margin-left:5px; text-decoration:none; font-size:15px;">
                Disable
                </a>
            <?php else: ?>
                <a href="/Phonexa-MVC/EnableUser/<?= $user['id'] ?>" 
                style="background: green; color:white; padding:7px; border-radius:4px; margin-left:5px; text-decoration:none; font-size:15px;">
                Enable
                </a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>