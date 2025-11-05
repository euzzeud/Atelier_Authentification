<?php
// Démarre la session
session_start();

if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 1;
} else {
    $_SESSION['count'] += 1; 
}

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: page_admin.php'); // Si l'utilisateur s'est déjà connecté alors il sera automatiquement redirigé vers la page protected.php
    exit();
}

// Gérer le formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification simple des identifiants (à améliorer avec une base de données)
    if ($username === 'admin' && $password === 'secret') {
        // Stocker les informations utilisateur dans la session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Rediriger vers la page protégée
        header('Location: page_admin.php');
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Atelier authentification par Session</h1>
    <h3>La page <a href="page_admin.php">page_admin.php</a> de cet atelier 3 est inaccéssible tant que vous ne vous serez pas connecté avec le login 'admin' et mot de passe 'secret'</h3>
    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
    <br>
    <br>
    <h1>Exercice 1</h1>
    <p><a href="/atelier3/exercice1/index.php">Lien de l'exercice 1</a></p>
    <h1>Exercice 2</h1>
    <p>Vous avez visité cette page d'accueil <?=($_SESSION["count"]); ?> fois.</p>
    <br>
    <a href="../index.php">Retour à l'accueil</a>  
</body>
</html>
