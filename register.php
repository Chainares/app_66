
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>
<body>
    <header>
        <h1 style="text-align: center;">สมัครสมาชิก</h1>
    </header>
    <hr>
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