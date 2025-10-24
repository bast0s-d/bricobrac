<?php
// Vérifiez que la session a été démarrée dans index.php

// Bloc de vérification de l'accès ADMINISTRATEUR
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || $_SESSION['user_role'] !== 1) {
    // Si l'utilisateur n'est pas connecté ou n'a pas le rôle '1' (admin)

    // Option 1: Redirection vers la page de connexion
    header('Location: index.php?page=connection');
    exit();
}
?>

<div>
    vous etes sur le dashboard en mode admin
    <p>Bienvenue Admin ID: <?= htmlspecialchars($_SESSION['user_id']) ?></p>
    <a href="index.php?page=deconnection">Se déconnecter</a>
</div>

<br>

<a href="index.php?page=produits">Modifier un Produit</a>

<br><br>

<a href="index.php?page=editproduit">Ajouter un Produit</a>

<br><br>

<a href="index.php?page=produits">Supprimer un Produit</a>


