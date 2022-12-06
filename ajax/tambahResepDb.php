<?php 
global $conn;
var_dump($data);
$judul = htmlspecialchars($data["nama_resep"]);
$deskripsi = htmlspecialchars($data["deskripsi"]);
$username = $_SESSION["username"];
$kategori = intval($data["kategori"]);
$is_private = $data["is_private"];
// upload gambar
// $gambar = upload($data);
$gambar = $data["image-data"];

$qry = "INSERT INTO resep  
            VALUES
            (null, '$judul', '$deskripsi', '$kategori', SYSDATE(),'$gambar', '$username', 0, 0, 0, '$is_private');";

mysqli_query($conn, $qry);

$result = query("SELECT id_resep FROM resep ORDER BY id_resep DESC LIMIT 1;");
$id_resep = $result[0]['id_resep'];
foreach ($data['detail_bahan'] as $row => $value) {
    $detail_bahan = $data['detail_bahan'][$row];
    $detail_takaran = $data['detail_takaran'][$row];

    $qry = "INSERT INTO bahan VALUES ('$id_resep', '$detail_takaran', '$detail_bahan');";
    mysqli_query($conn, $qry);
}

foreach ($data['detail_langkah'] as $row => $value) {
    $detail_langkah = $data['detail_langkah'][$row];

    $qry = "INSERT INTO langkah VALUES ('$id_resep', '$row', '$detail_langkah');";
    mysqli_query($conn, $qry);
}
?>