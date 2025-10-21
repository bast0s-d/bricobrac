<?php
require_once 'config.php';
require_once 'vendor/autoload.php';

// CORRECTION 1 : Lire 'page' (minuscule) au lieu de 'pages' et enlever le '/' du défaut
$page = $_GET['page'] ?? 'accueil';

// Préparation du nom de fichier propre
$page_safe = basename($page);

// 1. Définition de $page_file
// CONSERVATION de votre logique de chemin : pages/[nom_dossier]/[nom_fichier].php
$page_file = RACINE_PROJET . 'pages/' . $page_safe . '/' . $page_safe . '.php';

// 2. Vérification et définition du contenu
if (file_exists($page_file)) {
    $contenu_page = $page_file;
} else {
    // Si la page spécifique n'est pas trouvée, on passe en 404
    header("HTTP/1.0 404 Not Found");

    // Chemin vers le 404.php (vérifiez si 404 est à la racine de pages/ ou dans pages/404/404.php)
    // Hypothèse : 404.php est directement dans le dossier pages/
    $contenu_page = RACINE_PROJET . 'pages' . DIRECTORY_SEPARATOR . '404.php';
}

// 3. Assembler la page

// HEAD
// Assurez-vous que le chemin est correct : components/head/head.php
include(RACINE_PROJET . 'components/head/head.php');

// CONTENU SPÉCIFIQUE DE LA PAGE
include($contenu_page);

// FOOTER
// Assurez-vous que le chemin est correct : components/foot/foot.php
include(RACINE_PROJET . 'components/foot/foot.php');
?>




