<?php
require("../connect.php");
if (isset($_SESSION["login_user"])) {
    $author = $_SESSION["username_user"];
} else {
    $author = "Anonymous";
}
$comment = $_POST["comment"];
$resep_id = $_POST["id_resep"];
$reply = $_POST['id-reply'];
$query = "INSERT INTO `comments`(`comment_id`, `author`, `id_resep`, `comment`, `date_created`, `reply`) VALUES ('','$author','$resep_id','$comment',NOW(), $reply);";
$result = mysqli_query($conn, $query);

$query = "SELECT * FROM comments WHERE reply = '$reply' ORDER BY comment_id ASC";
$result = mysqli_query($conn, $query);

$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<button type="button" class="btn btn-secondary reply mb-2" value="<?= $reply; ?>" style="display:block;" idresep="<?= $r['id_resep']; ?>">Reply</button>
<?php foreach ($result as $r) : ?>
    <div class="comment-header mx-4"><b><?= $r['author']; ?></b> on <i><?= $r["date_created"]; ?></i> </div>
    <div class="comment-content mx-4"><?= $r["comment"] ?></div>
<?php endforeach; ?>