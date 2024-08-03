<?php
session_start();
$showError = false;
$addShop=false;

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../user/user_login.php');
    exit();
}

include '../partials/_dbconnect.php';

if($_SESSION['is_admin']==1){
   $showError = "Admins can't add Shops. <a href='../user/user_login.php'>Click Here</a> to login as a User.";
}else{


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['userid']; 
    $business_name = $_POST['business_name'];
    $owner_name = $_POST['owner_name'];
    $location = $_POST['location'];
    $address = $_POST['address'];
    $mobile_no = $_POST['mobile_no'];

    $sql = "INSERT INTO shops (user_id, business_name, owner_name, location, address, mobile_no) 
            VALUES ('$user_id', '$business_name', '$owner_name', '$location', '$address', '$mobile_no')";
    
    if (mysqli_query($conn, $sql)) {
        $addShop=true;
        
    } else {
        $showError = "Error: " . mysqli_error($conn);
    }
  }
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../partials/_navbar.php'?>
  <div class="container mt-5">
    <h2 class= "mb-5 text-center">Add Shop</h2>
    <?php 
    if($addShop){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Success! </strong> Shop Added Successfully! <a href='../shop/shop_panel.php'>Click Here</a> to go to Shop panel.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";

    }
    
    if ($showError) {
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      <strong>Error: </strong>$showError
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    } ?>
    <form action="add_shop.php" method="post">
      <div class="mb-3">
        <label for="business_name" class="form-label">Business Name</label>
        <input type="text" class="form-control" id="business_name" name="business_name" required>
      </div>
      <div class="mb-3">
        <label for="owner_name" class="form-label">Owner Name</label>
        <input type="text" class="form-control" id="owner_name" name="owner_name" required>
      </div>
      <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" class="form-control" id="location" name="location" required>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" required></textarea>
      </div>
      <div class="mb-3">
        <label for="mobile_no" class="form-label">Mobile No</label>
        <input type="number" class="form-control" id="mobile_no" name="mobile_no" required>
      </div>
      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary text-center">Add Shop</button>
      </div>
    </form>
  </div>
  <?php include'../partials/_footer.php'?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
