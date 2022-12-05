<?php 
include('../connect.php');

// $result = mysqli_query($conn, "SELECT * FROM user WHERE username = 'budi';");
// $row = mysqli_fetch_assoc($result);
// $hash = password_hash("ipen123", PASSWORD_DEFAULT);
// $result = mysqli_query($conn, "INSERT INTO admin_acc VALUES('', 'ipen123', '$hash', 'Alloysius');");
// var_dump($row);
$username = "ipen123";
$password = "ipen123";


$result = mysqli_query($conn, "SELECT username, password FROM admin_acc WHERE username = '$username';");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        var_dump($row);
        if (password_verify($password, $row["password"])) {
            
            // cek remember
            // if (isset($_POST["remember"])) {
            //     setcookie("id", $row["id"], time() + 60);
            //     setcookie("key", hash("sha256", $row["username"]), time() + 60);
            // }
            echo '<script>alert("password benar!")</script>';
            
        } else {
            echo '<script>alert("password salah!")</script>';
        }
    }
?>

