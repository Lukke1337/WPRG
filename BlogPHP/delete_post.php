<?php
include('require_all.php');
session_start();


// Sprawdzenie, czy użytkownik jest zalogowany i ma odpowiednie uprawnienia
if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() === 'user') {
    header("Location: nopermission.php");
}

// Sprawdzenie, czy został przekazany identyfikator wpisu
if (!isset($_GET['id'])) {
    header("Location: index.php");
}

// Pobranie identyfikatora wpisu z parametru GET
$post_id = $_GET['id'];

$db_post = new db_post();

// Pobranie informacji o wpisie z bazy danych
$post = $db_post->getById($post_id);

// Sprawdzenie, czy wpis istnieje i czy użytkownik ma do niego dostęp
if (!$post || ($post['author_id'] !== $_SESSION['user']->getId() && $_SESSION['user']->getRole() !== 'admin')) {
    header("Location: nopermission.php");
}

    // Usunięcie wpisu z bazy danych
    $db_post->deletePost($post['id']);

    // Przekierowanie na stronę główną po usunięciu wpisu
    header("Location: index.php");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Usuń wpis</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <br><?php include 'menu.php'; ?><br><br>
</header>
<!---->
<!--<main>-->
<!--    <h2>Usuń wpis</h2>-->
<!--    <p>Czy na pewno chcesz usunąć ten wpis?</p>-->
<!--    <h3>--><?php //echo $post['title']; ?><!--</h3>-->
<!--    <p>--><?php //echo $post['content']; ?><!--</p>-->
<!--    <form method="POST" action="delete_post.php">-->
<!--        <input type="hidden" name="post_id" value="--><?php //echo $post_id; ?><!--">-->
<!--        <input type="submit" name="delete_post" value="Usuń">-->
<!--    </form>-->
<!--</main>-->

<footer>
    <p>Stronę wykonał Łukasz Kelsz</p>
</footer>
</body>
</html>
