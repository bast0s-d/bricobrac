<?php

require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//verifier si les champs sont bien rentrés avec les bonnes informations sinon afficher un message d'erreur

    $message = '';

    $verification = checkfield($_POST,
        [
            'nom' => ['obligatoire'],
            'prixht' => ['obligatoire', 'numerique'],
            'reference' => ['obligatoire','numerique'],
            'prixtva' => ['obligatoire', 'numerique'],
            'promotion' => ['numerique'],
        ]);

    if($verification['succes'] === false){
        $_SESSION['flash_message'] = " Erreur de validation: " . $verification['message'];
        $_SESSION['flash_type'] = 'error';
        header('location: index.php?page=afficheproduit&reference='.urlencode(trim($_POST['reference'])));
        exit();
    }else {
        // --- 2. Requête préparée pour la mise à jour (UPDATE) ---
        $sql = "UPDATE produits SET
            nom = :nom,
            prixht = :prixht,
            prixtva = :prixtva,
            promotion = :promotion,
            nouveaute = :nouveaute
            WHERE reference = :reference";

        try {
            $stmt = $pdo->prepare($sql);

// Exécution de la requête en liant les valeurs aux paramètres nommés
            $stmt->execute([
                'nom' => trim($_POST['nom']),
                'prixht' => trim($_POST['prixht']),
                'prixtva' => trim($_POST['prixtva']),
                'promotion' => trim($_POST['promotion']),
                'nouveaute' => trim($_POST['nouveaute']),
                'reference' => trim($_POST['reference'])
            ]);

// Vérifier si une ligne a été affectée (modifiée)
            if ($stmt->rowCount() > 0) {
                $message = " Le produit a été mis à jour avec succès !";
            } else {
                $message = "ℹ Aucune modification n'a été effectuée (les données étaient identiques ou la référence n'existe pas).";
            }

            header('Location: index.php?page=afficheproduit&reference=' . urlencode(trim($_POST['reference'])));
            exit();

        } catch (PDOException $e) {
            $message = " Erreur de base de données lors de la mise à jour : " . $e->getMessage();
        }

    }
}




?>