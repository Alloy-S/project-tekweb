<?php
session_start();
require("connect.php");

if (isset($_SESSION["login_user"])) {
    header("Location: index.php");
}

if (isset($_POST["login"])) {
    $username = $_POST["loginName"];
    $password = $_POST["loginPassword"];

    $result = mysqli_query($conn, "SELECT username, password FROM user WHERE username = '$username';");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            $_SESSION["login_user"] = true;
            $_SESSION["username_user"] = $username;
            // cek remember
            // if (isset($_POST["remember"])) {
            //     setcookie("id", $row["id"], time() + 60);
            //     setcookie("key", hash("sha256", $row["username"]), time() + 60);
            // }

            header("Location: index.php");
            exit;
        } else {
            echo '<script>alert("password salah!")</script>';
        }
    }

    $eror = true;
}

if (isset($_POST['regis'])) {
    if (registrasi($_POST) > 0) {
        echo "
            <script>
            alert('user baru berhasil ditambah!');
            </script>";
        header("Location: login2.php");
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <!-- JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
    <title>Login</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>

    <style>
        .login {
            width: 35%;
            margin-top: 100px;
        }

        @media screen and (max-width: 1114px) and (min-width: 330px) {
            .login {
                width: 60%;
            }
        }


        @media screen and (max-width: 480px) {
            .login {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex justify-content-center">
        <div class="login">
            <!-- Pills navs -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                </li>
            </ul>
            <!-- Pills navs -->

            <!-- Pills content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form action="" method="POST">
                        <div class="text-center mb-3">
                            <p>Sign in with:</p>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="loginName" name="loginName" class="form-control" />
                                <label class="form-label" for="loginName">Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="loginPassword" name="loginPassword" class="form-control" />
                                <label class="form-label" for="loginPassword">Password</label>
                            </div>
                            <?php if(isset($eror)):?>
                            <div class="form-outline mb-4">
                                <p style="color: red;">Username/Password salah!</p>
                            </div>
                            <?php endif;?>
                            <!-- Submit button -->
                            <button type="submit" name="login" class="btn btn-primary btn-block mb-4">Sign in</button>

                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                    <form action="" method="POST">
                        <div class="text-center mb-3">
                            <p>Sign up with:</p>

                            <!-- Name input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="registerName" name="registerName" class="form-control" />
                                <label class="form-label" for="registerName">Name</label>
                            </div>

                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="registerUsername" name="registerUsername" class="form-control" />
                                <label class="form-label" for="registerUsername">Username</label>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="registerEmail" name="registerEmail" class="form-control" />
                                <label class="form-label" for="registerEmail">Email</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="registerPassword" name="registerPassword" class="form-control" />
                                <label class="form-label" for="registerPassword">Password</label>
                            </div>

                            <!-- Repeat Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="registerRepeatPassword" name="registerRepeatPassword" class="form-control" />
                                <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                            </div>


                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-3" name="regis">Sign Up</button>
                    </form>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>
</body>

</html>