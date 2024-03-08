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
    <h1 style="text-align: center;" class="mt-3">  Webboard  INDEX__</h1>
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
        
        $conn=new PDO("mysql:host=localhost;dbname=app66;charset=utf8","root","");
        $sql="SELECT t1.id,t3.name,t1.content,t2.name,t1.post_date FROM post as t1
        INNER JOIN user as t2 ON (t1.user_id=t2.id) INNER JOIN category as t3 on (t1.cat_id=t3.id)  ";
        $result=$conn->query($sql);
        while($row=$result->fetch()){

             echo "<tr><td class=''><span> [ ".$row[1]." ] <a href=post.php?id=".$row[0]." style=text-decoration:none>".$row[2]." </a></span>";
             
             if(isset($_SESSION['id']) &&$_SESSION['role']=='a'){ 
              echo "&nbsp;&nbsp;
              <a style='float: right;margin-top:7px;' href=delete.php?id=".$row[0]." class='btn btn-danger btn-sm'><i class='bi bi-trash'></i></a>";   
            }
            echo "<br><span> ".$row[3]." - ".$row[4]."</span> ";

              echo"</td></tr>";
              }
             
           ?>  
    </table>
  </div>
</body>
</html>