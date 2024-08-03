<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != 1) {
    header('Location: user_login.php');
    exit();
}

include '../partials/_dbconnect.php';

$shop_id = $_GET['id'];
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $business_name = $_POST['business_name'];
    $owner_name = $_POST['owner_name'];
    $location = $_POST['location'];
    $address = $_POST['address'];
    $mobile_no = $_POST['mobile_no'];

    $sql = "UPDATE shops SET business_name='$business_name', owner_name='$owner_name', location='$location', address='$address', mobile_no='$mobile_no' WHERE shop_id=$shop_id";
    if (mysqli_query($conn, $sql)) {
        header('Location: ../admin/admin_panel.php');
        exit();
    } else {
        $showError = "Error: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM shops WHERE shop_id=$shop_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../partials/_navbar.php'?>
  <div class="container mt-5">
    <h2 class= "mb-5 text-center">Edit Shop</h2>
    <?php if ($showError) {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Error: </strong>$showError
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    } ?>
    <form action="edit_shop.php?id=<?php echo $shop_id; ?>" method="post">
      <div class="mb-3">
        <label for="business_name" class="form-label">Business Name</label>
        <input type="text" class="form-control" id="business_name" name="business_name" value="<?php echo $row['business_name']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="owner_name" class="form-label">Owner Name</label>
        <input type="text" class="form-control" id="owner_name" name="owner_name" value="<?php echo $row['owner_name']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" id="location" name="location" value="<?php echo $row['location']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="mobile_no" class="form-label">Mobile No</label>
        <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo $row['mobile_no']; ?>" required>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary text-center">Update Shop</button>
      </div>
    </form>
  </div>
  <?php include'../partials/_footer.php'?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
