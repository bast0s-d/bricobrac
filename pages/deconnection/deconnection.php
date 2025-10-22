<?php
include("../../config.php");

// Détruit toutes les variables de session
$_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également le cookie de session.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Enfin, détruit la session elle-même
session_destroy();

// Redirige vers la page de connexion
header('Location: index.php?page=accueil');
exit();
?>