<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- 1. Récupération et préparation des données ---
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
        $message = " Erreur de validation: " . $verification['message'];
        header('location: index.php?page=afficheproduit&reference='.urlencode(trim($_POST['reference'])));
        exit();
    }else {

        $sql = "INSERT INTO produits (nom, reference, prixht, prixtva, promotion, nouveaute) 
                VALUES (:nom, :reference, :prixht, :prixtva, :promotion, :nouveaute)";

        try {
            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                'nom' => trim($_POST['nom']),
                'prixht' => trim($_POST['prixht']),
                'prixtva' => trim($_POST['prixtva']),
                'promotion' => trim($_POST['promotion']),
                'nouveaute' => trim($_POST['nouveaute']),
                'reference' => trim($_POST['reference'])
            ]);

            header('Location: index.php?page=afficheproduit&reference=' . urlencode(trim($_POST['reference'])));
            exit();

        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $message = " Erreur : La référence **{$reference}** existe déjà. Veuillez en choisir une autre.";
            } else {
                $message = " Erreur de base de données lors de l'ajout : " . $e->getMessage();
            }
        }
    }
}
?>
