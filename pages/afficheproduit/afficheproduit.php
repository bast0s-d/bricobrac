<?php
require_once 'src/DBConnection.php';

$id = $_GET['id'];

$sql = "SELECT * FROM produits WHERE id=:id";


$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

// PDO::FETCH_ASSOC garantit que les clés du tableau sont les noms des colonnes (id, nom, reference, etc.)
$produit = $stmt->fetchAll(PDO::FETCH_ASSOC);


if(empty($produit)){
    echo 'produit nom reconnu';
}else{



?>
<div class="AfficheProduit container">
    <div>Nom : <?= htmlspecialchars($produit[0]["nom"]) ?></div>
    <?php
    // calcul du prix avec la promotion
    $prixHtNumerique = str_replace(',', '.', $produit[0]["prixht"]);
    $prixHtFloat = (float)$prixHtNumerique;
    if($produit[0]["promotion"] !== 0){

        $prixPromotion = $prixHtFloat * ($produit[0]["promotion"]/100);
        ?>

        <div><?= htmlspecialchars($produit[0]["promotion"]) ?>% de promotion</div>
        <div>Prix : <span style="text-decoration: line-through;"><?= $prixHtFloat + ( $prixHtFloat * ($produit[0]["prixtva"]/100)) ?> €</span></div>
        <div>Prix : <?= htmlspecialchars($prixHtFloat - $prixPromotion) ?></div>


        <?php
    }else{ ?>
        <div>Prix : <?= htmlspecialchars($prixHtFloat + ( $prixHtFloat * ($produit[0]["prixtva"]/100))) ?> €</div>
        <?php
    }


    ?>
    <?php
    if ($produit[0]["nouveaute"] === 1) { ?>

        <div class="PopNew">nouveau</div>
        <?php
    } ?>

    <div>Pourcentage de TVA : <?= htmlspecialchars($produit[0]["prixtva"]) ?> %</div>
    <div>Prix HT : <?= htmlspecialchars($produit[0]["prixht"]) ?> €</div>
    <div>réf : <?= htmlspecialchars($produit[0]["reference"]) ?></div>
</div>

<?php }