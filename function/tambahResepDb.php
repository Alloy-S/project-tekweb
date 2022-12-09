<?php 
session_start();
require("../connect.php");
if (tambah_resep($_POST) > 0) {
    // $_POST = array();
    echo "
<script>
    alert('data berhasil ditambahkan!');
    // document.location.href = 'index.php';
</script>
";
} else {
    // $_POST = array();
    echo "
<script>
    alert('data gagal ditambahkan!');
    // document.location.href = 'index.php';
</script>
";
}
?>
