<?php
// 1. Connexion à la base de données mglsi_news avec l'utilisateur mglsi_user
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
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// 2. Récupération des catégories pour le menu de navigation
$stmtCat = $pdo->query('SELECT id, libelle FROM Categorie');
$categories = $stmtCat->fetchAll();

// 3. Récupération des articles (Optionnel : filtrer par catégorie si l'ID est dans l'URL)
$categorieId = isset($_GET['categorie']) ? intval($_GET['categorie']) : null;

if ($categorieId) {
    // Si l'utilisateur a cliqué sur une catégorie, on affiche uniquement ses articles
    $stmtArt = $pdo->prepare('SELECT titre, contenu, dateCreation FROM Article WHERE categorie = ?');
    $stmtArt->execute([$categorieId]);
} else {
    // Par défaut (Accueil), on affiche tous les articles
    $stmtArt = $pdo->query('SELECT titre, contenu, dateCreation FROM Article ORDER BY dateCreation DESC');
}
$articles = $stmtArt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités Polytechniciennes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- En-tête du site -->
    <header>
        <h1>ACTUALITÉS POLYTECHNICIENNES</h1>
    </header>

    <!-- Barre de navigation dynamique -->
    <nav>
        <ul>
            <!-- Lien Accueil -->
            <li>
                <a href="index.php" class="<?= empty($categorieId) ? 'active' : '' ?>">Accueil</a>
            </li>
            
            <!-- Boucle PHP pour générer les onglets du menu depuis la BD -->
            <?php foreach ($categories as $cat): ?>
                <li>
                    <a href="index.php?categorie=<?= $cat['id'] ?>" 
                       class="<?= $categorieId == $cat['id'] ? 'active' : '' ?>">
                        <?= htmlspecialchars($cat['libelle']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <!-- Conteneur principal pour les articles -->
    <main class="container">
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <article class="news-item">
                    <h2><?= htmlspecialchars($article['titre']) ?></h2>
                    <p class="date">Publié le : <?= $article['dateCreation'] ?></p>
                    <div class="content">
                        <?= htmlspecialchars($article['contenu']) ?>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-article">Aucun article disponible dans cette catégorie.</p>
        <?php endif; ?>
    </main>

    <!-- Pied de page -->
    <footer>
        <p>Copyright &copy; DGI 2019</p>
    </footer>

</body>
</html>
