<?php
require_once 'db_connect.php';

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
        $query = "SELECT * FROM users WHERE username = :username";
        $params = [':username' => $username];
        $result = executeQuery($query, $params);
        $existing_user = $result->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            $error = "Użytkownik o podanej nazwie już istnieje";
        } else {
            // Dodanie nowego użytkownika do bazy danych
            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $params = [
                ':username' => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT) // "Hashowanie" hasła przed zapisaniem do bazy danych
            ];
            executeQuery($query, $params);

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
<h1>Rejestracja</h1>

<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<div class="container">
    <div class="registration">
<form action="registration.php" method="POST">
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" name="username" id="username">
    <br>
    <label for="password">Hasło:</label>
    <input type="password" name="password" id="password">
    <br>
    <label for="confirm_password">Potwierdź hasło:</label>
    <input type="password" name="confirm_password" id="confirm_password">
    <br>
    <input type="submit" name="register" value="Zarejestruj się">
</form>

<p>Masz już konto? <a href="login.php">Zaloguj się</a></p>

</body>
</html>
