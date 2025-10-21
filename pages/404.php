<div class="error-404-container" style="text-align: center; padding: 50px;">
    <h1>Erreur 404 : Page Introuvable</h1>
    <h2>Oups ! La ressource que vous recherchez n'existe pas.</h2>

    <p>
        Il semble que cette page ait disparu.
        <br>
        Vous pouvez retourner à la <a href="index.php?page=accueil">page d'accueil</a>.
    </p>

    <?php if (defined('ENV') && ENV === 'development'): ?>
        <p style="margin-top: 30px; color: #aaa;">
            Détails techniques : Le chemin demandé était : **<?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? 'N/A') ?>**
        </p>
    <?php endif; ?>
</div>