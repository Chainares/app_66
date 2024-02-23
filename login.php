<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <header>
        <h1 style="text-align: center;">Webboard</h1>
    </header>
    <hr>
<div class="container-lg">
    <h1 style="text-align: center;" class="mt-3">___oKaKo__88_</h1>
    
    <?php include"nav.php";?>
  <div class="row mt-4">
    <div class="col-lg-4 col-md-3 col-sm-2 col-1"></div>
    <div class="col-lg-4 col-md-6 col-sm-8 col-10">
        <div class="card">
            <div class="card-header">เข้าสู่ระบบ</div>
            <div class="card-body">
                <form action="verify.php" method="post">
                    <div class="form-group">
                        <label for="user" class="form-label"> login</label>
                        <input type="text" id="user" class="form-control" name="login" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-3 col-sm-2 col-1"></div>
  </div>
</div>

    <form action="verify.php" method="post">
        <table style="border: 2px solid black; width: 40%;" align="center">
            <tr>
                <td colspan="2" style="background-color: #6CD2EF;">เข้าสู่ระบบ</td>
            </tr>
            <tr>
                <td>Login</td>
                <td><input type="text" name="login" size="50"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="pwd" size="50"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Login">
                </td>
            </tr>
        </table>
        <br>
        <div style="text-align: center;">
            you haven't registered yet ? <a href="register.html">register</a> now.
        </div>
    </form>
</body>
</html>