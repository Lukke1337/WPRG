<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Logowanie</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <?php include 'menu.php'; ?><br>
    <h1>Zaloguj się na najlepszy blog!</h1><br>

</header>

<?php
//session_start();
    // Utworzenie połączenia z bazą danych
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

    $connection = new mysqli($host, $username, $password, $dbname);

    // Sprawdzenie połączenia
    if ($connection->connect_error) {
        die("Błąd połączenia z bazą danych: " . $connection->connect_error);
    }
// Sprawdzanie, czy użytkownik jest już zalogowany, jeśli tak, przekierowanie go do strony głównej
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Obsługa logowania
if (isset($_POST['login'])) {
    // Pobranie danych z formularza logowania
    $username = $_POST['username'];
    $password = $_POST['password'];

//            TUTAJ ZMIENIĆ SELECT DO BAZY
    $query = "SELECT * FROM users WHERE username = ?";
//    " AND password = ?";

    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $pashash = $result->fetch_assoc();
    $role = $pashash;
    if(password_verify($password, $pashash["password"])) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        header("Location: index.php");
    } else {
        // Logowanie nieudane
        $error = "Nieprawidłowy login lub hasło.";
    }


    // Sprawdzenie poprawności danych logowania i czy istnieje w bazie danych

//    if ($result->num_rows === 1) {
//        // Logowanie udane
//        $_SESSION['username'] = $username;
//        $_SESSION['role'] = "admin";
//        header("Location: index.php");
//        exit();
//    } else {
//        // Logowanie nieudane
//        $error = "Nieprawidłowy login lub hasło.";
//    }
}
?>



<main>
    <h2>Logowanie</h2>
    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>
    <form method="POST" action="login.php">
        <label for="username">Login:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="login" value="Zaloguj">
    </form>
</main>

<footer>
    <p>Stronę wykonał Łukasz Kelsz</p>
</footer>
</body>
</html>
