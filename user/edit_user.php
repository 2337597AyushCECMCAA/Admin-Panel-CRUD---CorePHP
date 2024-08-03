<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != 1) {
    header('Location: user_login.php');
    exit();
}

include '../partials/_dbconnect.php';

$userid = $_GET['id'];
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $contactno = $_POST['contactno'];
    $emailid = $_POST['emailid'];

    $sql = "UPDATE users SET username='$username', contactno='$contactno', emailid='$emailid' WHERE userid=$userid";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../admin/admin_panel.php');
        exit();
    } else {
        $showError = "Error: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM users WHERE userid=$userid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../partials/_navbar.php'?>
  <div class="container mt-5">
    <h2 class= "mb-5 text-center">Edit User</h2>
    <?php if ($showError) {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Error: </strong>$showError
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    } ?>
    <form action="edit_user.php?id=<?php echo $userid; ?>" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="contactno" class="form-label">Contact No</label>
        <input type="number" class="form-control" id="contactno" name="contactno" value="<?php echo $row['contactno']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="emailid" class="form-label">Email</label>
        <input type="email" class="form-control" id="emailid" name="emailid" value="<?php echo $row['emailid']; ?>" required>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary text-center">Update User</button>
      </div>
    </form>
  </div>
  <?php include'../partials/_footer.php'?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
</body>

</html>
