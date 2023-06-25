<?php

class db_post
{
    private static $host = 'localhost'; // Adres hosta bazy danych
    private static $dbname = 'blog'; // Nazwa bazy danych
    private static $username = 'root'; // Nazwa użytkownika bazy danych
    private static $password = ''; // Hasło użytkownika bazy danych

    public function getPosts() {
        $db = self::connect();
        $query = 'SELECT * FROM posts';
        $result = $db->query($query);
        $posts = [];
        while($post = $result->fetch_assoc()) {
            $posts[] = $post;
        }
        return $posts;
    }

    public function deletePost($id) {
        $db = self::connect();
        $stmt = $db->prepare('DELETE FROM posts WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function updatePost($id, $title, $content, $image) {
        $db = self::connect();
        $stmt = $db->prepare('UPDATE posts SET title = ?, content = ?, image = ? WHERE id = ?');
        $stmt->bind_param('sssi', $title, $content, $image, $id);
        $stmt->execute();
    }

    public function getById($id) {
        $db = self::connect();
        $stmt = $db->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = false;
        if($result->num_rows > 0)
            $post = $result->fetch_assoc();
        return $post;
    }

    private static function connect() {
        return new mysqli(self::$host, self::$username, self::$password, self::$dbname);
    }
}