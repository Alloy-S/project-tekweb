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
            margin: auto;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            overflow: auto;
            background: linear-gradient(315deg, rgba(231, 152, 255, 1) 3%, rgba(60, 132, 206, 1) 38%, rgba(48, 238, 226, 1) 68%, rgba(255, 170, 25, 1) 98%);
            animation: gradient 15s ease infinite;
            background-size: 400% 400%;
            background-attachment: fixed;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 100% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        .wave {
            background: rgb(255 255 255 / 20%);
            border-radius: 1000% 1000% 0 0;
            position: fixed;
            width: 200%;
            height: 12em;
            animation: wave 10s -3s linear infinite;
            transform: translate3d(0, 0, 0);
            opacity: 0.8;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wave:nth-of-type(3) {
            bottom: -2.5em;
            animation: wave 20s -1s reverse infinite;
            opacity: 0.9;
        }

        @keyframes wave {
            2% {
                transform: translateX(1);
            }

            25% {
                transform: translateX(-25%);
            }

            50% {
                transform: translateX(-50%);
            }

            75% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(1);
            }
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
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="card content">
            <h1 class="text-center m-3"><strong>Add New Admin</strong></h1>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="field-input mt-3">

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