<?php
//require_once 'db_connect.php';
include('require_all.php');
session_start();


// Pobranie ID wpisu z parametru URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $db_post = new db_post();
    // Pobranie informacji o wpisie z bazy danych
    $post = $db_post->getById($post_id);

    if (!$post) {
        // Przekierowanie na stronę główną, jeśli wpis o podanym ID nie istnieje
        header("Location: index.php");
    }
} else {
    // Przekierowanie na stronę główną gdy brak parametru ID
    header("Location: index.php");
}

// Obsługa dodawania komentarza

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Wpis</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<div class="container">
    <div class="post">

<h1><?php echo $post['title']; ?></h1><br>
<p><?php echo $post['content']; ?></p><br>

<?php if ($post['image']): ?>
    <img src="<?php echo $post['image']; ?>" alt="Obrazek">
<?php endif; ?><br><br>

<p style="font-size:12px">Data opublikowania: <?php echo $post['published_date']; ?></p>
    </div>
    <div class="post" style="border: 3px solid #5dbcd2; border-radius: 3px;">
    <h2>Dodaj komentarz</h2>

<form action="add_comment.php" method="POST">
<!--    <label for="author">Autor:</label>-->
<!--    <input type="text" name="author" id="author">-->
<!--    <br>-->
    <label for="content">Treść:</label>
    <textarea name="content" id="content" rows="8" cols="64" maxlength="512" required ></textarea>
    <br>
    <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
    <input type="submit" id="click" name="add_comment" value="Dodaj komentarz">
</form><br>

        <?php
         $db = new mysqli('localhost', 'root', '', 'blog');
        $stmt = $db->prepare('SELECT * FROM comments WHERE post_id = ?');
        $stmt->bind_param('i', $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = [];
        while($comment = $result->fetch_assoc()) {
            $comments[] = $comment;
        }
        $result->free_result();
        $stmt->close();
        if(count($comments) == 0) {
            echo 'Brak komentarzy';
        }
        else foreach ($comments as $comment): ?>

        <div class="registration">
        <h4><?php
            $username = 'Gość';
            if($comment['user_id'] !== 0) {
                $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
                $stmt->bind_param('i', $comment['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $username = $user['username'];
            }
            echo $username;
            ?>
        </h4>
        <h6>
        <?php echo $comment['created_date'] ?>
        </h6><br>
        <p><?php echo $comment['comment']; ?></p>
            <?php if(isset($_SESSION['user']) && ($_SESSION['user']->getRole() === 'admin' || $_SESSION['user']->getRole() === 'author' || $comment['user_id'] === $_SESSION['user']->getId())):  ?>
            <form method="POST" action="del_comment.php">
            <button type="submit" style="border: solid #ddd; cursor: pointer; float: right"><img src="images\kasuj.png" alt="kasuj" id="kasuj"></button>
            <input type="hidden" name="post_id" value="<?php echo $_GET['id'] ?>">
                <input type="hidden" name="comment_id" value="<?php echo $comment['id'] ?>">
<!--            <input id="kasuj" type="submit" src="images\kasuj.png">-->
            </form>
            <?php endif; ?>
        </div>


    <?php
//            header("Location: view_post.php");
            endforeach;
            ?>
    </div>
<footer>
    <p>Stronę wykonał Łukasz Kelsz</p>
</footer>
</body>
</html>