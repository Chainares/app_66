<?php
session_start();
if (isset($_POST['login'])){

    $login= $_POST['login'];
    $passwd=$_POST['pwd'];
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];

    $conn = new PDO("mysql:host=localhost;dbname=app66;charset=utf8", "root", "");
        
            $sql ="INSERT INTO user (login, password, name, gender,email,role)
            VALUES ('$login','$passwd','$name','$gender','$email','m')";
            $conn->exec($sql);
            $conn=null;
        
    $conn = null;
    header("location:login.php");
    die();
}else{}
    header("location:index.php");
    die();
?>