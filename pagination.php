<?php

include("connect.php");

$limit = 8;  

if (isset($_GET["page"])) { $page_number  = $_GET["page"]; } else { $page_number=1; };  

$initial_page = ($page_number-1) * $limit;  
?>

<div class="container" id='card-resep'>
    <div style="margin-top: 3%;">
        <div class="row g-2">

<?php
$data = query("SELECT * FROM resep WHERE is_approved = 1 LIMIT $initial_page, $limit");  

foreach ($data as $row) {  
?>  

        <div class="col-6 col-lg-3">
            <div class="card m-2">
                <a href="detailResep.php?id=<?= $row["id_resep"]; ?>">
                    <div class="ratio ratio-16x9">
                        <img src="img/resep_img/<?= $row["gambar"]; ?>" class="card-img-top" alt="<?= $row["nama_resep"]; ?>" style="object-fit:cover;">
                    </div>
                </a>
                <div class="card text-center">
                    <a href="detailResep.php?id=<?= $row["id_resep"]; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row["nama_resep"]; ?></h5>
                        </div>
                    </a>
                    <div class="icon-content d-flex flex-row justify-content-center">
                        <div class="icon-field">
                            <i class="fa-solid fa-eye"></i><span id="view"><?= $row['views']; ?></span>
                        </div>
                        <div class="icon-field btn-like" value="<?= $row['id_resep']; ?>" status="0">
                            <span style="color: red;">
                                <i class="fa-regular fa-heart"></i>
                            </span>
                            <span class="like"><?= $row['likes']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php  

};  

?>  

        </div>
    </div>
</div> 