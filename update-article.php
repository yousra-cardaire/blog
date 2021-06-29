<?php
    require('src/connect.php');

    $titre ="";
    $contenu ="";
    $get_id = $_GET['id'];

    if(isset($_GET['id']) && !empty($_GET['id'])){ 
        $get_id = $_GET['id'];
        
        $recup_article = $bdd->prepare('SELECT * FROM billets WHERE id= ?');
        $recup_article->execute(array($get_id));

        if($recup_article->rowCount() > 0) {   
            $articles_infos = $recup_article->fetch();
            $titre = $articles_infos['titre'];
            $contenu = $articles_infos['contenu'];
            $user_id = $articles_infos['user_id'];
            
            if(isset($_POST['valider'])){
                    $titre_modif = htmlspecialchars($_POST['titre']);
                    $contenu_modif = htmlspecialchars($_POST['contenu']);
                
                    $update_article = $bdd->prepare('UPDATE billets SET titre = ?, contenu = ? WHERE id = ?');
                    $update_article->execute(array($titre_modif, $contenu_modif, $get_id));
                    header('Location: member-page.php?id='.$user_id);
                } 
            } else { 
                echo 'Aucun article trouvé';
            }
            
    }  else {
            echo 'Aucun identifiant trouvé';
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
        <div class="container mx-auto">
            <h1>Modifier l'article</h1>
            <form action="update-article.php?id=<?php echo $get_id; ?>" method="POST">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" name="titre" class="form-control" value="<?php echo $titre ; ?>">
                <br />
                <label for="contenu" class="form-label">Contenu</label>
                <textarea name="contenu" rows="10" class="form-control"><?php echo $contenu; ?></textarea>
                <br />
                <input type="submit" name="valider" value="Valider">
            </form>
        </div>
    </body>
</html>