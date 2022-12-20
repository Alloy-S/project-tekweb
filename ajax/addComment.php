<?php
session_start();
include('../connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // $author =  $_POST["name"];       
        if (isset($_SESSION["login_user"])) {
                $author = $_SESSION["username_user"];
        } else {
                $author = "Anonymous";
        }
        $comment = $_POST["comment"];
        $resep_id = $_POST["id_resep"];

        if (isset($_POST['id-reply'])) {
                $reply = $_POST['id-reply'];
                $query = "INSERT INTO `comments`(`comment_id`, `author`, `id_resep`, `comment`, `date_created`, `reply`) VALUES ('','$author','$resep_id','$comment',NOW(), $reply);";
        } else {
                $query = "INSERT INTO `comments`(`comment_id`, `author`, `id_resep`, `comment`, `date_created`, `reply`) VALUES ('','$author','$resep_id','$comment',NOW(), null);";
        }

        $result = mysqli_query($conn, $query);
        if ($result) {
                $msg = "Comment posted";
        } else {
                $msg = "Failed to post comment";
        }
        // echo $msg;
}

$query = "SELECT * FROM comments WHERE id_resep = '$resep_id' and reply is null ORDER BY comment_id ASC";
$result = mysqli_query($conn, $query);

$result = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>

<?php foreach ($result as $r) : ?>

<div class="comment-header"><b><?= $r['author']; ?></b> on <i><?= $r["date_created"]; ?></i> </div>
<div class="comment-content"><?= $r["comment"] ?></div>
<div class="reply-form">
    <button type="button" class="btn btn-secondary reply mb-2" value="<?= $r["comment_id"]; ?>" style="display:block;" idresep="<?= $r['id_resep']; ?>">Reply</button>
    <?php
    $reply = $r['comment_id'];
    $query = "SELECT * FROM comments WHERE reply = '$reply' ORDER BY comment_id ASC";
    $child = mysqli_query($conn, $query);
    if (mysqli_num_rows($child) > 0) :
        $row = mysqli_fetch_all($child, MYSQLI_ASSOC);
    ?>
        <?php foreach ($row as $ro) : ?>
            <div class="comment-header mx-4"><b><?= $ro['author']; ?></b> on <i><?= $ro["date_created"]; ?></i> </div>
            <div class="comment-content mx-4"><?= $ro["comment"] ?></div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php endforeach; ?>