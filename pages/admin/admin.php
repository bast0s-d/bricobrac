<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password, role FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification de l'utilisateur et du rôle
    if ($user && password_verify($password, $user['password'])) {
        // L'utilisateur existe, le mot de passe est correct.

        if ($user['role'] === 1) {
            // Initialisation des variables de session
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role']; // Stocker le rôle est clé

            // Redirection vers le tableau de bord admin

            header('Location: index.php?page=dashboard');
            exit();
        } else {
            $error = "Accès non autorisé."; // Rôle non-admin
        }
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>


