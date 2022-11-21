<?php 
session_start();
require("connect.php");

// if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
//     $id = $_COOKIE["id"];
//     $key = $_COOKIE["key"];

//     //ambil username berdasarkan id
//     $result = mysqli_query($database, "SELECT username FROM user WHERE id = $id;");

//     $row = mysqli_fetch_assoc($result);

//     //cek cookie dan username
//     if($key === hash("sha256", $row['username'])) {
//         $_SESSION["login"] = true;
//     }
    
// }
if(isset($_SESSION["login"])) {
    header("Location: index.php");
}

    if(isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $result = $conn->query("SELECT * FROM user WHERE username = '$username';");
        // $result = mysqli_query($database, "SELECT * FROM user WHERE username = '$username';");
        print_r($result);
        if (mysqli_num_rows($result) !== 1) {
            $eror = true;
            header("Location: login.php");
            exit;
        }
        
        $row = mysqli_fetch_assoc($result);
        echo "<br>";
        print_r($row);

        if($password !== $row["password"]) {
            $eror = true;
            header("Location: login.php");
            exit;
        }

        echo "hello world";
        $_SESSION["login"] = true;
        $_SESSION["username"] = $username;
        // cek remember
        // if(isset($_POST["remember"])) {
        //     setcookie("id", $row["id"], time() + 60);
        //     setcookie("key", hash("sha256", $row["username"]), time() + 60);
        // }
        header("Location: index.php");
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <style>
        /* label {
            display: block;
        } */
    </style>
</head>
<body>
    <h1>Halaman login</h1>
    <?php if(isset($eror)) :?>
        <p style="color: red; font-style:italic;">Username/Password salah</p>
    <?php endif;?>

    <form action="" method="post">
        <ul>
        <li>
            <label for="username">Username : </label>
            <input type="text" name="username" id="username">
        </li>

        <li>
            <label for="password">password : </label>
            <input type="password" name="password" id="password"> 
        </li>
        <li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">remember me</label>
        </li>
        <li>
            <a href="registrasi.php">registrasi</a>
        </li>
        <li>
            <button type="submit" name="submit">LOGIN</button>
        </li>
        </ul>

    </form>

    
</body>
</html>