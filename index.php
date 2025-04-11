<?php 
include_once 'connection.php'; 

/* we got this only after POST-Sign In, Else return to Login page */
if (isset($_SESSION['login_id'])) {
    header('location: dashboard.php');
    exit();
}

/* Login process runs if the above session is not active */
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_select = "SELECT * FROM `login` WHERE `email` = '$email' AND `password` = '$password'";
    $data = mysqli_query($conn, $sql_select);

    $data_count = mysqli_num_rows($data);

    if ($data_count > 0) {
        $row = mysqli_fetch_assoc($data);
        $_SESSION['login_id'] = $row['id'];
        header('location: dashboard.php');
        exit();
    } else {
        echo "Invalid email or password. Please try again.";
    }
}

// Registration process
if (isset($_POST['register'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists
    $sql_check_email = "SELECT * FROM `login` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql_check_email);
    if (mysqli_num_rows($result) > 0) {
        echo "Email is already taken. Please use a different email.";
    } else {
        // Insert the new user into the database
        $sql_insert = "INSERT INTO `login` (`id`, `name`, `email`, `password`) VALUES ('$id', '$name', '$email', '$password')";
        if (mysqli_query($conn, $sql_insert)) {
            header('location: index.php'); // Redirect to login page after successful registration
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->

  <!-- Display login or registration forms -->
  <?php if (isset($_GET['action']) && $_GET['action'] == 'register') { ?>
    <!-- Registration Form -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Register a new admin account</p>

        <form action="index.php" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ID" name="id" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Name" name="name" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  <?php } else { ?>
    <!-- Login Form -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="index.php" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block" name="signin">Sign In</button>
            </div>
            <div class="col-6">
              <div class="icheck-primary">
                <label for="register">
                  <a href="index.php?action=register" style="color: black; font-size: 14px;">Create an Admin Account</a>
                </label>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  <?php } ?>
</div>
<!-- /.login-box -->

<?php include_once 'scripts.php'; ?>
</body>
</html>
