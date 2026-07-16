<?php
// 1. Charger les modèles (les chemins sont directs maintenant !)
require_once 'modele/categorie.php';
require_once 'modele/article.php';

// 2. Initialiser la connexion
$pdo = dbConnect();

// 3. Récupérer le choix de l'utilisateur
$categorieId = isset($_GET['categorie']) ? intval($_GET['categorie']) : null;

// 4. Demander les données aux modèles
$categories = getCategories($pdo);
$articles = getArticles($pdo, $categorieId);

// 5. Assembler et afficher les vues
require_once 'vue/categorieVue.php'; 
require_once 'vue/articleVue.php';