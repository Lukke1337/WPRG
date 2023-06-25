<?php
include('require_all.php');
session_start();


// Obsługa resetowania hasła
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_POST['password'], $_POST['password_rep']))
        exit('tu');

    $password = $_POST['password'];
    $passwordRep = $_POST['password_rep'];
    $userId = $_SESSION['user']->getId();
    echo $password;
    echo $passwordRep;
    if($password !== $passwordRep)
        exit('tu2');


    $db = new mysqli('localhost', 'root', '', 'blog');
    $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bind_param('si', $hashed, $userId);
    $stmt->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Zmiana hasła</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<h1>Resetowanie hasła</h1><br>

<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<div class="container">
    <div class="registration">
<form action="reset_password.php" method="POST">
    <label for="password">Nowe hasło:</label>
    <input type="password" name="password" id="password" required><br><br>
    <label for="password-rep">Powtórz nowe hasło:</label>
    <input type="password" name="password_rep" id="password-rep" required>
    <br><br>
    <input id="click" type="submit" value="Zresetuj hasło">
</form>
    </div>
</div>

</body>
</html>
