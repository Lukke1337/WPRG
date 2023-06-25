<?php

include('require_all.php');
session_start();


// Obsługa wysyłania wiadomości kontaktowej
if (isset($_POST['send'])) {
    // Pobranie danych z formularza
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Zapisanie wiadomości kontaktowej do bazy danych

    $db = new mysqli('localhost', 'root', '', 'blog');
    // Zapisanie nowego komentarza do bazy danych
    $query = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $name, $email, $message);
    $stmt->execute();


    // Przekierowanie na stronę potwierdzenia wysłania wiadomości
    header("Location: sent.html");
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

<div class="container">
<form action="contact.php" method="POST">
    <label for="name">Imię:</label>
    <input type="text" name="name" id="name">
    <br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email">
    <br><br>
    <label for="message">Wiadomość:</label>
    <textarea name="message" id="message" rows="4" cols="50"></textarea>
    <br><br>
    <input id="click" type="submit" name="send" value="Wyślij wiadomość">
</form>
</div>

</body>
</html>
