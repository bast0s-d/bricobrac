<?php
require_once 'config.php';

$page = $_GET['page'] ?? 'accueil';

$page_safe = basename($page);

$page_file = RACINE_PROJET . 'pages/' . $page_safe . '/' . $page_safe . '.php';

if (file_exists($page_file)) {
    $contenu_page = $page_file;
} else {
    header("HTTP/1.0 404 Not Found");

    $contenu_page = RACINE_PROJET . 'pages' . DIRECTORY_SEPARATOR . '404.php';
}


include(RACINE_PROJET . 'components/head/head.php');

include(RACINE_PROJET . 'components/sidebar/sidebar.php');

include($contenu_page);

include(RACINE_PROJET . 'components/foot/foot.php');
?>




