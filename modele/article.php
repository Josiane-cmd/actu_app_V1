<?php
// Récupération des articles (filtrés par catégorie ou non)
function getArticles($pdo, $categorieId = null) {
    if ($categorieId) {
        $stmtArt = $pdo->prepare('SELECT titre, contenu, dateCreation FROM Article WHERE categorie = ?');
        $stmtArt->execute([$categorieId]);
    } else {
        $stmtArt = $pdo->query('SELECT titre, contenu, dateCreation FROM Article ORDER BY dateCreation DESC');
    }
    return $stmtArt->fetchAll();
}