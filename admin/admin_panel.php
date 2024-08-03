<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != 1) {
  header('Location: admin_login.php');
  exit();
}

include '../partials/_dbconnect.php';

// Fetch users
$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $sql_users);

$_SESSION['is_admin'] = 1;

// Fetch shops
$sql_shops = "SELECT * FROM shops";
$result_shops = mysqli_query($conn, $sql_shops);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<?php include '../partials/_navbar.php'?>
    <div class="container mt-5">
        <div class="mb-4 gap-3 d-flex justify-content-between text-center">
            <h2>Admin Panel</h2>
            <div class="d-flex gap-3">
                <a href="../user/add_user.php" class="btn btn-success d-flex align-items-center">Add User</a>
                <a href="../partials/_logout.php" class="btn btn-danger d-flex align-items-center">Logout</a>
            </div>
            
        </div>
        <hr>
        
        <h3 class= "mb-3 mt-4">Manage Users</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Contact No</th>
                    <th>Email</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_users)) { ?>
                <tr>
                    <td><?php echo $row['userid']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['contactno']; ?></td>
                    <td><?php echo $row['emailid']; ?></td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="../user/edit_user.php?id=<?php echo $row['userid']; ?>" class="btn btn-warning">Edit</a>
                            <a href="../user/delete_user.php?id=<?php echo $row['userid']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- <a href="../shop/add_shop.php" class="btn btn-success mb-3">Add Shop</a> -->
        <h3 class= "mb-3">Manage Shops</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Shop ID</th>
                    <th>Business Name</th>
                    <th>Owner Name</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Mobile No</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_shops)) { ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['shop_id']; ?></td>
                    <td><?php echo $row['business_name']; ?></td>
                    <td><?php echo $row['owner_name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['mobile_no']; ?></td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="../shop/edit_shop.php?id=<?php echo $row['shop_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="../shop/delete_shop.php?id=<?php echo $row['shop_id']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include'../partials/_footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
