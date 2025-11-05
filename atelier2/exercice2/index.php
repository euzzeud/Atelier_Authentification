<?php
// Démarrer une session utilisateur qui sera en mesure de pouvoir gérer les Cookies
session_start();

// Vérifier si l'utilisateur est déjà en possession d'un cookie valide (cookie authToken ayant le contenu 12345)
// Si l'utilisateur possède déjà ce cookie, il sera redirigé automatiquement vers la page home.php
// Dans le cas contraire il devra s'identifier.

if (isset($_COOKIE['authToken']) && $_COOKIE['authToken'] === $_SESSION["token"]) {
    header('Location: page.php');
    exit();
}

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification simple du username et de son password.
    // Si ok alors on initialise le cookie sur le poste de l'utilisateur 
    if ($username === 'admin' && $password === 'secret') {
        $_SESSION["token"] = bin2hex(random_bytes(16));
        setcookie('authToken', $_SESSION["token"], time() + 60, '/', '', false, true);
        header('Location: page.php'); // L'utilisateur est dirigé vers la page home.php
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <h2>Exercice 2</h2>
    <h3>Dans notre exemple, tous les utilisateur ont le même jeton stocké dans le Cookie authToken (la valeur 12345). Générer dynamiquement un jeton unique pour chaque utilisateur. Vous pouvez la fonction bin2hex(random_bytes(16)) pour générer un jeton aléatoire au lieu de notre valeur statique 12345.</h3>

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
    <a href="../index.html">Retour à l'accueil</a> 

</body>
</html>