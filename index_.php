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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Work10</title>
    <script>
        function myFunction(){
            let r=confirm("ต้องการลบกระทู้นี้จริงไหม ?");
            return r;
        }
    </script>
</head>
<?php if(!isset($_SESSION["id"]))  {?>
<body>
    <div class="container">
    <h1><?#ยังไม่ได้เข้าสู่ระบบ?></h1>
    <h1 style="text-align: center;">Webboard kakkak</h1>
    <?php include('nav.php'); ?>
    <br>
    <div class="d-flex">
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
    </div>
    <br>
    <table class="table table-striped">
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
    </ul>
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
                    <br>$row[3] - $row[4]</td>";
                    if($_SESSION["role"]=="a"){
                        echo "<td><a class='btn btn-danger btn-sm mt-2 float-end me-3' href=delete.php?id=$row[1]
                            onclick='return myFunction();'>
                        <i class='bi bi-trash'></i></a></td>";
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