<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../admin/admin_login.php');
    exit();
}

include '../partials/_dbconnect.php';

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../partials/_navbar.php'?>
  <div class="container mt-5">
    <h2 class= "mb-5">User Panel</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">User Id</th>
          <th scope="col">User Name</th>
          <th scope="col">Contact No</th>
          <th scope="col">Email ID</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['userid']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['contactno']}</td>
                    <td>{$row['emailid']}</td>
                    <td>
                      <a href='edit_user.php?id={$row['userid']}' class='btn btn-warning btn-sm'>Edit</a>
                      <a href='delete_user.php?id={$row['userid']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                  </tr>";
        }
        ?>
      </tbody>
    </table>
    <a href="../admin/admin_panel.php" class="btn btn-primary">Admin Panel</a>
    <!-- <a href="../shop/shop_panel.php" class="btn btn-primary">Shop Panel</a> -->
    <a href="../partials/_logout.php" class="btn btn-danger">Logout</a>
  </div>
  <?php include'../partials/_footer.php'?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
