
<?php
 session_start();
 if(!isset($_SESSION['id'])){
    header("location:index.php");
die();
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new post</title>
</head>
<h1 style="text-align: center;">ooooooooooKaKooooooo</h1>
    <hr>
<body>
<div class="container">
    <h1 style="text-align: center;" class="mt-3">ooooooooooKa</h1>
    <?php include"nav.php" ?>
    <div class="col-lg-3 col-md-2 col-sm-1"></div>
    <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="card borde-info">
            <div class="card-header bg-info text-wite">ตั้งกระทู้ใหม่</div>
            <div class="card-body">
    <form action="newpost_save.php" method="post">
        <div class="row">
            <label class="col-lg-3 col-form-label">หมวดหมู่</label>
            <div class="col-lg-9">
                <select name="category" class="form-slect">
                    <option value="ge">เรื่องทั่วไป</option>
                    <option>เรื่องทั่วไป</option>

                </select>
            </div>
        </div>
    </form>
            </div>

        </div>
    </div>
</div>


<form>
  
    <table>
<tr><td>ผู้ใช้ :</td><td><?php echo $_SESSION["username"]; ?></td></tr>
<tr><td>หมวดหมู่ :</td><td><select name="category">
        <option value="genneral">เรื่องทั่วไป</option>
        <option value="study">เรื่องเรียน</option> </select> </td></tr>
<table style="border:0px">
        <tr><td>หัวข้อ :</td><td><input type="text" name="topic" size="30"></td></tr>
        <tr><td>เนื้อหา :</td><td><textarea name="contact"cols="30" rows="2"></textarea></td></tr>
        <tr><td></td><td><input type="submit" value="บันทึกข้อความ"></td></tr>
    </table>
    </form>
</body>
</html>