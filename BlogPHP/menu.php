<div class="menu">
    <ul>
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="add_post.php">Dodaj wpis</a></li>
        <li><a href="admin_panel.php">Panel administracyjny</a></li>
        <li><a href="contact.php">Kontakt</a></li>
        <li><a href="registration.php">Rejestracja</a></li>
        <li><a href="reset_password.php">Reset hasła</a></li>
        <?php
        session_start();
        // Sprawdzenie, czy użytkownik jest już zalogowany
        if (isset($_SESSION['username'])) {
            // Gdy użytkownik zalogowany
            echo '<li><a href="logout.php" class="logout-button">Wyloguj</a></li>';
        } else {
            // Wyświetlenie przycisku logowania
            echo '<li><a href="login.php" class="login-button">Zaloguj</a></li>';
        }
        ?>
    </ul>
</div>
