<?
$admin_email=$_GET['admin_email'];
?>

<!-- Navbar -->
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-4">
    <div class="container">
      <a
        class="navbar-brand"
        href="admin_dashboard.php?admin_email=<?php echo $admin_email ?>"
        >Home</a
      >
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#mobile-nav"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mobile-nav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            
          </li>
        </ul>

        

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="admin_dashboard.php<?php echo "?admin_email=".$admin_email ?> ">
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>
