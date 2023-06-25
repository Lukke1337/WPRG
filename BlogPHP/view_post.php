<?php
require_once 'db_connect.php';

// Pobranie ID wpisu z parametru URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Pobranie informacji o wpisie z bazy danych
    $query = "SELECT * FROM posts WHERE id = :post_id";
    $params = [':post_id' => $post_id];
    $result = executeQuery($query, $params);
    $post = $result->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        // Przekierowanie na stronę główną, jeśli wpis o podanym ID nie istnieje
        header("Location: index.php");
        exit();
    }
} else {
    // Przekierowanie na stronę główną gdy brak parametru ID
    header("Location: index.php");
    exit();
}

// Obsługa dodawania komentarza
if (isset($_POST['add_comment'])) {
    // Pobranie danych z formularza
    $author = isset($_POST['author']) ? $_POST['author'] : 'Gość';
    $content = $_POST['content'];

    // Zapisanie nowego komentarza do bazy danych
    $query = "INSERT INTO comments (post_id, author, content) VALUES (:post_id, :author, :content)";
    $params = [
        ':post_id' => $post_id,
        ':author' => $author,
        ':content' => $content
    ];
    executeQuery($query, $params);
}
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
<h1><?php echo $post['title']; ?></h1>
<p><?php echo $post['content']; ?></p>

<?php if ($post['image']): ?>
    <img src="<?php echo $post['image']; ?>" alt="Obrazek wpisu">
<?php endif; ?>

<p>Data opublikowania: <?php echo $post['date']; ?></p>

<h2>Dodaj komentarz</h2>

<form action="view_post.php?id=<?php echo $post_id; ?>" method="POST">
    <label for="author">Autor:</label>
    <input type="text" name="author" id="author">
    <br>
    <label for="content">Treść:</label>
    <textarea name="content" id="content" rows="4" cols="50"></textarea>
    <br>
    <input type="submit" name="add_comment" value="Dodaj komentarz">
</form>

<footer>
    <p>Stronę wykonał Łukasz Kelsz</p>
</footer>
</body>
</html>
