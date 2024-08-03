<?php
session_start();
$showError = false;

include '../partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND userpass='$password' AND is_admin=1";
    // echo $sql;
    $result = mysqli_query($conn, $sql);

    // echo "Number of rows: " . mysqli_num_rows($result); // For debugging purposes


    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['is_admin'] = 1;
        $_SESSION['admin'] = true;
        $_SESSION['userid'] = $row['userid'];
        header('Location: admin_panel.php');
        exit();
    } else {
        $showError = "Invalid login credentials";
    }
    
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include '../partials/_navbar.php'?>
  <div class="container mt-5">
    <h2 class= "mb-5 text-center">Admin Login</h2>
    <?php if ($showError) {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Error: </strong>$showError
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    } ?>
    <form action="admin_login.php" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary text-center">Login</button>
      </div>
    </form>
  </div>
  <?php include'../partials/_footer.php'?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
