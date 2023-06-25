<html lang="pl">
<head></head>
<body>
<div class="title">
    <b>NAJLEPSZY BLOG NA ŚWIECIE</b>
</div>
<div class="menu">
    <ul>
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="add_post.php">Dodaj wpis</a></li>



        <?php
        // Sprawdzenie, czy użytkownik jest już zalogowany
        if (isset($_SESSION['user'])) {
            // Gdy użytkownik zalogowany
            echo '<li><a href="admin_panel.php">Panel administracyjny</a></li>';
            echo '<li><a href="contact.php">Kontakt</a></li>';
            echo '<li><a href="reset_password.php">Zmiana hasła</a></li>';
            echo '<li><a href="logout.php" class="logout-button">Wyloguj</a></li>';
        } else {
            // Wyświetlenie przycisku logowania
            echo '<li><a href="registration.php">Rejestracja</a></li>';
            echo '<li><a href="login.php" class="login-button">Zaloguj</a></li>';
        }
        ?>
    </ul>
</div>
</body>
</html>