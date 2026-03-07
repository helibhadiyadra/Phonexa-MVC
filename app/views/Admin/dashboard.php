<?php include __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="dashboard-cards">

    <div class="card products">
        <div class="card-info">
            <h3>Total Products</h3>
            <p><?php echo $totalProducts; ?></p>
        </div>
    </div>

    <div class="card brands">
        <div class="card-info">
            <h3>Total Brands</h3>
            <p><?php echo $totalBrands; ?></p>
        </div>
    </div>

</div>

<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>