<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est bien en possession d'un cookie valide
// Dans le cas contraire il sera redirigé vers la page d'accueil de connexion
if (!isset($_COOKIE['authToken']) || $_COOKIE['authToken'] !== $_SESSION["token"]) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login réussi</title>
</head>
<body>
    <h1>Bienvenue <?=($_SESSION["username"]); ?> !</h1>
    <p>authToken : <?=($_COOKIE["authToken"]); ?></p>
    <p>Token de session : <?=($_SESSION["token"]); ?></p>
    <p>Déconnexion dans une minute...</p>
</body>
</html>