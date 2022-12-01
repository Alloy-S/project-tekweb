<?php
$conn = mysqli_connect("localhost", "root", "", "gudangresep", 3306);

if ($conn->connect_error) {
    echo "Error: could no connect. " . mysqli_connect_error();
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["registerUsername"]));
    $password = mysqli_real_escape_string($conn, $data["registerPassword"]);
    $password2 = mysqli_real_escape_string($conn, $data["registerRepeatPassword"]);
    $nama = stripslashes($data["registerName"]);
    $email = strtolower(stripslashes($data["registerEmail"]));
    //cek username
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username';");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar');
        </script>";
        return false;
    }

    //cek password
    if ($password !== $password2) {
        echo "<script>
            alert('pasword tidak sesuai!');
        </script>";
        return false;
    }

    //enkripsi password
    // $password = password_hash($password, PASSWORD_DEFAULT);

    //tambah user baru ke data base
    $qry = "INSERT INTO user VALUES('', '$username', '$password', '$nama', '$email');";
    mysqli_query($conn, $qry);

    return mysqli_affected_rows($conn);
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{

    global $conn;
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $username = $_SESSION["username"];
    $domisili = htmlspecialchars($data["domisili"]);
    //upload gambar
    // $gambar = upload();
    // if (!$gambar) {
    //     return false;
    // }

    $qry = "INSERT INTO mahasiswa  
                VALUES
                ('$nrp', '$username', '$nama', '$domisili', '$alamat');";

    mysqli_query($conn, $qry);

    return mysqli_affected_rows($conn);
}

function tambah_resep($data)
{

    global $conn;
    $judul = htmlspecialchars($data["nama_resep"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $username = $_SESSION["username"];
    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
        exit;
    } else {

        $qry = "INSERT INTO resep  
                VALUES
                (null, '$judul', '$deskripsi', 'makanan', SYSDATE(),'$gambar', '$username', 0);";

        mysqli_query($conn, $qry);

        $result = query("SELECT id_resep FROM resep ORDER BY id_resep DESC LIMIT 1;");
        $id_resep = $result[0]['id_resep'];
        foreach($data['detail_bahan'] as $row => $value) {
            $detail_bahan = $data['detail_bahan'][$row];
            $detail_takaran = $data['detail_takaran'][$row];

            $qry = "INSERT INTO bahan VALUES ('$id_resep', '$row', '$detail_takaran', '$detail_bahan');";
            mysqli_query($conn, $qry); 
        }

        foreach($data['detail_langkah'] as $row => $value) {
            $detail_langkah = $data['detail_langkah'][$row];

            $qry = "INSERT INTO langkah VALUES ('$id_resep', '$row', '$detail_langkah');";
            mysqli_query($conn, $qry); 
        }
    }

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek gambar tidak ada gambar yg diupload
    if ($error === 4) {
        echo "<script>
        alert('pilih gambar terlebih dahulu')
        </script>";
        return;
    }

    //cek apakah gambar
    $ekstensiGambarValid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        alert('File bukan Gambar')
        </script>";
        return;
    }

    //cek ukuran gambar terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('File Gambar terlalu besar')
        </script>";
        return;
    }

    //generate nama gambar baru
    $namaFilebaru = uniqid();
    $namaFilebaru .= '.';
    $namaFilebaru .= $ekstensiGambar;
    //lolos pengecekan
    move_uploaded_file($tmpName, "img/" . $namaFilebaru);
    return $namaFilebaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $qry = "UPDATE mahasiswa  
                    SET nama='$nama', nrp='$nrp', email='$email', gambar='$gambar', jurusan='$jurusan'
                    WHERE id = $id;
                    ";

    mysqli_query($conn, $qry);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa 
    where 
    nama LIKE '%$keyword%' OR
    nrp = '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%'
    ;";
    return query($query);
}

function cariData($keyword, $limitData, $startIndex)
{
    $query = "SELECT * FROM mahasiswa 
    where 
    nama LIKE '%$keyword%' OR
    nrp = '%$keyword%' OR
    email LIKE '%$keyword%' OR
    jurusan LIKE '%$keyword%'
    LIMIT $limitData, $startIndex
    ;";
    return query($query);
}
