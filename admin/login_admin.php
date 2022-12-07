<?php
session_start();
require("../connect.php");

if (isset($_SESSION["login_admin"])) {
    header("Location: index.php");
}

if (isset($_POST["submit"])) {
    $username = $_POST["loginName"];
    $password = $_POST["loginPassword"];

    $result = mysqli_query($conn, "SELECT username, password FROM admin_acc WHERE username = '$username';");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        var_dump($row);
        if (password_verify($password, $row["password"])) {
            $_SESSION["login_admin"] = true;
            $_SESSION["username"] = $username;
            // cek remember
            // if (isset($_POST["remember"])) {
            //     setcookie("id", $row["id"], time() + 60);
            //     setcookie("key", hash("sha256", $row["username"]), time() + 60);
            // }
            echo '<script>alert("password benar!")</script>';
            header("Location: index.php");
            exit;
        } else {
            echo '<script>alert("password salah!")</script>';
        }
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
    <link rel="stylesheet" href="../MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="../MDB5/js/mdb.min.js"></script>

    <style>
        .login {
            width: 30%;

        }

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
    </style>
</head>

<body>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
    <?php if (isset($_POST["eror"])): ?>
    <p>eror</p>
    <?php endif; ?>
    <div class="d-flex justify-content-center align-items-center">
        <div class="login">
            <h4 class="text-center mb-4 mt-5">Welcome Admin</h4>
            <!-- Pills navs -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                        aria-controls="pills-login" aria-selected="true">Login</a>
                </li>
            </ul>
            <!-- Pills navs -->

            <!-- Pills content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form method="POST">
                        <div class="text-center mb-3">
                            <!-- <p>Sign in with:</p> -->
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="loginName" name="loginName" class="form-control" />
                                <label class="form-label" for="loginName">Email or username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="loginPassword" name="loginPassword" class="form-control" />
                                <label class="form-label" for="loginPassword">Password</label>
                            </div>

                            <!-- 2 column grid layout -->
                            <div class="row mb-4">
                                <!-- <div class="col-md-6 d-flex justify-content-center"> -->
                                <!-- Checkbox -->
                                <!-- <div class="form-check mb-3 mb-md-0"> -->
                                <!-- <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked /> -->
                                <!-- <label class="form-check-label" for="loginCheck"> Remember me </label> -->
                                <!-- </div> -->
                                <!-- </div> -->

                                <div class="col-md-6 d-flex justify-content-center">
                                    <!-- Simple link -->
                                    <a href="#!">Forgot password?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

                            <!-- Register buttons -->
                            <!-- <div class="text-center">
                                <p>Not a member? <a href="#pills-register">Register</a></p>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
            <!-- Pills content -->
        </div>
    </div>
</body>

</html>