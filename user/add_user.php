<?php
session_start();
$showError = false;
$addUser = false;

// Check if the user is an admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
  header('Location: ../admin/admin_login.php');
  exit();
}

include '../partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['userpass']; 
    $contactno = $_POST['contactno'];
    $emailid = $_POST['emailid'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, userpass, contactno, emailid, is_admin) VALUES ('$username', '$hashed_password', '$contactno', '$emailid', 0)";
    if (mysqli_query($conn, $sql)) {
        $user_id = mysqli_insert_id($conn); //retreiving user id of the inserted user
        $_SESSION['userid']=$user_id;
        $addUser= true;
    } else {
        $showError = "Error: " . mysqli_error($conn);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../partials/_navbar.php'?>
  <div class="container mt-5">
    <h2 class= "mb-5 text-center">Add User</h2>
    <?php 
    if($addUser){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success</strong> User Added Successfully! <a href='../user/user_panel.php'>Click Here</a> to go to User panel.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";

    }
    if ($showError) {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Error: </strong>$showError
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    } ?>
    <form action="./add_user.php" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="userpass" class="form-label">Password</label>
        <input type="password" class="form-control" id="userpass" name="userpass" required>
      </div>
      <div class="mb-3">
        <label for="contactno" class="form-label">Contact No</label>
        <input type="number" class="form-control" id="contactno" name="contactno" required>
      </div>
      <div class="mb-3">
        <label for="emailid" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailid" name="emailid" required>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary text-center">Add User</button>
      </div>
      <!-- <button type="submit" class="btn btn-primary">Add User</button> -->
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include'../partials/_footer.php'?>
</html>
