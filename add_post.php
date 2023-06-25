<?php

include('require_all.php');
session_start();

//session_start();
// Sprawdzenie, czy użytkownik jest zalogowany i ma odpowiednie uprawnienia
if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() === 'user') {
        header("Location: nopermission.html");
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
    try { $db = new mysqli('localhost', 'root', '', 'blog');
    $stmt = $db->prepare('INSERT INTO posts (title, content, image, published_date, author_id) VALUES (?,?,?,?,?)');
    $date = date('Y-m-d H:i:s');
    $user_id = $_SESSION['user']->getId();
    $stmt->bind_param('ssssi', $_POST['title'], $_POST['content'], $image_path, $date, $user_id);
    $stmt->execute();
    echo 'by';
    } catch( mysqli_sql_exception $e) {
        echo $e->getMessage();
    }

//     Przekierowanie na stronę główną po dodaniu wpisu
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Dodaj wpis</title>

</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<!--<header>-->
<!--    <h1>Najlepszy blog na świecie</h1>-->
<!--    <nav>-->
<!--        <ul>-->
<!--            <li><a href="index.php">Strona główna</a></li>-->
<!--            <li><a href="admin_panel.php">Panel administracyjny</a></li>-->
<!--            <li><a href="contact.php">Kontakt</a></li>-->
<!--        </ul>-->
<!--    </nav>-->
<!--</header>-->

<main>
    <h1>Dodaj nowy wpis</h1><br>
    <div class="container">
        <div class="registration">
    <form method="POST" action="add_post.php" enctype="multipart/form-data">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" required>
        <br><br>
        <label for="content">Treść:</label>
        <textarea id="content" name="content" required></textarea>
        <br><br>
        <label for="image">Obrazek:</label>
        <input type="file" id="image" name="image">
        <br><br>
        <input id="click" type="submit" name="add_post" value="Dodaj wpis">
    </form>
        </div>
    </div>
</main>

<footer>
    <p>Stronę wykonał Łukasz Kelsz</p>
</footer>
</body>
</html>
