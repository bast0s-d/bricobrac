<?php

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}
?>
<h2>Votre Panier</h2>
<?php
if (empty($_SESSION['panier'])) {
    ?>
    <p>Votre Panier est vide</p>
    <a href="index.php?page=produits">Consulter la liste des produits</a>
    <?php
} else {
    $total_general = 0;
    echo "<table>";
    echo "<tr><th>Reference</th><th>Quantité</th><th>Actions</th></tr>";

    foreach ($_SESSION['panier'] as $reference => $quantite) {
        $nom_produit = "Produit n°" . $reference; // Exemple simple
        $prix_unitaire = 10.00; // Exemple simple
        $sous_total = $quantite * $prix_unitaire;
        $total_general += $sous_total;

        echo "<tr>";
        echo "<td>" . htmlspecialchars($nom_produit) . "</td>";
        echo "<td>" . htmlspecialchars($quantite) . "</td>";
        echo "<td>";
        ?>
        <form action='index.php?page=gestionpanier' method='POST' style='display:inline;'>
            <input type='hidden' name='action' value='supprimer'>
            <input type='hidden' name='reference' value='<?= $reference ?>'> <button type='submit' title='Supprimer cet article'>Supprimer</button>
        </form>
        <?php if ($quantite > 1) { ?>
        <form action='index.php?page=gestionpanier' method='POST' style='display:inline;'>
            <input type='hidden' name='action' value='retirer_un'>
            <input type='hidden' name='reference' value='<?= $reference ?>'>
            <button type='submit' title='Retirer une unité'>Retirer une unité</button>
        </form>
            <form action='index.php?page=gestionpanier' method='POST' style='display:inline;'>
                <input type='hidden' name='action' value='ajouter_un'>
                <input type='hidden' name='reference' value='<?= $reference ?>'>
                <button type='submit' title='Ajouter une unité'>Ajouter une unité</button>
            </form>
            <?php }

        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<p><strong>Total général : " . number_format($total_general, 2) . " €</strong></p>";
}
