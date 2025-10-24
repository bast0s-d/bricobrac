<?php
require_once 'src/DBConnection.php';

$reference = $_GET['reference'];

$sql = "SELECT * FROM produits WHERE reference=:reference";


$stmt = $pdo->prepare($sql);
$stmt->bindParam(':reference', $reference);
$stmt->execute();

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

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true && $_SESSION['user_role'] === 1){ ?>

    <br>
    <a href="index.php?page=editproduit&reference=<?= $produit[0]["reference"] ?>">Modifier</a>

    <br>
    <br>
    <form method="POST" action="index.php?page=supprimerproduit&reference=<?= $produit[0]["reference"] ?>" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ? Cette action est irréversible.');">

        <input type="hidden" name="reference" value="<?= htmlspecialchars($produit[0]["reference"]) ?>">

        <button type="submit" >
            supprimer le produit
        </button>
    </form>
    <br>
    <br>
    <form action="index.php?page=gestionpanier&reference=<?= $produit[0]["reference"] ?>" method="POST">
        <input type="hidden" name="action" value="ajouter">
        <input type="hidden" name="reference" value="<?= $produit[0]["reference"] ?>">
        <input type="number" name="quantite" value="1" min="1">
        <button type="submit">Ajouter au panier</button>
    </form>
<?php








    if (isset($_SESSION['flash_message'])) {
        $message = htmlspecialchars($_SESSION['flash_message']);
        $type = $_SESSION['flash_type'] ?? 'info';

        echo '<br><br>' . $message;

        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
    }
}
?>

