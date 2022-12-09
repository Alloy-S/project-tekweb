<?php
session_start();
if (!isset($_SESSION["login_admin"])) {
    header("Location: login_admin.php");
}

if (isset($_POST["submit"])) {
    require("../connect.php");
    $name = stripslashes($_POST["name"]);
    $username = strtolower(stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $passwordVerify = mysqli_real_escape_string($conn, $_POST["passwordVerify"]);
    $result = mysqli_query($conn, "SELECT username FROM admin_acc WHERE username = '$username';");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar');
        </script>";
    
    } elseif ($password === $passwordVerify) {

        $password = password_hash($password, PASSWORD_DEFAULT);
        $qry = "INSERT INTO admin_acc VALUES(NULL, '$username', '$password', '$name', false)";
        $result = mysqli_query($conn, $qry);

        if (mysqli_affected_rows($conn) > 0) {
            echo "
            <script>
                alert('data berhasil ditambahkan!');
            </script>
            ";
        } else {
            echo "
            <script>
                alert('data gagal ditambahkan!');
            </script>
            ";
        }
    }

    echo "
        <script>
            alert('data gagal ditambahkan!');
        </script>
        ";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin workspace</title>
    <link rel="stylesheet" href="../MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="../MDB5/js/mdb.min.js"></script>
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">

    <style>
        body {
            background-color: #D0d2d2;
        }

        .field {
            background-color: white;
            width: 50%;
            padding: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="content">
            <h1 class="text-center m-3">Add New Admin</h1>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="field-input">

                    <label class="form-label" for="name">Name : </label>
                    <input class="form-control" type="text" name="name" id="name" maxlength="30" required>

                    <label class="form-label" for="username">Username : </label>
                    <input class="form-control" type="text" name="username" id="username" maxlength="30" required>

                    <label class="form-label" for="password">Password : </label>
                    <input class="form-control" type="text" name="password" id="password" maxlength="30" required>

                    <label class="form-label" for="passwordVerify">Password Verify : </label>
                    <input class="form-control" type="text" name="passwordVerify" id="passwordVerify" maxlength="30" required>

                </div>


                <div class="field-input mt-3">
                    <button class="btn btn-primary btn-block" type="submit" name="submit"><i class="fa-solid fa-plus"></i> Create</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>