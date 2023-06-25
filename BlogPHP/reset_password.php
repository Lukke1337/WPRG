<?php
require_once 'db_connect.php';

// Obsługa resetowania hasła
if (isset($_POST['reset_password'])) {
    // Pobranie danych z formularza
    $username = $_POST['username'];

    // Sprawdzenie, czy użytkownik o podanej nazwie istnieje w bazie danych
    $query = "SELECT * FROM users WHERE username = :username";
    $params = [':username' => $username];
    $result = executeQuery($query, $params);
    $user = $result->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $error = "Użytkownik o podanej nazwie nie istnieje";
    } else {
        // Wygenerowanie nowego hasła
        $new_password = generateRandomPassword();

        // Zapisanie nowego hasła do bazy danych
        $query = "UPDATE users SET password = :new_password WHERE username = :username";
        $params = [
            ':new_password' => password_hash($new_password, PASSWORD_DEFAULT),
            ':username' => $username
        ];
        executeQuery($query, $params);

        // Przekierowanie na stronę potwierdzenia zresetowania hasła
        header("Location: reset_password_confirm.php");
        exit();
    }
}

// Funkcja generująca losowe hasło
function generateRandomPassword($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $password .= $characters[$index];
    }
    return $password;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resetowanie hasła</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<h1>Resetowanie hasła</h1>

<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<form action="reset_password.php" method="POST">
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" name="username" id="username">
    <br>
    <input type="submit" name="reset_password" value="Zresetuj hasło">
</form>

</body>
</html>
