<?php
require_once 'head.php';
include_once 'src/connect.php';
?>
<div class="clearfix">
    <a class="btn btn-primary float-left" href="index.php"> &larr; retour</a>
</div>
<?php
// Récupération du billet
$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ? ');

$req->execute(array($_GET['billet']));
$donnees = $req->fetch();

if(empty($donnees)){
    echo 'Ce billet n\'existe pas !';
    exit();
} else{

?>
<div class="col-lg-8 col-md-10 mx-auto">
    <div class="post-preview">
        <a href="index.php">
            <h2 class="post-title">
            <?php echo htmlspecialchars($donnees['titre']); ?>
            </h2>
            <h3 class="post-subtitle">
            <?php echo htmlspecialchars($donnees['contenu']); ?>
            </h3>
        </a>
        <p class="post-meta">Posted by
            <a href="#">Start Bootstrap</a>
            on <?php echo $donnees['date_creation_fr']; ?></p>
    </div>
    <hr>
    <h2>Commentaires</h2>
    <div class="container mx-auto">
            <?php
            }
            $req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

            // Récupération des commentaires
            $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
            $req->execute(array($_GET['billet']));

            while ($donnees = $req->fetch())
            {
            ?>  
            <p>
                <?php echo htmlspecialchars($donnees['auteur']).' le '.$donnees['date_commentaire_fr'] . '<br />' . htmlspecialchars($donnees['commentaire']); ?>
            </p>
    
    <?php
    }
    $req->closeCursor();
    ?>
    </div>
    <div class="container mx-auto">
        <h3>Laissez un commentaire</h3>
        <form action="commentaires_post.php" method="POST" class="container mx-auto ">
        <div class="mb-3">
            <label for="auteur" class="form-label">Pseudo</label>
            <input type="text" class="form-control" name="auteur" id="auteur" placeholder="Entrez un pseudo">
        </div>
        <div class="mb-3">
            <label for="commentaire" class="form-label">Commentaire</label>
            <textarea class="form-control" name ="commentaire" id="commentaire" rows="3" placeholder="Entrez votre commentaire"></textarea>
            <input type="hidden" name="id_billet" value="<?php echo $_GET['billet']; ?>"/>
        </div>
        <input type="submit" value="Envoyer">
        </form>
    </div>
<?php
require_once 'footer.php';
?>