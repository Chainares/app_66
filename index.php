<?php
    session_start();
    if(isset($_GET['name'])){
        $catname=$_GET['name'];
    }else{
        $catname='--ทั้งหมด--';
    }
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
<?php if(!isset($_SESSION["id"]))  {?>
<body>
  <div class="container-lg">
    <h1 style="text-align: center;" class="mt-3">  Webboard  INDEX__</h1>
    <?php include"nav.php";?>
  <div class="mt-3 d-flex justify-content-between" >
            <div>
              <label>หมวดหมู่</label>
              <span class="dropdoen">
                <button class="btn btn-light dropdown-toggle btn-sm" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false"><?php echo $catname; ?></button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="index.php">ทั้งหมด</a></li>
                    <?php
                        $conn=new PDO("mysql:host=localhost;dbname=app66;charset=utf8","root","");
                        $sql="SELECT * FROM category";
                        foreach($conn->query($sql) as $row){
                            echo "<li><a class='dropdown-item' href=index.php?catid=$row[id]&name=$row[name]>$row[name]</a></li>";
                        }
                        $conn=null;
                    ?>
                </ul>
            </span>
  <!-- <span class="dropdown">
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
   </span> -->
            </div>
            <?php   if (isset($_SESSION['id'])){?>
       <div><a href="newpost.php" class="btn btn-success btn-sm ">
        <i class="bi bi-plus"></i> สร้างกระทุ้ใหม่ </a> </div>
      <?php }?>
  </div>


      <table class="table table-striped mt-4">
      
        <!-- <?php
        
        $conn=new PDO("mysql:host=localhost;dbname=app66;charset=utf8","root","");
        $sql="SELECT t1.id,t3.name,t1.content,t2.name,t1.post_date FROM post as t1
        INNER JOIN user as t2 ON (t1.user_id=t2.id) 
        INNER JOIN category as t3 on (t1.cat_id=t3.id)  ";
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
             
           ?>   -->

<?php
            $conn=new PDO("mysql:host=localhost;dbname=app66;charset=utf8","root","");
            if(isset($_GET['catid'])){
                $cat_id=$_GET['catid'];
                $sql="SELECT t3.name,t1.id,t1.title,t2.login,t1.post_date FROM post as t1 INNER JOIN user as t2 
                on (t1.user_id=t2.id) INNER JOIN category as t3 on (t1.cat_id=t3.id) 
                WHERE t1.cat_id=$cat_id ORDER BY t1.post_date DESC";
            }else{
                $sql="SELECT t3.name,t1.id,t1.title,t2.login,t1.post_date FROM post as t1 INNER JOIN user as t2 
                on (t1.user_id=t2.id) INNER JOIN category as t3 on (t1.cat_id=t3.id) ORDER BY t1.post_date DESC";
            }
                $result=$conn->query($sql);
                while($row=$result->fetch()){
                    echo "<tr><td>[ $row[0] ] <a href=post.php?id=$row[1] style=text-decoration:none>$row[2]</a>
                    <br>$row[3] - $row[4]</td></tr>";
                }
                $conn=null;
        ?>
    </table>
  </div>
</body>
<?php } else{ ?>
  <body>
    <div class="container">
        <h1><?#เข้าสู่ระบบแล้ว?></h1>
    <h1 style="text-align: center;">Webboard kakkak</h1>
    <?php include('nav.php'); ?>
    <br>
    <div class="d-flex justify-content-between">
        <div>
            <label>หมวดหมู่:</label>
            <span class="dropdoen">
                <button class="btn btn-light dropdown-toggle btn-sm" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false"><?php echo $catname; ?></button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="index.php">ทั้งหมด</a></li>
                    <?php
                        $conn=new PDO("mysql:host=localhost;dbname=app66;charset=utf8","root","");
                        $sql="SELECT * FROM category";
                        foreach($conn->query($sql) as $row){
                            echo "<li><a class='dropdown-item' href=index.php?catid=$row[id]&name=$row[name]>$row[name]</a></li>";
                        }
                        $conn=null;
                    ?>
                </ul>
            </span>
        </div>
        <div>
            <a href="newpost.php" class="btn btn-success btn-sm"><i class="bi bi-plus"></i>สร้างกระทู้ใหม่</a>
        </div>
    </div>
 
    <br>
    <table class="table table-striped">
    <?php
            $conn=new PDO("mysql:host=localhost;dbname=app66;charset=utf8","root","");
            if(isset($_GET['catid'])){
                $cat_id=$_GET['catid'];
                $sql="SELECT t3.name,t1.id,t1.title,t2.login,t1.post_date,t1.user_id FROM post as t1 INNER JOIN user as t2 
                on (t1.user_id=t2.id) INNER JOIN category as t3 on (t1.cat_id=t3.id) 
                WHERE t1.cat_id=$cat_id ORDER BY t1.post_date DESC";
            }else{
                $sql="SELECT t3.name,t1.id,t1.title,t2.login,t1.post_date,t1.user_id FROM post as t1 INNER JOIN user as t2 
                on (t1.user_id=t2.id) INNER JOIN category as t3 on (t1.cat_id=t3.id) ORDER BY t1.post_date DESC";
            }
                $result=$conn->query($sql);
                while($row=$result->fetch()){
                    echo "<tr><td>[ $row[0] ] <a href=post.php?id=$row[1] style=text-decoration:none>$row[2]</a>
                    <br>$row[3] - $row[4]</td>";
                    if($_SESSION["role"]=="a" || $_SESSION["username"] == $row[3]){
                      echo "<td>";
                    
                        echo "<a class='btn btn-danger btn-sm mt-2 float-end me-3' href=delete.php?id=$row[1]
                            onclick='return myFunction();'>
                        <i class='bi bi-trash'></i></a>";
                        if( $_SESSION["username"] == $row[3]){
                          echo "<a class='btn btn-warning  btn-sm mt-2 float-end me-3' href=editpost.php?id=$row[1]&user_id=$row[5]
                          >
                      <i class='bi bi-pencil-fill' ></i></a>";
                        }
                        echo "</td>";
                      }else{
                      echo "<td></td>";
                    }
                    echo "</tr>";
                }
                $conn=null;
    ?>
    </table> 
</div>
</body>
<?php } ?>
</html>