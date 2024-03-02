<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>XD Webboard -_-</title>
</head>
<body>
  <div class="container-lg">
    <h1 style="text-align: center;" class="mt-3">___oKaKo___</h1>
    
    <?php include"nav.php";?>
    
  <div class="mt-3 d-flex justify-content-between" >
            <div>
              <label>หมวดหมู่</label>
   <span class="dropdown">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      ---ทั้งหมด---
          </button>
          <ul class="dropdown-menu" aria-labelledby="Button2">
                <li><a href="#" class="dropdown-item">ทั้งหมด</a></li>
                    <?php
                        $conn=new PDO("mysql:host=localhost;dbname=app66;charset=utf8","root","");
                        $sql="SELECT * FROM category";
                        foreach($conn->query($sql) as $row){
                            echo "<li><a class-dropdown-item href=# style= text-decoration:none >$row[name]</a></li>";
                        }
                        $conn=null;
                    ?>
            </ul>
   </span>
            </div>
            <?php   if (isset($_SESSION['id'])){?>
       <div><a href="newpost.php" class="btn btn-success btn-sm ">
        <i class="bi bi-plus"></i> สร้างกระทุ้ใหม่ </a> </div>
      <?php }?>
  </div>


      <table class="table table-striped mt-4">
        <?php
            for($i=1;$i<=10;$i++){
             echo "<tr><td class='d-flex justify-content-between'> <a href=post.php?id=$i style=text-decoration:none> กระทู้ที่ $i</a>";
             if(isset($_SESSION['id']) &&$_SESSION['role']=='a'){ 
              echo "&nbsp;&nbsp;
              <a href=delete.php?id=$i class='btn btn-danger btn-sm'><i class='bi bi-trash'></i></a>";
               }
              echo"</td></tr>";
              }
           ?>  
    </table>
  </div>
</body>
</html>