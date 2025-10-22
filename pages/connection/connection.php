<div>
    <form action="index.php?page=admin" method="POST">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit">Se connecter</button>

        <?php
        // PHP: Affichage des messages d'erreur si la connexion échoue
        if (isset($error)) {
            echo '<p style="color: red; margin-top: 15px;">' . htmlspecialchars($error) . '</p>';
        }
        ?>
    </form>
</div>