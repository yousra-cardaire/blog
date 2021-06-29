<?php

// Récupération des 5 derniers posts
$reponse = $bdd->query('SELECT id,titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY ID  LIMIT 0,5');

// Récupération des posts du User connecté
// $user_id = $_SESSION['user_id'];

// $reponse = $bdd->query('SELECT id, titre, contenu,user_id, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE user_id ='.$user_id.' ORDER BY ID');


while ($donnees = $reponse->fetch())
{
    
?>

 <!-- Main Content -->
 <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

        <div class="post-preview">
          <a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">
            <h2 class="post-title">
              <?php echo htmlspecialchars($donnees['titre']); ?>
            </h2>
            <h3 class="post-subtitle">
              <?php echo htmlspecialchars($donnees['contenu']); ?>
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="#">PHP Blog</a>
            on <?php echo $donnees['date_creation_fr']; ?></p>
        </div>
        <hr>
 <!-- Pager -->
 <div class="clearfix">
           <a class="btn btn-primary float-right" href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires &rarr;</a>
         </div>
       </div>
     </div>
   </div>
 
   <hr>

<?php 
}

$reponse->closeCursor();

?>