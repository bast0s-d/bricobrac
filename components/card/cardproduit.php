<?php

foreach ($produits as $produit) { ?>

    <a href='index.php?page=afficheproduit&id=<?= $produit['id'] ?>' class="Card">
        <div>Nom : <?= htmlspecialchars($produit["nom"]) ?></div>
        <?php
        // calcul du prix avec la promotion
        $prixHtNumerique = str_replace(',', '.', $produit["prixht"]);
        $prixHtFloat = (float)$prixHtNumerique;
        if ($produit["promotion"] !== 0) {
            $prixPromotion = $prixHtFloat * ($produit["promotion"] / 100);
            ?>

            <div><?= htmlspecialchars($produit["promotion"]) ?>% de promotion</div>
            <div>Prix : <span style="text-decoration: line-through;"><?= htmlspecialchars($prixHtFloat + ($prixHtFloat * ($produit["prixtva"] / 100))) ?> €</span>
            </div>
            <div>Prix : <?= htmlspecialchars($prixHtFloat - $prixPromotion) ?> €</div>


            <?php
        } else { ?>
            <div>Prix : <?= htmlspecialchars($prixHtFloat + ($prixHtFloat * ($produit["prixtva"] / 100))) ?> €</div>
            <?php
        }


        ?>
        <?php
        if ($produit["nouveaute"] === 1) { ?>
            <div class="PopNew">nouveau</div>
            <?php
        } ?>
    </a>

    <?php
}
