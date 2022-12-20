<?php
    include("../connect.php");
    
    $filter = isset($_GET["kategori"]) ? $_GET["kategori"] : "";

    $limit = 8;
    $page = 0;
?>

    <div class="container" id="card-resep">
        <div style="margin-top: 3%;">
            <div class="row g-2">

<?php
    $data = query("SELECT * FROM resep WHERE is_approved = 1");
    $total_data = count($data);
    $total_pages = ceil($total_data / $limit);

    if (isset($_POST["page"])) { $page  = $_POST["page"]; } else { $page=1; };

    $initial_page = ($page - 1) * $limit;
    $data = query("SELECT * FROM resep WHERE is_approved = 1 LIMIT $initial_page, $limit");

    // Fetch card resep
    if(count($data) > 0) {
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
        }
?>

        
        </div>
    </div>
</div>

<?php
    }
?>

    <!-- Code Pagination -->
    <ul class="pagination pagination-md justify-content-center" style="margin-bottom: -12%; margin-top: 5%;">

<?php
    if($page > 1) {
        $prev = $page - 1;
?>

        <li class="page-item" id="1"><span class="page-link">First Page</span></li>
        <li class="page-item" id=<?= $prev ?>><span class="page-link"><i class="fa fa-arrow-left"></i></span></li>

<?php
    }

    for($i=1;$i<=$total_pages;$i++) {
        $active_class = '';
        if($i == $page) {
            $active_class = ' active';
        }
?>

        <li class="page-item <?= $active_class ?>" id=<?= $i ?>><span class="page-link"><?= $i ?></span></li>

<?php
    }

    if($page < $total_pages) {
        $next = $page + 1;
?>

        <li class="page-item" id=<?= $next ?>><span class="page-link"><i class="fa fa-arrow-right"></i></span></li>
        <li class="page-item" id=<?= $total_pages ?>><span class="page-link">Last Page</span></li>

<?php
    }
?>

    </ul>
