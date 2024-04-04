<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: index.php");
        die();
    }
    $cate=$_POST['name_cat'];
    $conn = new PDO("mysql:host=localhost;dbname=app66;charset=utf8", "root", "");

    $sql="INSERT INTO `category`(`name`) VALUES ('$cate')";
    $conn->exec($sql);
    $conn=null;
   
    header("location: category.php?status='success'");
    die();
?>