<?php
include 'db_connect.php';

// Utwórz połączenie z bazą danych
$connection = mysqli_connect("localhost", "root", '', 'blog');

// Sprawdź, czy połączenie zostało poprawnie ustanowione
if (!$connection) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

// Sprawdź, czy przekazano identyfikator wpisu do edycji
if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Zapytanie SQL do pobrania informacji o wpisie
    $query = "SELECT * FROM posts WHERE id = $postId";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // Wpis został znaleziony, pobierz dane
        $row = mysqli_fetch_assoc($result);

        $title = $row['title'];
        $content = $row['content'];
        // ...
        // Pozostałe pola z bazy danych
    } else {
        echo 'Wpis o podanym identyfikatorze nie został znaleziony.';
    }
} else {
    echo 'Nie przekazano identyfikatora wpisu do edycji.';
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja wpisu</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>Edycja wpisu</h1>

<div class="container">
    <div class="menu">
        <!-- Menu poziome -->
        <ul>
            <li><a href="index.php">Strona główna</a></li>
            <li><a href="add_post.php">Dodaj wpis</a></li>
            <li><a href="admin_panel.php">Panel administracyjny</a></li>
            <li><a href="contact.php">Kontakt</a></li>
            <?php
            // Sprawdzenie, czy użytkownik jest zalogowany
            session_start();
            if (isset($_SESSION['username'])) {
                echo '<li><a href="logout.php">Wyloguj</a></li>';
            } else {
                echo '<li><a href="login.php">Zaloguj</a></li>';
                echo '<li><a href="registration.php">Rejestracja</a></li>';
                echo '<li><a href="reset_password.php">Reset hasła</a></li>';
            }
            ?>
        </ul>
    </div>

    <div class="content">
        <h2>Formularz edycji wpisu</h2>

        <?php
        if (isset($postId)) {
            echo '<form method="POST" action="update_post.php">
                <input type="hidden" name="postId" value="' . $postId . '">
                <label for="title">Tytuł:</label>
                <input type="text" id="title" name="title" value="' . $title . '">
                <label for="content">Treść:</label>
                <textarea id="content" name="content">' . $content . '</textarea>
                <!-- Pozostałe pola formularza -->
                <input type="submit" value="Zapisz zmiany">
            </form>';
        }
        ?>
    </div>
</div>
</body>
</html>
