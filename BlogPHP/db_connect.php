<?php

// Funkcja pomocnicza do wykonania zapytania SQL
function executeQuery($query, $params = []) {
    $host = 'localhost'; // Adres hosta bazy danych
    $dbname = 'blog'; // Nazwa bazy danych
    $username = 'root'; // Nazwa użytkownika bazy danych
    $password = ''; // Hasło użytkownika bazy danych

    try {
        // Tworzenie połączenia z bazą danych
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Przygotowanie i wykonanie zapytania SQL
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

        // Zwrócenie wyników zapytania
        return $stmt;
    } catch (PDOException $e) {
        // Obsługa błędu połączenia z bazą danych
        die('Błąd połączenia z bazą danych: ' . $e->getMessage());
    }
}