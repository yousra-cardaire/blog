<?php

session_start();
require('src/connect.php');

if(!$_SESSION['connect']){
    header('Location: connection.php');
}

if (isset($_POST['envoi'])){
    if(!empty($_POST['titre']) && !empty($_POST['contenu'])){
        $titre = strip_tags($_POST['titre']);
        $contenu = nl2br($_POST['contenu']);
        $user_id = $_SESSION['user_id'];

        $add_article = $bdd->prepare('INSERT INTO billets(titre, contenu, user_id, date_creation) VALUES (?, ?, ?, NOW())');
        $add_article->execute(array($titre, $contenu, $user_id));

        echo "<p class=\"alert-success text-center align-middle\">L'article a bien été ajouté !</p>";
        header('Location: member-page.php?id='.$user_id);

        $add_article->closeCursor();
    }
    else {
        echo 'Veuillez compléter tous les champs !';
    }
}
?>
 



