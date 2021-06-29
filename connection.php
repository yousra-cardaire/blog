<?php
session_start();

require('src/connect.php');
//connexion
    if (!empty($_POST['email']) && !empty($_POST['user_password']))
    {
        //variables
        $email    = $_POST['email'];
        $password = $_POST['user_password'];
        

        $req = $bdd->prepare("SELECT * FROM users WHERE email = ?");
        $req->execute(array($email));

        while ($user = $req->fetch())
        {
            $password_verify = password_verify($password, $user['user_password']);

            if ($password_verify == 1){
                $_SESSION ['connect'] = 1;
                $_SESSION ['pseudo']  = $user['pseudo'];
                $_SESSION['user_id'] = $user['user_id'];
                if(isset($_POST['auto_connect'])){
                    setcookie('log', $user['user_key'], time()+60*60*24*365, '/', null, false, true);
                }
                header('Location: member-page.php?id='.$user['user_id']);
                exit();
            } 
       
        }
                header('Location: connection.php?error=1');
                exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Connexion</title>
        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <!-- Custom styles for this template -->
        <link href="css/clean-blog.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mx-auto">
            <?php 
            if(!isset($_SESSION['connect']))
            { 
            ?>
            <a href="index.php" class="justify-start">&larr; retour</a>
            <h1 class="text-center mt-3">Connexion</h1>
            <p class="text-center mt-1 mb-0">Bienvenue sur mon site.</p>
            <p class="text-center mt-1 mb-0">C'est votre première visite ? <a href="index.php"> inscrivez-vous ! </a></p>
        </div>
        <?php
            if(isset($_GET['error'])){
                echo '<p class="bg-danger mx-auto text-center">Nous ne pouvons pas vous authentifier.</p>';
            }
        ?>
        <form action="connection.php" class="container mx-auto" method="POST"> 
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre e-mail" required>
            </div>
            <div class="mb-3">
                <label for="user_password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Entrez votre mot-de-passe" required>
            </div>
            <p><label for="auto_connect"><input type="checkbox" name="auto_connect" id="auto_connect" class="mx-3"checked>Se connecter automatiquement</label></p>
            <input type="submit" value="Se connecter" class="btn btn-primary">
        </form>
    <?php
        } 
    ?>
    </body>
</html>