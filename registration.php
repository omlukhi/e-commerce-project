<?php 
include_once 'connection.php'; 

if (isset($_POST['register'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_check_email = "SELECT * FROM `login` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql_check_email);
    if (mysqli_num_rows($result) > 0) {
        echo "Email is already taken. Please use a different email.";
    } else {
        
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
  <title>Admin | Register</title>

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
    <a href="register.php"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Register a new admin account</p>

       Registration Form
       <form action="register.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="ID" name="id" required >
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
          <div class="col-6">
            <div class="icheck-primary">
              <label for="register">
                <a href="index.php" style="color: black; font-size: 14px;">Already have an account? Sign In</a>
              </label>
            </div>
          </div>
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?php include_once 'scripts.php'; ?>
</body>
</html>
