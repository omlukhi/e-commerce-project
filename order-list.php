<?php include_once 'site_connection.php'; ?>

<?php 
if(isset($_SESSION['login']))
{
	$login_id = $_SESSION['login'];
	$sql_select_login = "select * from `user_register` where `id`='$login_id'";
	$data_login = mysqli_query($conn,$sql_select_login);
	$row_login = mysqli_fetch_assoc($data_login);

	$sql_select = "select * from `order` where `user_id`='$login_id' order by `status` desc";
	$data = mysqli_query($conn,$sql_select);

	$sql_select_o = "select * from `order` where `user_id`='$login_id'";
	$data_o = mysqli_query($conn,$sql_select_o);
	$row_o = mysqli_fetch_assoc($data_o);

	$amt_total = "select * from `order` where `user_id`='$login_id'";
	$data_total = mysqli_query($conn,$amt_total);

	$total_price = 0;
	while($row_total = mysqli_fetch_assoc($data_total))
	{
		$total_price = $total_price + $row_total['price'] * $row_total['num_product'];
	}

	$sql_select_r = "select * from `user_register` where `id`='$login_id'";
	$data_r = mysqli_query($conn,$sql_select_r);
	$row_r = mysqli_fetch_assoc($data_r);

	$sql_select_pay = "select `payment` from `order` where `user_id`='$login_id'";
	$data_pay = mysqli_query($conn,$sql_select_pay);
	$row_pay = mysqli_fetch_assoc($data_pay);

	if($row_pay!="")
	{
		if ($row_pay['payment']=='Cash on Delivery')
		{
			$payment_status = 'CASH ON DELIVERY';
		}
		else
		{
			$payment_status = 'PAID';
		}

		if (isset($_POST['cancel']))
		{	
			header('location:cancel-order.php');
		}
	}
}
else
{
	header('location:login_home.php');
}
?>

<!-- breadcrumb -->
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main_css.css">
</head>
<body class="animsition">

	<header class="header-v4">
		<!-- Header desktop -->
		<!-- Header content skipped for brevity -->
	</header>

	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-15 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="shoping-cart.php" class="stext-109 cl8 hov-cl1 trans-04">
				Shoping Cart
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Your Order-list
			</span>
		</div>
	</div>

	<div class="order_placed">
		<h1>Your Orders are Below</h1>
	</div>

	<!-- Shoping Cart -->
<div id="new_number_of_product">
	<form class="bg0 p-t-45 p-b-85" method="post">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-xl-10 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart" align="center">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-5 text-center">Delivery Status</th>
									<th class="column-5"></th>
								</tr>

						<?php if(isset($_SESSION['login']))
						{
						while($row = mysqli_fetch_assoc($data)) { ?>
								<tr class="table_row">
									<td class="column-1" align="center">
										<div class="how-itemcart1">
											<img src="admin/image/<?php echo $row['image']; ?>">
										</div>												 
									</td>
									<td class="column-2">
										<div class="p-b-10"><?php echo $row['name']; ?></div>
										<ul>
											<li><b>Size : </b><?php echo $row['size']; ?></li>
											<li><b>Color : </b><?php echo $row['color']; ?></li>
										</ul>	
									</td>
									<td class="column-3">Rs.<?php echo $row['price']; ?></td>
									<td class="column-4" align="center">
										<span class="num_pro"><?php echo $row['num_product']; ?></span>
									</td>
									<td class="column-5">
										<?php 

											$total_pro = $row['num_product'];
											$price = $row['price'];

											echo 'Rs.'.$total_pro*$price;
										 ?>
									</td>
									<td class="column-5 text-center">
										<?php echo $row['status']; ?>
									</td>

									<!-- Allow cancel for all statuses -->
									<td class="column-5 text-center">
										<a href="cancel-order.php?c_id=<?php echo $row['id']; ?>" class="flex-c-m stext-104 cl0 size-107 bg3 bor14 hov-btn3 p-lr-15 m-t-10 m-b-10 trans-04 pointer order_delete" attr_id=<?php echo $row['id']; ?>>Cancel Order</a>
									</td>
								</tr>
						<?php } } ?>

							</table>
						</div>

					</div>
				</div>

			</div>
		</div>
	</form>
</div>

	<?php include_once 'footer.php'; ?>

	<?php include_once 'scripts.php'; ?>           
</body>
</html>
