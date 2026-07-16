<main>
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <article class="article-card">
                    <h2><?= htmlspecialchars($article['titre']) ?></h2>
                    <div class="meta">
                        Publié le : <?= $article['dateCreation'] ?>
                    </div>
                    <div class="content">
                        <?= nl2br(htmlspecialchars($article['contenu'])) ?>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-article">Aucun article disponible dans cette catégorie.</p>
        <?php endif; ?>
    </main>

    <footer class="site-footer">
        <p>Copyright &copy; DGI 2019</p>
    </footer>

</body>
</html>