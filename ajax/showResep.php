<?php
require("../connect.php");
$username = $_POST['username'];
$status = $_POST['status'];

if ($status == "all") {
    $result = mysqli_query($conn, "SELECT * FROM resep WHERE author = '$username' AND is_private = 0");
    $resep = mysqli_fetch_all($result, MYSQLI_ASSOC);
} elseif ($status == "private") {
    $result = mysqli_query($conn, "SELECT * FROM resep WHERE author = '$username' AND is_private = 1");
    $resep = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// var_dump($resep);
?>
<?php if (isset($result)) : ?>
    <?php if (mysqli_num_rows($result) > 0) : ?>
        <?php foreach ($resep as $row) : ?>
            <div class="col-6 col-lg-4">
                <div class="card m-2">
                    <a href="editResep.php?id=<?= $row["id_resep"]; ?>">
                        <div class="ratio ratio-16x9">
                            <img src="img/resep_img/<?= $row["gambar"]; ?>" class="card-img-top" alt="<?= $row["nama_resep"]; ?>" style="object-fit:cover;">
                        </div>
                    </a>
                    <div class="card text-center">
                        <a href="editResep.php?id=<?= $row["id_resep"]; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $row["nama_resep"]; ?></h5>
                            </div>
                        </a>
                        <div class="icon-content d-flex flex-row justify-content-center">
                            <div class="icon-field me-1">
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
        <?php endforeach; ?>
        <?php else: ?>
            <div class="d-flex justify-content-center aligns-item-center text-center my-5" style="padding-top: 30px">
                <h4>Belum ada resep <?= $status?></h4>
            </div>
    <?php endif; ?>
<?php endif; ?>