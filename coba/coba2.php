<?php 
include('../connect.php');

$result = mysqli_query($conn, "SELECT * FROM user WHERE username = 'budi';");
$row = mysqli_fetch_assoc($result);
// $hash = password_hash("budi1", PASSWORD_DEFAULT);
// $result = mysqli_query($conn, "INSERT INTO user VALUES('', 'budi1', '$hash', 'budi', 'wkwkw@gmail.com');");
var_dump($row);



if(password_verify("budi1", $row['password'])) {
    echo '<br>true';
} else {
    echo '<br>false';
}

?>

