<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg " style="background-color: darkgray;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><i class="bi bi-house-door-fill"></i> Home</a>
    
      <ul class="navbar-nav">
      <?php 
      if(!isset($_SESSION['id'])){?>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="login.php"><i class="bi bi-pencil-square"></i> เข้าสู่ระบบ</a>
        </li>
        
        <?php }else{   ?>
        <?php }?>
        
        <li class="nav-item dropdown">
          <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-lines-fill"> </i>
          <?php 
            echo $_SESSION['username'];
            ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-power"></i>ออกจากระบบ</a></li>           
          </ul>
        </li>
    </div>
</nav>
</body>
</html>