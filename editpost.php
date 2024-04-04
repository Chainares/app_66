<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: index.php");
        die();
    }
    if($_SESSION['user_id'] != $_GET['user_id']){
        header("location: index.php");
    }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Webboard</title>
</head>
<body>
    <div class="contianer">
    <h1 style="text-align: center;" class="mt-3">Webboard</h1>
    <?php include "nav.php"; ?>
    <br>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-4">
                <?php 
                if(isset( $_GET['status'])){
                    echo '<div class="alert alert-success" role="alert">
                    แก้ไขข้อมูลเรียบร้อยแล้ว
                  </div>';
                }
                ?>
            <div class="card text-dark bg-white border-warning">
                <div class="card-border bg-warning text-white" style="padding: 10px;">แก้ไขกระทู้</div>
                <div class="card-body">
                    <form action="editpost_save.php" method="post">
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">หมวดหมู่ :</label>
                            <div class="col-lg-9">
                                <select name="category" class="form-select">
                                    <?php
                                           $conn = new PDO("mysql:host=localhost;dbname=app66;charset=utf8", "root", "");
                                           $sql = "SELECT * FROM category";
                                           $sql_post = "SELECT * FROM post where id =".$_GET['id'];
                                           $value_id;
                                           $title;
                                           $content;
                                           foreach( $conn->query($sql_post) as $row_post){
                                            $value_id = $row_post['cat_id'];
                                            $title = $row_post['title'];
                                            $content = $row_post['content'];
                                           }

                                           foreach($conn->query($sql) as $row){
                                           echo $row['id'] .'----'. $value_id;
                                           if($row['id'] == $value_id){
                                            echo "<option selected value = $row[id] >$row[name]</option>";
                                           }else{
                                            echo "<option value = $row[id]>$row[name]</option>";
                                           }
                                           }
                                           $conn=null;
                                    ?>
                                </select>
                            </div>
                        </div>
                                <div class="row mb-3">
                                    <input type="hidden" name="post_id" value="<?php echo $_GET['id']; ?>">
                                    <label class="col-lg-3 col-form-label">หัวข้อ :</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="topic" class="form-control" value="<?php  echo $title; ?> " required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3 col-form-label">เนื้อหา :</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" name="comment" rows="8"><?php  echo $content; ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                            <div class="col-lg-12">
                                <center>
                                    <button type="submit" class="btn btn-warning btn-sm text-white me-2">
                                        <i class="bi bi-car-right-square"></i><i class="bi bi-caret-right-square me-1"></i>บันทึกข้อความ</button>
                                   
                                    </center>
                            </div>
                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="col-lg-3 col-md-2 col-sm-1"></div>
        </div>
    </div>
</body>
