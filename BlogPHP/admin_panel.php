<?php
require_once 'db_connect.php';

// Sprawdzenie, czy użytkownik jest zalogowany jako administrator
function isAdministrator()
{
    // Sprawdzenie warunku autoryzacji
    return isset($_SESSION['username']) && $_SESSION['username'] === 'admin';
}

// Jeśli użytkownik nie jest zalogowany jako administrator, przekierowanie na inną stronę lub blokada dostępu
if (!isAdministrator()) {
    header("Location: nopermission.html");
    exit();
}

// Obsługa usuwania wpisu
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Usunięcie wpisu z bazy danych
    $query = "DELETE FROM posts WHERE id = :post_id";
    $params = [':post_id' => $post_id];
    executeQuery($query, $params);

    // Przekierowanie na panel administracyjny po usunięciu wpisu
    header("Location: admin_panel.php");
    exit();
}

// Pobranie wszystkich wpisów z bazy danych
$query = "SELECT * FROM posts ORDER BY date DESC";
$result = executeQuery($query);
$posts = $result->fetchAll(PDO::FETCH_ASSOC);
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

<h2>Wpisy</h2>

<table>
    <tr>
        <th>Tytuł</th>
        <th>Data</th>
        <th>Akcje</th>
    </tr>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo $post['title']; ?></td>
            <td><?php echo $post['date']; ?></td>
            <td>
                <a href="edit_post.php?id=<?php echo $post['id']; ?>">Edytuj</a>
                <a href="delete_post.php?action=delete&id=<?php echo $post['id']; ?>" onclick="return confirm('Czy na pewno chcesz usunąć ten wpis?')">Usuń</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<p><a href="add_post.php">Dodaj nowy wpis</a></p>

</body>
</html>