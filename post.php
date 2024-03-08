<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>web_post</title>
</head>
<body>
<div class="container-lg">
<h1 style="text-align: center;" class="mt-3">Web-post</h1>
<?php include "nav.php"?>
<div class="row mt-4">
    <div class="col-lg-3 col-md-2 col-sm-1"></div>
    <div class="col-lg-6 col-md-8 col-sm-10"> 
        <div class="card-"></div>
            <?php
                $conn=new PDO("mysql:host=localhost;dbname=app66;charset=utf8","root","");
                $sql="SELECT t1.title, t1.content, t2.login, t1.post_date FROM post as t1
                INNER JOIN user as t2 ON (t1.user_id=t2.id) WHERE t1.id = $_GET[id]";
                $result=$conn->query($sql);
                while($row=$result->fetch()){
                    echo "<div class='card border-primary'>";
                    echo "<div class='card-header bg-primary text-white'>$row[0]</div>";
                    echo "<div class='card-body'>$row[3]<br><br>$row[2] - $row[1]</div>";
                    echo "</div>";
                }
                $conn=null;
            ?>    <br>    
            <?php
                $conn=new PDO("mysql:host=localhost;dbname=app66;charset=utf8","root","");
                $sql = "SELECT t1.content, t2.login, t1.post_date FROM comment as t1 
                INNER JOIN user as t2 ON (t1.user_id=t2.id) WHERE  t1.post_id = $_GET[id] ORDER BY t1.post_date";
                $result = $conn->query($sql);
                $i = 1;
                
                while($row=$result->fetch()){
                    echo "<div class='card border-info'>";
                    echo "<div class='card-header bg-info text-white'>ความคิดเห็นที่ $i</div>";
                    echo "<div class='card-body'>$row[0]<br><br>$row[1] - $row[2]</div>";
                    echo "</div><br>";
                    $i+=1; 
                } 
                $conn=null; ?>
        <div class="card border-success mt-3">
            <div class="card-header bg-success text-white">
                แสดงความคิดเห็น</div>
                <div class="card-body">
                    <form action="post_save.php" method="post">
                        <input type="hidden" name="post_id"
                        value="<?=$_GET['id'];?>">
                        <div class="row mb-3 justify-content-center">
                            <div class="col-lg-10">
                                <textarea name="comment" rows="8" 
                                class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 d-flex justify-content-center">
                                <button type="submit"class="btn btn-success btn-sm text-white">
                                    <i class="bi bi-box-arrow-up-right"></i> ส่งข้อความ
                                </button>
                                <button type="reset"class="btn btn-danger btn-sm sm-2 ">
                                    <i class="bi bi-x-square"> </i> ยกเลิก
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <br>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-1"></div>
</div>
</div>    
    <div style="text-align: center;"> 
        <a href="index.php">กลับไปหน้าหลัก</a>
    </div>
</body>
</html>