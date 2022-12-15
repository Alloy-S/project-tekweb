<?php 
require("../connect.php");



$namaKategori = $_POST['namaKategori'];
$result = mysqli_query($conn, "INSERT INTO kategori VALUES(null, '$namaKategori')");

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