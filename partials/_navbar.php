<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Nav</title>
  <style>
    @media (max-width: 576px) {
      img {
        max-width: 90%;
        height: auto;
      }
    }

    @media (min-width: 577px) and (max-width: 768px) {
      img {
        max-width: 80%;
        max-height: 80%;
      }
    }

    @media (min-width: 769px) {
      img {
        max-width: 60%;
        max-height: 50%;
      }
    }
  </style>
</head>
<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$loggedin = isset($_SESSION['username']);
$is_admin = $loggedin && $_SESSION['is_admin'] == 1;

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PHP Login System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">';

if (!$loggedin) {
  echo '<li class="nav-item">
          <a class="nav-link" aria-current="page" href="../admin/admin_login.php">Admin Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../user/user_login.php">User Login</a>
        </li>';
} else {
  if ($is_admin) {
    echo '<li class="nav-item">
            <a class="nav-link" href="../admin/admin_panel.php">Admin Panel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../user/add_user.php">Add User</a>
          </li>';
  } else {
    echo '<li class="nav-item">
            <a class="nav-link" href="../shop/shop_panel.php">Shop Panel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../shop/add_shop.php">Add Shop</a>
          </li>';
  }
  echo '<li class="nav-item">
          <a class="nav-link" href="../partials/_logout.php">Logout</a>
        </li>';
}

echo '  </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>';
?>
<div class="container-fluid">
  <div class="d-flex justify-content-center">
    <img src="../images/1.png" class="img-fluid" style="max-width: 60%; height: auto;">
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
