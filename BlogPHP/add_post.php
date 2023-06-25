<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany i ma odpowiednie uprawnienia
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'author') {

    exit();
}

// Obsługa dodawania nowego wpisu
if (isset($_POST['add_post'])) {
    // Pobranie danych z formularza
    $title = $_POST['title'];
    $content = $_POST['content'];
    // Przetworzenie obrazka i zapisanie na serwerze
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "images/" . $image_name;
        move_uploaded_file($image_tmp, $image_path);
    } else {
        $image_path = null;
    }
    // Zapisanie wpisu do bazy danych
    $pdo = new PDO('mysql:host=localhost;dbname=blog', 'username', 'password');
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, image) VALUES (:title, :content, :image)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':image', $image_path);
    $stmt->execute();

    // Przekierowanie na stronę główną po dodaniu wpisu
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Dodaj wpis</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<header>
    <h1>Najlepszy blog na świecie</h1>
    <nav>
        <ul>
            <li><a href="index.php">Strona główna</a></li>
            <li><a href="admin_panel.php">Panel administracyjny</a></li>
            <li><a href="contact.php">Kontakt</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Dodaj nowy wpis</h2>
    <form method="POST" action="add_post.php" enctype="multipart/form-data">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required></textarea>
        <br>
        <label for="image">Obrazek:</label>
        <input type="file" id="image" name="image">
        <br>
        <input type="submit" name="add_post" value="Dodaj wpis">
    </form>
</main>

<footer>
    <p>Stronę wykonał Łukasz Kelsz</p>
</footer>
</body>
</html>
