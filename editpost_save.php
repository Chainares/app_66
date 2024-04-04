<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: index.php");
        die();
    }
    $cate=$_POST['category'];
    $top=$_POST['topic'];
    $comm=$_POST['comment'];
    $post_id = $_POST['post_id'];
    $user=$_SESSION['user_id'];

    $conn = new PDO("mysql:host=localhost;dbname=app66;charset=utf8", "root", "");

    $sql="UPDATE `post` SET `title`= '".$top."',`content`='".$comm."', `cat_id`= '".$cate."' WHERE id = ".$post_id;
   $conn->exec($sql);
    $conn=null;
   
    header("location: editpost.php?id=$post_id&user_id=$user&status='success'");
    die();
?>