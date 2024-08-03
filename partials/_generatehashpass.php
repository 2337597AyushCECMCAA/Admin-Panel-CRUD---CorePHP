<?php
// Define the passwords
$admin_password = 'admin';
$user_password = 'user';

// Hash the passwords using password_hash() function
$admin_hashed = password_hash($admin_password, PASSWORD_DEFAULT);
$user_hashed = password_hash($user_password, PASSWORD_DEFAULT);

// Output the hashed passwords
echo "Admin hashed password: " . $admin_hashed . "<br>";
echo "User hashed password: " . $user_hashed;
?>
