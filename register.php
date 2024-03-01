<?php
    session_start();
    if(isset($_SESSION['id'])){
        header("location: index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>register</title>
</head>
<body>
    <header>
        <h1 style="text-align: center;" class="mt-3">สมัครสมาชิก</h1>
    </header>
    <hr>
    <?php include"nav.php" ?>
<div class="row mt-4">
     <div class="col-lg-3 col-md-2 col-sm-1"></div>
     <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="card border-primary">
            <div class="card-header bg-primary txt-white">เข้าสู้ระบบ</div>
            <div class="card-body">
            <form action = "register_save.php" method = "post">
					    <div class="row">
						    <label class="col-lg-3 form-label">ชื่อบัญชี</label>
						    <div class="col-lg-9">
							    <input thpe="text" name="login" class="form-control" required>
						    </div>
					        </div>
					<div class="row mt-3">
						<label class="col-lg-3 form-label">รหัสผ่าน</label>
						<div class="col-lg-9">
							<input type="password" name="pwd" class="form-control" required>
						</div>
					</div>
					<div class="row mt-3">
						<label class="col-lg-3 form-label">ชื่อ-นามสกุล</label>
						<div class="col-lg-9">
							<input thpe="text" name="name" class="form-control" required>
						</div>
					</div>
					<div class="row mt-3">
						<label class="col-lg-3 form-label">เพศ</label>
						<div class="col-lg-9">
							<div class="form-check">
								<input type="radio" name="gender" value="m" class="form-check-input" required>
								<label call="form-check-label">ชาย</label>
							</div>
							<div class="form-check">
								<input type="radio" name="gender" value="f" class="form-check-input" required>
								<label call="form-check-label">หญิง</label>
							</div>
							<div class="form-check">
								<input type="radio" name="gender" value="o" class="form-check-input" required>
								<label call="form-check-label">อื่นๆ</label>
							</div>
                            <div class="row mt-3">
						        <label class="col-lg-3 form-label">email</label>
						        <div class="col-lg-9">
							    <input thpe="email" name="email" class="form-control" required>
						        </div>
					        </div>
                            <div class="row mt-3">
                            <div class="col-lg-3"></div>
						        <div class="col-lg-9">
							        <button type="submit" class="btn btn-primary btn-sm me-2">
                                        <i class="bi bi-save"></i> สมัครสมาชิก</button>
                                        <button type="submit" class="btn btn-primary btn-sm me-2">
                                        <i class="bi bi-x-square"></i> ยกเลิก</button>
						        </div>
					        </div>
						</div>
					</div>
				</form>
            </div>
        </div>
     </div>
     <div class="col-lg-3 col-md-2 col-sm-1"></div>
</div>
<br>
<Br>
<Br>
    <form action="">
        <table style="border: 2px solid black; width: 40%;" align="center">
            <tr>
                <td colspan="2" style="background-color: #6CD2EF;">กรอกข้อมูล</td>
            </tr>
            <tr>
                <td> ชื่อบัญชี: </td>
                <td><input type="text" name="username" size="50"></td>
            </tr
            <tr>
                <td> รหัสผ่าน: </td>
                <td><input type="password" name="pwd" size="50"></td>
            </tr>
            <tr>
                <td> ชื่อ-นามสกุล: </td>
                <td><input type="text" name="full_name" size="50"></td>
            </tr>
            <tr>
                <td> เพศ: </td>
                <td>
                    <input type="radio" name="gender" value="m"> ชาย <br>
                    <input type="radio" name="gender" value="w"> หญิง <br>
                    <input type="radio" name="gender" value="o"> อื่นๆ
                </td>
            </tr>
            <tr>
                <td>อีเมล:</td>
                <td><input type="email" name="email" size="50"></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="submit" value="สมัครสมาชิก">
                </td>
            </tr>
        </table>
        <br>
        <div style="text-align: center;">
             <a href="index.php">กลับหน้าหลัก</a>
        </div>
    </form>
</body>
</html>