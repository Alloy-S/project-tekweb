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

$sen = $_POST["sen"];
// var_dump($_POST);
$kategori = query("SELECT * FROM kategori");

$qry = "SELECT * FROM resep WHERE nama_resep LIKE '%$sen%'";

$data = mysqli_query($conn, $qry);

if (mysqli_num_rows($data) === 0):
    ?>
        <div class="container">
            <h4 class="mt-4 p-2 text-center"><strong>Maaf, tidak ada resep yang tersedia.</strong></h4>
        </div>
    <?php elseif(mysqli_num_rows($data) > 0) :
        foreach ($data as $row): 
    ?>
        <table class="table table-dark table-striped align-middle mb-0 bg-secondary text-white">
                <thead class="bg-secondary text-white h5 fw-bold">
                    <tr>
                        <th><strong>Menu Name</strong></th>
                        <th><strong>Category</strong></th>
                        <th><strong>Author</strong></th>
                        <th><strong>Status</strong></th>
                        <th><strong>Actions</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) : ?>
    
                        <tr>
                            <td style="padding-right: 50px" ;>
                                <div class="d-flex align-items-center">
                                    <img src="../img/resep_img/<?= $row['gambar']; ?>" alt="" style="width: 135px; height: 95px" class="rounded" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 h3"><?= $row['nama_resep']; ?></p>
                                        <!-- <p class="text-muted mb-0">john.doe@gmail.com</p> -->
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php foreach ($kategori as $kat) : ?>
                                    <?php if ($row['id_kategori'] === $kat['id_kategori']) : ?>
                                        <h5 class="fw-normal mb-1 text-white"><?= $kat['nama']; ?></h5>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <div class="h6"> <em> <?= $row['author']; ?></em></div>
                            </td>
                            <td>
                                <?php if ($row['is_approved'] === "1" and $row['is_private'] === "0") : ?>
                                    <span class="badge badge-success rounded-pill d-inline">Live</span>
                                <?php elseif ($row['is_approved'] === "0" and $row['is_private'] === "0") : ?>
                                    <span class="badge badge-warning rounded-pill d-inline">Pending</span>
                                <?php elseif ($row['is_approved'] === "0" and $row['is_private'] === "1") : ?>
                                    <span class="badge badge-primary rounded-pill d-inline">Private</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="detailResep_admin.php?id=<?= $row["id_resep"]; ?>"> <button type="button" class="btn btn-primary btn-rounded btn-sm" data-mdb-ripple-color="#f4ecb8"> ACTION </button></a>
                            </td>
                        </tr>
    
                    <?php endforeach; ?>
                </tbody>
            </table>
    
        <?php endforeach; ?>
    
    <?php endif;?>