<?php

if(isset($_GET['reference'])){
    $title = 'Modifier';
    $action = 'index.php?page=modifierproduit&reference='.$_GET['reference'];
    $ref_recherchee = $_GET['reference'];

    $sql = "SELECT id, nom, prixht, prixtva, promotion, nouveaute 
        FROM produits 
        WHERE reference = :reference";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute(['reference' => $ref_recherchee]);

        // --- 3. Récupération des données ---
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produit) {
            $nomproduit = htmlspecialchars($produit['nom']);
            $prixhtproduit= (float) $produit['prixht'];
            $prixtvaproduit= $produit['prixtva'];
            $promotionproduit= htmlspecialchars($produit['promotion']);
            $nouveauteproduit= htmlspecialchars($produit['nouveaute']);


        } else {
            echo " Aucun produit trouvé pour la référence **{$ref_recherchee}**.\n";
        }

    } catch (PDOException $e) {
        echo " Erreur de base de données : " . $e->getMessage() . "\n";
    }


}else{
    $title = 'Ajouter';
    $action = 'index.php?page=ajouterproduit';
}


?>
<h2><?=$title ?> un Produit</h2>

<form method="POST" action="<?= $action ?>">
    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="<?php if(isset($nomproduit)) {echo $nomproduit;}?>" required><br><br>

    <label for="reference">Référence :</label>
    <input type="text" name="reference" value="<?php if(isset($ref_recherchee)) {echo $ref_recherchee;}?>" required><br><br>

    <label for="prixht">Prix HT (€):</label>
    <input type="number" step="0.01" name="prixht" value="<?php if(isset($prixhtproduit)) {echo $prixhtproduit;}?>" required><br><br>

    <label for="prixtva">TVA (%):</label>
    <input type="number" step="0.01" name="prixtva" value="<?php if(isset($prixtvaproduit)) {echo $prixtvaproduit;}?>" required><br><br>

    <label for="promotion">Promotion (%):</label>
    <input type="number" name="promotion" value="<?php if(isset($promotionproduit)) {echo $promotionproduit;}?>" ><br><br>

    <label for="nouveaute">Nouveauté :</label>
    <input type="checkbox" name="nouveaute" value="<?php if(isset($nouveauteproduit)) {echo $nouveauteproduit;}?>" ><br><br>
    <button type="submit">Enregistrer les Modifications</button>
</form>