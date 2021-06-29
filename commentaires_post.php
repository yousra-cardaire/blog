<?php 
require_once 'head.php';
include_once 'src/connect.php';

if(!empty($_POST['auteur']) && !empty($_POST['commentaire']))
{
$req = $bdd->prepare('INSERT INTO commentaires (id_billet,auteur,commentaire,date_commentaire) VALUES( :id_billet,:auteur,:commentaire,NOW())');
$req->execute(array(
    'id_billet'=>htmlspecialchars($_POST['id_billet']),
    'auteur'=>htmlspecialchars($_POST['auteur']),
    'commentaire'=>htmlspecialchars($_POST['commentaire']),
));

$req->closeCursor();
}
else{
    echo 'Merci de remplir tous les champs';
}

// Redirection du visiteur vers la page des commentaires
header('Location: commentaires.php?billet='.intval($_POST['id_billet']));

?>

