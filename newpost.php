
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