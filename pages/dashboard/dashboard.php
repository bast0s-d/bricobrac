<?php
// Vérifiez que la session a été démarrée dans index.php

// Bloc de vérification de l'accès ADMINISTRATEUR
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['user_role'] !== 1) {
    // Si l'utilisateur n'est pas connecté ou n'a pas le rôle '1' (admin)

    // Option 1: Redirection vers la page de connexion
    header('Location: index.php?page=login');
    exit();

    // --- OU ---
    // Option 2 (plus propre dans un système de routing): Afficher une erreur
    // die("Accès refusé. Veuillez vous connecter en tant qu'administrateur.");
}

// -----------------------------------------------------
// SEUL LE CODE APRÈS CE BLOC est exécuté par un ADMIN connecté
// -----------------------------------------------------
?>

<div>
    vous etes sur le dashboard en mode admin
    <p>Bienvenue Admin ID: <?= htmlspecialchars($_SESSION['user_id']) ?></p>
    <a href="index.php?page=deconnection">Se déconnecter</a>
</div>