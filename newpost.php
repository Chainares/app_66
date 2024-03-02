<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: index.php");
        die();
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
            <div class="card text-dark bg-white border-info">
                <div class="card-border bg-info tesxt-white">ตั้งกระทู้ใหม่</div>
                <div class="card-body">
                    <form action="newpost_save.php" method="post">
                        <div class="row mb-3">
                            <label class="col-lg-3 col-form-label">หมวดหมู่ :</label>
                            <div class="col-lg-9">
                                <select name="category" class="form-select">
                                    <?php
                                           $conn = new PDO("mysql:host=localhost;dbname=app66;charset=utf8", "root", "");
                                           $sql = "SELECT * FROM category";
                                           foreach($conn->query($sql) as $row){
                                            echo "<option value = $row[id]>$row[name]</option>";
                                           }
                                           $conn=null;
                                    ?>
                                </select>
                            </div>
                        </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3 col-form-label">หัวข้อ :</label>
                                    <div class="col-lg-9">
                                        <input type="text" name="topic" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3 col-form-label">เนื้อหา :</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" name="comment" rows="8"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                            <div class="col-lg-12">
                                <center>
                                    <button type="submit" class="btn btn-info btn-sm text-white me-2">
                                        <i class="bi bi-car-right-square"></i><i class="bi bi-caret-right-square me-1"></i>บันทึกข้อความ</button>
                                    <button type="rest" class="btn btn-danger btn-sm">
                                        <i class="bi bi-x-square"></i> ยกเลิก</button>
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
