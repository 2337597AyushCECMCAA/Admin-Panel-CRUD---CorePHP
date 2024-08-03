<?php
session_start();
$showError = false;

include '../partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['userpass'])) {
            $_SESSION['username'] = $username;
            $_SESSION['is_admin'] = $row['is_admin'];
            $_SESSION['userid'] = $row['userid'];

            // // Check if userid is set in session
            // if (isset($_SESSION['userid'])) {
            //   echo "User ID stored in session: " . $_SESSION['userid'];
            // } else {
            //   echo "User ID is not stored in session.";
            // }
            
            // Redirect to the appropriate panel based on user role
            if ($row['is_admin'] == 1) {
                header('Location: ../admin/admin_panel.php');
            } else {
                header('Location: ../shop/shop_panel.php');
            }
            exit();
        } else {
            $showError = "Invalid login credentials";
        }
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
  <title>User Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php include '../partials/_navbar.php'?>
  <div class="container mt-5">
    <h2 class= "mb-5 text-center">User Login</h2>
    <?php if ($showError) {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Error: </strong>$showError
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    } ?>
    <form action="user_login.php" method="post">
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