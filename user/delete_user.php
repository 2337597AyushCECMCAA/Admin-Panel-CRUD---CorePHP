<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != 1) {
    header('Location: user_login.php');
    exit();
}

include '../partials/_dbconnect.php';

$userid = $_GET['id'];

// Fetch user details to check if it's the logged-in admin
$sql = "SELECT * FROM users WHERE userid=$userid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SESSION['username'] == $row['username']) {
    // Unset session variables and logout if deleting own account
    session_unset();
    session_destroy();
    header('Location: ../admin/admin_login.php'); // Redirect to login page
    exit();
}

$sql = "DELETE FROM users WHERE userid=$userid";
if (mysqli_query($conn, $sql)) {
    // Check if the admin deleted their own account
    if ($_SESSION['username'] == $row['username']) {
        // Unset session variables and logout
        session_unset();
        session_destroy();
        header('Location: ../user/user_login.php'); // Redirect to login page
        exit();
    } else {
        header('Location: ../admin/admin_panel.php');
        exit();
    }
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
