<?php

$host = 'localhost';
$dbname = 'bricobrac_bdd';
$user = 'root';
$password = '';
$driver = 'mysql';

$dsn = "$driver:host=$host;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    // Message de succès (à retirer en production)
    //echo "Connexion à la BDD réussie !";

} catch (\PDOException $e) {
    die("Erreur de connexion à la BDD : " . $e->getMessage());
}
?>