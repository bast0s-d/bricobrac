<?php


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {

    die("Accès refusé. Vous devez être connecté en tant qu'administrateur.");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    die("Méthode de requête invalide. La suppression doit être confirmée via POST.");
}

if (!isset($_POST['reference']) || empty(trim($_POST['reference']))) {
    $_SESSION['flash_message'] = " Erreur : La référence du produit à supprimer est manquante.";
    header('Location: index.php?page=produits');
    exit();
}

$reference_a_supprimer = trim($_POST['reference']);

// --- 3. Requête préparée de Suppression (DELETE) ---
$sql = "DELETE FROM produits WHERE reference = :reference";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['reference' => $reference_a_supprimer]);

    $lignes_affectees = $stmt->rowCount();

    if ($lignes_affectees > 0) {
        $_SESSION['flash_message'] = " Le produit avec la référence **{$reference_a_supprimer}** a été supprimé.";
        $_SESSION['flash_type'] = 'success';
    } else {
        $_SESSION['flash_message'] = "ℹ Aucune suppression effectuée. Le produit n'existe pas.";
        $_SESSION['flash_type'] = 'info';
    }

} catch (PDOException $e) {
    $_SESSION['flash_message'] = " Erreur de base de données lors de la suppression : " . $e->getMessage();
    $_SESSION['flash_type'] = 'error';
}

header('Location: index.php?page=produits');
exit();

