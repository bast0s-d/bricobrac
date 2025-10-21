<?php
require_once 'src/DBConnection.php';


$sql = "SELECT * FROM produits";

$stmt = $pdo->prepare($sql);
$stmt->execute();

// PDO::FETCH_ASSOC garantit que les clés du tableau sont les noms des colonnes (id, nom, reference, etc.)
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

dump($produits);
?>

<div class="Produits container">

</div>