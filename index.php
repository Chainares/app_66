<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webboard-onii</title>
</head>
<body>
    <h1 style="text-align: center;"></h1>
    <hr>
    <form>
    หมวดหมู่: 
    <select name="category">
         <option value="all">---ทั้ง---</option>
         <option value="general">General</option>>เรื่องทั่วไป</option>
         <option value="study">Study</option>
    </select>
    <a href="login.html" style="float:right;">เข้าสู่ระบบ</a>
  </form> 
  <ul>

  <?php
      for($i=1;$i<=10;$i++){
        echo "<li><a href='post.php?id=$i'>กระทู้ที่ $i</a></li>";
        }
  ?>  
  
  </ul>
    
</body>
</html>