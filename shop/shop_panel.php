<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../user/user_login.php');
    exit();
}

include '../partials/_dbconnect.php';

$user_id = $_SESSION['userid'];

$sql = "SELECT * FROM shops WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shop Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../partials/_navbar.php'?>
  <div class="container mt-5">
    <div class="mb-4 gap-3 d-flex justify-content-between align-items-center text-center">
      <h2>Shop Panel</h2>
      <div class="d-flex align-items-center gap-3">
        <?php if ($_SESSION['is_admin'] == 1): ?>
          <a href="../admin/admin_panel.php" class="btn btn-primary d-flex align-items-center">Admin Panel</a>
        <?php endif; ?>
        <?php if ($_SESSION['is_admin'] == 0): ?>
          <a href="../shop/add_shop.php" class="btn btn-primary d-flex align-items-center">Add Shop</a>
        <?php endif; ?>
    
        <a href="../partials/_logout.php" class="btn btn-danger d-flex align-items-center">Logout</a>
      </div>
            
    </div>
    <!-- <h2 class= "mb-5 text-center">Shop Panel</h2> -->
    <p class= "mb-3">Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Shop Id</th>
          <th scope="col">Business Name</th>
          <th scope="col">Owner Name</th>
          <th scope="col">Location</th>
          <th scope="col">Address</th>
          <th scope="col">Mobile No</th>
          <?php if ($_SESSION['is_admin'] == 1): ?>
            <th scope="col">Actions</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['shop_id']}</td>
                    <td>{$row['business_name']}</td>
                    <td>{$row['owner_name']}</td>
                    <td>{$row['location']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['mobile_no']}</td>";
            if ($_SESSION['is_admin'] == 1) {
                echo "<td>
                      <a href='edit_shop.php?id={$row['shop_id']}' class='btn btn-warning btn-sm'>Edit</a>
                      <a href='delete_shop.php?id={$row['shop_id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>";
            }
            echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    
  </div>
  <?php include'../partials/_footer.php'?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
</body>

</html>
