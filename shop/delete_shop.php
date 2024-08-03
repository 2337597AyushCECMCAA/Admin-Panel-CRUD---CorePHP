<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != 1) {
    header('Location: user_login.php');
    exit();
}

include '../partials/_dbconnect.php';

$shop_id = $_GET['id'];

$sql = "DELETE FROM shops WHERE shop_id=$shop_id";
if (mysqli_query($conn, $sql)) {
    header('Location: ../admin/admin_panel.php');
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
