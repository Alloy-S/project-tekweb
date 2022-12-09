<?php 
include('../connect.php');

// $result = mysqli_query($conn, "SELECT * FROM user WHERE username = 'budi';");
// $row = mysqli_fetch_assoc($result);
$hash = password_hash("superadmin", PASSWORD_DEFAULT);
$result = mysqli_query($conn, "INSERT INTO admin_acc VALUES('', 'superadmin', '$hash', 'Alloysius', true);");
var_dump($row);
$data = query("SELECT * FROM kategori");
var_dump($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach($data as $row):?> 
    <?= $row['nama']; ?>
<?php endforeach;?>
</body>
</html>
