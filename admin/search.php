<link rel="stylesheet" href="../MDB5/css/mdb.min.css" />
<script type="text/javascript" src="../MDB5/js/mdb.min.js"></script>

<style>
    .input-bar {
            width: 25%;
        }

        .dropdown-status {
            width: 20%;
        }

        @media screen and (max-width: 1100px) {
            .salam {
                font-weight: 300;
            }

            .sambutan_atas {
                display: flex;
                flex-direction: column;
            }

            .input-bar {
                padding-top: 5px;
                width: 60%;
            }
        }

        @media screen and (max-width: 750px) and (min-width: 480px) {
            .input-bar {
                padding-top: 5px;
                width: 50%;
            }

        }

        @media screen and (max-width: 480px) {
            .input-bar {
                padding-top: 5px;
                width: 70%;
            }
            .dropdown-status {
            width: 30%;
            }
        }
</style>

<?php

include "../connect.php";

$sen = $_POST["sentence"];
$kategori = query("SELECT * FROM kategori");

$qry = "SELECT * FROM resep WHERE nama_resep LIKE '%'" . $sen . "'%'";

$data = mysqli_query($conn, $qry);

?>