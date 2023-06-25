<?php
require_once 'db_connect.php';

class AddComment {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addComment($post_id, $author, $content) {
        $query = "INSERT INTO comments (post_id, author, content) VALUES (:post_id, :author, :content)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
    }
}

session_start();

// Sprawdzenie, czy użytkownik jest zalogowany i ma odpowiednie uprawnienia
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'author') {
    header("Location: index.php");
    exit();
}

// Sprawdzenie, czy przekazano identyfikator wpisu
if (!isset($_POST['post_id'])) {
    header("Location: index.php");
    exit();
}

$commentAuthor = isset($_POST['author']) ? $_POST['author'] : 'Gość';
$commentContent = $_POST['content'];
$post_id = $_POST['post_id'];

$pdo = new PDO('mysql:host=localhost;dbname=blog', 'username', 'password');
$addComment = new AddComment($pdo);

if (isset($_POST['add_comment'])) {
    $addComment->addComment($post_id, $commentAuthor, $commentContent);
    header("Location: view_post.php?id=" . $post_id);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dodaj komentarz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<h2>Dodaj komentarz</h2><br>

<form action="add_comment.php" method="POST">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
    <label for="author">Autor:</label>
    <input type="text" name="author" id="author">
    <br>
    <label for="content">Treść:</label>
    <textarea name="content" id="content" rows="4" cols="50"></textarea>
    <br>
    <input type="submit" name="add_comment" value="Dodaj komentarz">
</form>

</body>
</html>
