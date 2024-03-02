<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>verify_post</title>
</head>
<body>
    <h1 style="text-align: center;">Webboard-onii</h1>
    <hr>
    <div style="text-align: center;">
        <?php 
        $id =$_GET['id'];
         echo "ต้องการดูกระทู้หมายเลข $id<br>";    
          if($id%2==0){
            echo "เป็นกระทู้หมายเลขคู่";         
          }else{
            echo "เป็นกระทู้หมายเลขคี่";
          }   ?>     
    </div>
    <br>
    <table style="border: 2px solid black; width:40%;" align="center">
        <tr>
            <td style="background-color: #6cd2fe;">แสดงความคิดเห็น</td>
        </tr>
        <tr>
            <td align="center">
                <textarea cols="50" rows="15"></textarea><br>
                <input type="submit" value="ส่งข้อความ">
            </td>
        </tr>
    </table>
    <br>
    <div style="text-align: center;"> 
        <a href="index.php">กลับไปหน้าหลัก</a>
    </div>
</body>
</html>