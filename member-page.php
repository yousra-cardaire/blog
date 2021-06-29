<?php
    session_start();
    require_once('head.php');
    require('src/connect.php');

    $req = $bdd-> prepare('SELECT pseudo, DATE_FORMAT(subscribe_date, \'%d %M %Y\') AS subscribe_date_year FROM users WHERE user_id='.$_GET['id']);
    $req->execute();
    $result = $req->fetch();
?>
    <header class="header position-relative" style="background-image: url('img/landscape.jpeg'); height: 45vh; margin: 3% 5% ;">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
                <div class="container">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="btn btn-warning" href="disconnection.php">Déconnexion <i class="fas fa-sign-out-alt"></i></a>
                    </li>
                    </ul>
                </div>
                </div>
            </nav>
        </header>
        <div class=" avatar container d-flex justify-content-center align-items-center">
                <i class="fas fa-camera" style="font-size: 2rem; color: white;"></i>
        </div>
        <div class="container">
                <h3 class="text-center mt-3"><?php echo $result['pseudo']; ?></h3>
                <p class="text-center mt-3">Membre depuis le : <?php echo $result['subscribe_date_year']; ?></p>
            <hr>
            <div class="container">
            <div class="d-flex justify-content-end ">
                <div id="new-article">
                    <button type="button" class="btn btn-info btn-write" data-toggle="modal" data-target="#modal-add-article">
                    Ecrire un nouvel article <i class="fas fa-edit"></i></i></button>
                </div>
                <div id="modal-add-article" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Ajouter un article</h3>
                                <a class="close" data-dismiss="modal">&#10006;</a>
                            </div>
                                <div class="modal-body">
                                    <form id="article-form" name="article-form" role="form" method="POST" action="add-article.php">
                                        <label for="titre" class="form-label">Titre</label>
                                        <input type="text" name="titre" class="form-control">
                                        <br />
                                        <label for="contenu" class="form-label">Contenu</label>
                                        <textarea name="contenu" rows="10" class="form-control"></textarea>
                                        <br />
                                        <input type="submit" id="submit" name="envoi" value="Envoyer">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                     <button type = "button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4>Mes Articles</h4>
                <?php require('user-posts.php'); ?>
            </div>
        </div>
<?php
    require_once('footer.php');
?>