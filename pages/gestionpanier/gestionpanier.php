<?php

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'ajouter') {
    $reference = (int)$_POST['reference'];
    $quantite = (int)$_POST['quantite'];
    
    // Vérifier si le produit est déjà dans le panier
    if (array_key_exists($reference, $_SESSION['panier'])) {
        $_SESSION['panier'][$reference] += $quantite;
    } else {
        $_SESSION['panier'][$reference] = $quantite;
    }

    header('Location: index.php?page=panier');
    exit;
}

// Suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['action']) && $_POST['action'] === 'supprimer') {

    // 1. Lire la référence (nommée 'reference' dans le formulaire) depuis $_POST
    if (isset($_POST['reference'])) {

        // Assurez-vous que la référence est bien un entier
        $reference = (int)$_POST['reference'];

        // 2. Vérifiez si l'article existe dans le panier de session
        if (array_key_exists($reference, $_SESSION['panier'])) {

            // 3. Supprimez l'article spécifique du panier
            unset($_SESSION['panier'][$reference]);
        }
    }

    // 4. Redirigez l'utilisateur vers la page du panier
    header('Location: index.php?page=panier');
    exit;
}

//retirer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'retirer_un') {

    if (isset($_POST['reference'])) {
        $reference = (int)$_POST['reference'];

        // 1. Vérifiez si le produit existe dans le panier
        if (array_key_exists($reference, $_SESSION['panier'])) {

            // 2. Décrémentez la quantité
            $_SESSION['panier'][$reference]--;

            // 3. Si la quantité tombe à zéro ou moins, supprimez l'article
            if ($_SESSION['panier'][$reference] <= 0) {
                unset($_SESSION['panier'][$reference]);
            }
        }
    }

    header('Location: index.php?page=panier');
    exit;
}

//Ajouter
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'ajouter_un') {

    if (isset($_POST['reference'])) {
        $reference = (int)$_POST['reference'];

        // 1. Vérifiez si le produit existe dans le panier
        if (array_key_exists($reference, $_SESSION['panier'])) {

            // 2. Incrémenter la quantité
            $_SESSION['panier'][$reference]++;

        }
    }

    header('Location: index.php?page=panier');
    exit;
}

?>



