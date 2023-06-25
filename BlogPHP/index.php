<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Najlepszy blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<div class="container">

    <h1>Najlepszy blog na świecie</h1><br>
    <div class="login-panel">
        <?php
//        session_start();
        // Sprawdzenie, czy użytkownik jest już zalogowany
        if (isset($_SESSION['username'])) {
            // Gdy użytkownik zalogowany
            echo "Witaj, " .  $_SESSION['username']  . " na blogu!";
        } else {
            // Wyświetlenie formularza logowania
//            echo '<a href="login.php" class="login-button">Zaloguj</a>';
        }
        ?>
    </div>
    <div class="left"></div>
    <div class="content">
        <?php
        include 'db_connect.php';

        // Utworzenie połączenia z bazą danych
        $connection = mysqli_connect("localhost", "root", '', 'blog');

        // Sprawdzenie, czy połączenie zostało zawarte
        if (!$connection) {
            die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM posts ORDER BY published_date DESC";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="post">';
                echo '<h2 class="post-title">' . $row['title'] . '</h2>';
                echo '<p class="post-date">' . $row['published_date'] . '</p>';
                echo '<p class="post-content">' . $row['content'] . '</p>';

                if (!empty($row['image'])) {
                    echo '<img class="post-image" src="images/' . $row['image'] . '" alt="Post Image">';
                }

                echo '</div>';
            }
        } else {
            echo 'Brak wpisów na blogu.';
        }

        // Zamknij połączenie z bazą danych
        mysqli_close($connection);
        ?>
    </div>
    <div class="right"></div>
</div>
<footer>
    <p>Stronę wykonał Łukasz Kelsz</p>
</footer>
</body>
</html>
