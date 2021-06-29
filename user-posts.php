<?php

// Récupération des posts du User connecté
$user_id = $_SESSION['user_id'];
$reponse = $bdd->query('SELECT billets.id, billets.titre, billets.contenu,billets.user_id,users.pseudo, DATE_FORMAT(billets.date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets INNER JOIN users ON billets.user_id WHERE billets.user_id=users.user_id AND billets.user_id ='.$user_id.' ORDER BY ID');

?> 

 <!-- Main Content -->
 <div class="card" style="width : 18 rem;">
    <div class="card-body">
    <?php
while ($donnees = $reponse->fetch())
{
    if ($donnees['user_id']=== $user_id){
      $contenu=  preg_replace("/<br\n\W*\/>/", "\n", $donnees['contenu']);
?>
      <h5 class="card-title">
              <?php echo htmlspecialchars($donnees['titre']); ?>
      </h5>
      <h6 class="card-subtitle mb-2 text-muted">
      Posted by<?php echo  $donnees['pseudo']; ?> on <?php echo $donnees['date_creation_fr']; ?>
      </h6>
      <hr>
      <p class="card-text">
        <?php echo $contenu ; ?>
      </p>
       <!-- Pager -->
       <div class="buttons clearfix">
            <!-- <a class="btn btn-primary float-right" href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires &rarr;</a> -->
            <a class="btn btn-warning btn-update float-right" href="update-article.php?id=<?php echo $donnees['id']; ?>">Modifier</a>
            <a class="btn btn-danger  btn-delete float-right mx-2" href="delete-article.php?id=<?php echo $donnees['id']; ?>">Supprimer</a>
         </div>
        <hr>
        <?php 
  }
} 
?>
    </div>
</div>
 
<?php 
$reponse->closeCursor();

?>