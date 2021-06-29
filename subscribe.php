<?php 
require_once('head.php');
require_once('src/connect.php');
//inscription
if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['user_password']) && !empty($_POST['password_confirm'])){

// variables
$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$password = $_POST['user_password'];
$password_confirm = $_POST['password_confirm'];

// test si password = password_confirm
if($password != $password_confirm){
    header('Location: subscribe.php?error=1&pass=1');
    exit();
}
    

// test si email utilisé
$req = $bdd->prepare("SELECT count(*) as numberEmail FROM users WHERE email = ?");
$req->execute(array($email));
while($email_verification = $req->fetch())
{
    if($email_verification['numberEmail'] != 0){
        header('Location: susbscribe.php?error=1&email=1');
        exit();
    }
}
    

// HASH
$user_key = sha1($email).time(); // attention la fonction sha1 est considérée comme faible pour hashage de MDP
$user_key = sha1($email).time().time();

// cryptage du password
$password = password_hash($password, PASSWORD_DEFAULT);

// envoi de la requête 
$req = $bdd->prepare("INSERT INTO users(pseudo, email, user_password, user_key) VALUES (?, ?, ?, ?)");
$req->execute(array($pseudo, $email, $password, $user_key));
print_r($req->errorInfo());
}

?>

<div class="container mx-auto">
    <div class="d-flex justify-content-between">
        <a href="index.php">&larr; retour</a>
        <a href="connection.php">connexion &rarr;</a>
    </div>

            <p class="text-center mt-5 mb-0" id="inscription">Inscrivez-vous pour poster des articles !</p>
            <p class="text-center mt-1 mb-0">Déjà inscrit(e) ? <a href="connection.php">Connectez-vous</a> </p>

        <?php
            if(isset($_GET['error'])){

                if(isset($_GET['pass'])){
                    echo '<p class= "bg-danger">Les mots de passe ne sont pas identiques.</p>';
                    } else if(isset($_GET['email'])){
                        echo '<p class= "bg-danger">Cet e-mail existe déjà !</p>';
                    }
             } else if (isset($_GET['success'])) {
                echo '<p id="success" class ="alert-success text-center align-middle"> Votre inscription a bien été prise en compte.</p>';
            }
        ?>
        </div>

        <form action="subscribe.php" class="container mx-auto" method="POST"> 
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez un pseudo"  required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre e-mail" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Entrez votre mot-de-passe" required>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirmez votre mot de passe</label>
                <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot-de-passe" required>
            </div>
            <input class="btn btn-primary" type="submit" value="S'inscrire">
        </form>