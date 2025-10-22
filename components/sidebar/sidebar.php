<div class="SideBar">
    <ul>
        <li><a href="index.php?page=accueil">Accueil</a></li>
        <li><a href="index.php?page=produits">Produits</a></li>
        <?php  if (isset($_SESSION['username'])) { ?>

            <li><a href="index.php?page=dashboard">Profile</a></li>
            <li><a href="index.php?page=logout.php">Déconnexion</a></li>
        <?php
        }else{ ?>
            <li><a href="index.php?page=connection">Connexion</a></li>
        <?php
        }
        ?>

    </ul>
</div>