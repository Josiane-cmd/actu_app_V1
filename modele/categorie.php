<?php
// Connexion à la base de données
function dbConnect() {
    $host = 'localhost';
    $db   = 'mglsi_news';
    $user = 'mglsi_user';
    $pass = 'passer';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

// Récupération des catégories
function getCategories($pdo) {
    $stmtCat = $pdo->query('SELECT id, libelle FROM Categorie');
    return $stmtCat->fetchAll();
}