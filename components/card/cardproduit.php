<?php

foreach ($produits as $produit) { ?>

    <div class="Card">
        <div>Nom : <?= $produit["nom"] ?></div>
        <?php
        // calcul du prix avec la promotion
        $prixHtNumerique = str_replace(',', '.', $produit["prixht"]);
        $prixHtFloat = (float)$prixHtNumerique;
        if($produit["promotion"] !== 0){

            $prixPromotion = $prixHtFloat * ($produit["promotion"]/100);
            ?>

            <div><?= $produit["promotion"] ?>% de promotion</div>
            <div>Prix : <span style="text-decoration: line-through;"><?= $prixHtFloat + ( $prixHtFloat * ($produit["prixtva"]/100)) ?> €</span></div>
            <div>Prix : <?= $prixHtFloat - $prixPromotion ?></div>


                <?php
        }else{ ?>
            <div>Prix : <?= $prixHtFloat + ( $prixHtFloat * ($produit["prixtva"]/100)) ?> €</div>
            <?php
        }


        ?>
        <?php
        if ($produit["nouveaute"] === 1) { ?>

            <div class="PopNew">nouveau</div>
            <?php
        } ?>

        <div>Pourcentage de TVA : <?= $produit["prixtva"] ?> %</div>
        <div>Prix HT : <?= $produit["prixht"] ?> €</div>
        <div>réf : <?= $produit["reference"] ?></div>
    </div>

    <?php
}
