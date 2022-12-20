<?php

include "../connect.php";

$pil = $_POST["pil"];
$kategori = query("SELECT * FROM kategori");
// var_dump($pil);
if($pil === "0"){
    $data = mysqli_query($conn, "SELECT * FROM resep");
?>
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

<?php } elseif ($pil === "1") {
    $data = mysqli_query($conn, "SELECT * FROM resep WHERE is_private = 1");
?>

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

<?php } elseif ($pil === "2") {
    $data = mysqli_query($conn, "SELECT * FROM resep WHERE is_approved = 1");
?>

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

<?php } elseif ($pil === "3") {
    $data = mysqli_query($conn, "SELECT * FROM resep WHERE is_private = 0 AND is_approved = 0");
?>

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

<?php } ?>