<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités Polytechniciennes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="site-header">
        <h1>ACTUALITÉS POLYTECHNICIENNES</h1>
    </header>

    <nav class="site-nav">
        <!-- Lien Accueil -->
        <a href="index.php" class="<?= empty($categorieId) ? 'active' : '' ?>">Accueil</a>
        
        <!-- Boucle PHP pour générer les onglets du menu -->
        <?php foreach ($categories as $cat): ?>
            <a href="index.php?categorie=<?= $cat['id'] ?>" 
               class="<?= $categorieId == $cat['id'] ? 'active' : '' ?>">
                <?= htmlspecialchars($cat['libelle']) ?>
            </a>
        <?php endforeach; ?>
    </nav>