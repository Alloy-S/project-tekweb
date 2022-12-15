<?php 
require("../connect.php");



$id = $_POST['id'];
$result = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id");

$result = mysqli_query($conn, "SELECT * FROM kategori");

mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach($result as $row):
?>

<tr>
    <td><?= $row['id_kategori']; ?></td>
    <td><?= $row['nama']; ?></td>
    <td><button class="btn btn-danger delete" value="<?= $row['id_kategori']; ?>">Delete</button></td>
</tr>
<?php endforeach;?>