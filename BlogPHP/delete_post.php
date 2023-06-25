<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany i ma odpowiednie uprawnienia
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'author') {
    header("Location: nopermission.php");
    exit();
}

// Sprawdzenie, czy został przekazany identyfikator wpisu
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

// Pobranie identyfikatora wpisu z parametru GET
$post_id = $_GET['id'];

// Połączenie z bazą danych
$pdo = new PDO('mysql:host=localhost;dbname=blog', 'username', 'password');

// Pobranie informacji o wpisie z bazy danych
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :post_id");
$stmt->bindParam(':post_id', $post_id);
$stmt->execute();
$post = $stmt->fetch();

// Sprawdzenie, czy wpis istnieje i czy użytkownik ma do niego dostęp
if (!$post || $post['author'] !== $_SESSION['username']) {
    header("Location: nopermission.php");
    exit();
}

// Obsługa usuwania wpisu
if (isset($_POST['delete_post'])) {
    // Usunięcie wpisu z bazy danych
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :post_id");
    $stmt->bindParam(':post_id', $post_id);
    $stmt->execute();

    // Przekierowanie na stronę główną po usunięciu wpisu
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Mój Blog - Usuń wpis</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <br><?php include 'menu.php'; ?><br><br>
    <h1>Mój Blog</h1><br>

    <nav>
        <ul>
            <li><a href="index.php">Strona główna</a></li>
            <li><a href="admin_panel.php">Panel administracyjny</a></li>
            <li><a href="contact.php">Kontakt</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Usuń wpis</h2>
    <p>Czy na pewno chcesz usunąć ten wpis?</p>
    <h3><?php echo $post['title']; ?></h3>
    <p><?php echo $post['content']; ?></p>
    <form method="POST" action="delete_post.php">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="submit" name="delete_post" value="Usuń">
    </form>
</main>

<footer>
    <p>Stronę wykonał Łukasz Kelsz</p>
</footer>
</body>
</html>
