<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Webboard</title>
</head>

<body>
    <div class="contianer">
        <h1 style="text-align: center;" class="mt-3">Webboard</h1>
        <?php include "nav.php"; ?>
        <br>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
            <?php 
                if(isset( $_GET['status'])){
                    echo '<div class="alert alert-success" role="alert">
                    เพิ่มหมวดหมู่เรียบร้อยแล้ว
                  </div>';
                }
                ?>
                <table class="table table-striped">
                    <tbody class="text-center">
                        <tr>
                            <td>ลำดับ</td>
                            <td>ชื่อหมวดหมู่</td>
                            <td><span class="float-end me-4">จัดการ</span></td>
                        </tr>
                        <?php
                        $conn = new PDO("mysql:host=localhost;dbname=app66;charset=utf8", "root", "");
                        $sql = "SELECT * FROM category";
                        $no = 1;
                        foreach ($conn->query($sql) as $row) {
                            echo "<tr><td>$no</td><td>" . $row['name'] . "</td>";
                            echo "<td>";

                            echo "<a class='btn btn-danger btn-sm mt-2 float-end me-3' href=''
                     onclick='return myFunction();'>
                 <i class='bi bi-trash'></i></a>";

                            echo "<a class='btn btn-warning  btn-sm mt-2 float-end me-3' href=''
                   >
               <i class='bi bi-pencil-fill' ></i></a>";

                            echo "</td></tr>";
                            $no++;
                        }


                        $conn = null;
                        ?>
                    </tbody>
                </table>

            </div>
            <div class="col-lg-4 col-md-2 col-sm-1"></div>
        </div>
        <button type="button" style="margin-left: 45%;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-bookmark-plus"></i> เพิ่มหมวดหมู่ใหม่
        </button>
    </div>


    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="category_save.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มหมวดหมู่ใหม่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name_cat" class="form-label">ชื่อหมวดหมู่:</label>
                        <input type="text" class="form-control" id="name_cat" name="name_cat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>