<?php
include('require_all.php');
session_start();

$db_post = new db_post();

// Sprawdź, czy przekazano identyfikator wpisu do edycji
if (!isset($_GET['id'])) {
    echo 'Nie przekazano identyfikatora wpisu do edycji.';
    return;
}
$postId = $_GET['id'];
// Pobranie informacji o wpisie

$post = $db_post->getById($postId);

$image_path = $post['image'];

// TUTAJ JEST PROBLEM \/\/\/\/\/\/\/\/\/\/\/\/\/
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postId'],$_POST['title'],$_POST['content'], $_POST['image'])) {
    echo 'jest';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        echo 'jestem';
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "images/" . $image_name;
        move_uploaded_file($image_tmp, $image_path);
    }
    // TUTAJ JEST PROBLEM /\/\/\/\/\/\/\/\/\/\/\/\/\

    //Update posta na stronie (dodanie do bazy)
    $db_post->updatePost($_POST['postId'], $_POST['title'], $_POST['content'], $image_path);
    header('Location: index.php');
}

    if (!$post) {
        echo 'Wpis o podanym identyfikatorze nie został znaleziony.';
    }
    // Sprawdzenie, czy wpis istnieje i czy użytkownik ma do niego dostęp
    if ($post['author_id'] !== $_SESSION['user']->getId() && $_SESSION['user']->getRole() !== 'admin') {
        header("Location: nopermission.php");
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta initial-scale=1.0">
    <title>Edycja wpisu</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<br><?php include 'menu.php'; ?><br><br>

    <h1>Edycja wpisu</h1>
    <div class="container">
        <div class="registration">
    <div class="content">
        <br>
        <h2>Formularz edycji wpisu</h2>
        <br><br>
        <form style="margin: 0px auto" method="POST" action="edit_post.php?id=<?php echo $postId ?>">
                <input type="hidden" name="postId" value="<?php echo $postId ?>">
                <label for="title">Tytuł:</label><br>
                <input size="40" type="text" id="title" name="title" value="<?php echo $post['title'] ?>"><br><br>
                <label for="content">Treść:</label><br>
                <textarea style="margin: 0px auto;: left" rows="40" cols="40" content" name="content"><?php echo $post['content'] ?></textarea>
                <br><br>
                <label for="image">Obrazek:</label>
                <input type="file" id="image" name="image">
                <br><br>
                <input id="click" type="submit" value="Zapisz zmiany">
            </form>
    </div>
</div>
</body>
</html>
