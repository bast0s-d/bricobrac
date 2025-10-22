<?php


// Assurez-vous que le script est exécuté depuis le terminal
if (php_sapi_name() !== 'cli') {
    die("Ce script ne peut être exécuté qu'en ligne de commande (CLI).\n");
}

echo "--- Création d'un Utilisateur Admin/Standard ---\n";

// --- 1. Configuration de la base de données (À ADAPTER !) ---
$host = 'localhost';
$db = 'bricobrac_bdd'; // Remplacez par le nom de votre BDD
$user = 'root'; // Remplacez par votre utilisateur MySQL
$pass = ''; // Remplacez par votre mot de passe MySQL
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage() . "\n");
}
// --------------------------------------------------------

// --- 2. Récupération des données via le terminal ---

// Demander le Nom d'utilisateur
$username = readline("Entrez le Nom d'utilisateur (username) : ");
if (empty($username)) {
    die("Le nom d'utilisateur ne peut pas être vide.\n");
}

// Demander le Mot de passe
// Remarque : readline() n'est pas idéal pour masquer les caractères, mais c'est la méthode standard en CLI PHP.
$password_input = readline("Entrez le Mot de passe : ");
if (strlen($password_input) < 8) {
    die("Le mot de passe est trop court (min. 8 caractères).\n");
}

// Demander le Rôle
$role_input = readline("Entrez le Rôle (1 pour Admin, 0 pour Standard) : ");
$role = (int)$role_input; // Convertir en entier
if (!in_array($role, [0, 1])) {
    die("Le rôle doit être 0 ou 1.\n");
}

// --- 3. Hachage du mot de passe ---
// Hachage sécurisé OBLIGATOIRE avant l'enregistrement en base
$hashed_password = password_hash($password_input, PASSWORD_DEFAULT);

// --- 4. Insertion dans la base de données ---
try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");

    $stmt->execute([
        'username' => $username,
        'password' => $hashed_password,
        'role' => $role
    ]);

    echo "\n✅ Succès ! L'utilisateur '" . $username . "' (Rôle: " . ($role == 1 ? 'Admin' : 'Standard') . ") a été créé.\n";

} catch (\PDOException $e) {
    // Gérer l'erreur si l'utilisateur existe déjà (contrainte UNIQUE)
    if ($e->getCode() === '23000') {
        die("\n❌ Erreur : Le nom d'utilisateur '" . $username . "' existe déjà.\n");
    }
    die("\n❌ Erreur lors de l'insertion en base : " . $e->getMessage() . "\n");
}



