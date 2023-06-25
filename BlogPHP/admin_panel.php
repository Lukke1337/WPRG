<?php
include('require_all.php');
session_start();
$db_post = new db_post();
// Sprawdzenie, czy użytkownik jest zalogowany jako administrator
function isAdministrator()
{
    // Sprawdzenie warunku autoryzacji
    return isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin' || $_SESSION['user']->getRole() === 'author';
}

// Jeśli użytkownik nie jest zalogowany jako administrator, przekierowanie na inną stronę lub blokada dostępu
if (!isAdministrator()) {
    header("Location: nopermission.html");
    exit();
}

// Pobranie wszystkich wpisów z bazy danych
$posts = $db_post->getPosts();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel administracyjny</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<br><?php include 'menu.php'; ?><br><br>
<h1>Panel administracyjny</h1><br>


<div class="container">
    <h2>Wpisy</h2>
    <div class="registration">
<table>
    <tr>
        <th>Tytuł</th>
        <th>Data</th>
        <th>Akcje</th>
    </tr>

    <?php foreach ($posts as $post):?>

        <tr>
            <td><?php echo $post['title']; ?></td>
            <td><?php echo $post['published_date']; ?></td>
            <td><br>

                <button id="click"><a href="edit_post.php?id=<?php echo $post['id']; ?>">Edytuj</a><br></button>
                <button id="click"><a href="delete_post.php?action=delete&id=<?php echo $post['id']; ?>" onclick="return confirm('Czy na pewno chcesz usunąć ten wpis?')">Usuń</a></button>
                <br><br><br>

            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br><br>
<p><button id="click"><a href="add_post.php">Dodaj nowy wpis</a></button></p>
    </div>
</div>

</body>
</html>