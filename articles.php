<?php

session_start();
require('src/connect.php');

if(!$_SESSION['connect']){
    header('Location: connection.php');
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Publier un article</title>
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
        <?php
            $read_articles = $bdd->query('SELECT * FROM billets');
            while($article = $read_articles->fetch()){
        ?>
        
        <div class="container">
            <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">

                <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                    <?php echo $article['titre']; ?>
                    </h2>
                    <h3 class="post-subtitle">
                    <?php echo $article['contenu']; ?>
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">PHP Blog</a>
                    on <?php echo $article['date_creation']; ?></p>
                </div>
                <hr>
        <!-- Pager -->
        <div class="clearfix">
                <a class="btn btn-danger float-right" href="delete-article.php?id=<?php echo $article['id']; ?>"> Supprimer &#128465;</a>
                <a class="btn btn-warning float-right" href="update-article.php?id=<?php echo $article['id']; ?>">Modifier &#128393;</a>
                </div>
            </div>
            </div>
        </div>
        
        <hr>
        <?php 
            } 
        ?>
    </body>
</html>