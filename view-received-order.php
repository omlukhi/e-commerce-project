<?php include_once 'header.php';

$sql_select = "SELECT * FROM `order`";
$data = mysqli_query($conn, $sql_select);

// Query to count new orders
$sql_count_new_orders = "SELECT COUNT(*) AS new_orders_count FROM `order` WHERE status = 'New'";
$result = mysqli_query($conn, $sql_count_new_orders);
$row = mysqli_fetch_assoc($result);
$new_orders_count = $row['new_orders_count'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View / Manage Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Manage Orders</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <p><strong>New Orders Received: <?php echo $new_orders_count; ?></strong></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">View/Manage Orders</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover display_order_admin_page_change">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Name of Product</th>
                                        <th>Number of Items</th>
                                        <th>Image 1 (Main)</th>
                                        <th>Status</th>
                                        <th>View More</th>
                                    </tr>
                                </thead>

                                <?php while ($row = mysqli_fetch_assoc($data)) { ?>

                                <tr>
                                    <td><?php echo $row['product_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['num_product']; ?></td>
                                    <td align="center">
                                        <div style="width: 200px; height: 170px;">
                                            <img src="image/<?php echo $row['image']; ?>" style="height: 100%; width: 100%; object-fit: cover; object-position: top;">
                                        </div>
                                    </td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><a href="view-more-product-order.php?v_id=<?php echo $row['id']; ?>">View More</a></td>
                                </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once 'footer.php'; ?>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>

<?php include_once 'scripts.php'; ?>
