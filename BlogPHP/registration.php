<?php

include('require_all.php');
session_start();

// Obsługa rejestracji użytkownika
if (isset($_POST['register'])) {
    // Pobranie danych z formularza
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Walidacja pól formularza (można dodać dodatkowe warunki)

    if ($password !== $confirm_password) {
        $error = "Hasła nie są identyczne";
    } else {
        // Sprawdzenie, czy użytkownik o podanej nazwie już istnieje w bazie danych
        $query = "SELECT * FROM users WHERE username = ?";
        $db = new mysqli('localhost', 'root', '', 'blog');
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $error = "Użytkownik o podanej nazwie już istnieje";
        } else {
            $result->free_result();
            $stmt->close();
            // Dodanie nowego użytkownika do bazy danych
            $query = "INSERT INTO users (username, password) VALUES (?,?)";
            $params = [
                ':username' => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT) // "Hashowanie" hasła przed zapisaniem do bazy danych
            ];

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare($query);
            $stmt->bind_param('ss', $username, $hashed);
            $stmt->execute();

            // Przekierowanie na stronę logowania po udanej rejestracji
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<h1>Rejestracja</h1><br>

<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<div class="container">
    <div class="registration">
<form action="registration.php" method="POST">
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" name="username" id="username">
    <br><br>
    <label for="password">Hasło:</label>
    <input type="password" name="password" id="password">
    <br><br>
    <label for="confirm_password">Potwierdź hasło:</label>
    <input type="password" name="confirm_password" id="confirm_password">
    <br><br><br>
    <input type="submit" id="click" name="register" value="Zarejestruj się">
</form>
<br><br>
<p>Masz już konto? <a href="login.php">Zaloguj się</a></p>

</body>
</html>
