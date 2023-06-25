<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment_id']) && !empty($_POST['post_id'])) {
        // Pobranie danych z formularza
        $post_id = $_POST['post_id'];
        $comment_id = $_POST['comment_id'];
        $db = new mysqli('localhost', 'root', '', 'blog');
        // Zapisanie nowego komentarza do bazy danych
        $query = "DELETE FROM comments WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $comment_id);
        $stmt->execute();
        header("Location: view_post.php?id=$post_id");
    }