<?php
require_once 'db_connect.php';

// Obsługa wysyłania wiadomości kontaktowej
if (isset($_POST['send_message'])) {
    // Pobranie danych z formularza
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Zapisanie wiadomości kontaktowej do bazy danych
    $query = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
    $params = [
        ':name' => $name,
        ':email' => $email,
        ':message' => $message
    ];
    executeQuery($query, $params);

    // Przekierowanie na stronę potwierdzenia wysłania wiadomości
    header("Location: contact.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kontakt</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<h1>Skontaktuj się z autorem bloga</h1><br>

<form action="contact.php" method="POST">
    <label for="name">Imię:</label>
    <input type="text" name="name" id="name">
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email">
    <br>
    <label for="message">Wiadomość:</label>
    <textarea name="message" id="message" rows="4" cols="50"></textarea>
    <br>
    <input type="submit" name="send_message" value="Wyślij wiadomość">
</form>

</body>
</html>
