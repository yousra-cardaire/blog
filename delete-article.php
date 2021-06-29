<?php
    require('src/connect.php');
    if(isset($_GET['id']) && !empty($_GET['id'])){
        $get_id = $_GET['id'];
        $recup_article = $bdd->prepare('SELECT * FROM billets WHERE id= ?');
        $recup_article->execute(array($get_id));
        $donnees = $recup_article->fetch();
        if($recup_article->rowCount() > 0){
            $user_id = $donnees['user_id'];
            $delete_article = $bdd->prepare('DELETE FROM billets WHERE id = ?');
            $delete_article->execute(array($get_id));
            header('Location: member-page.php?id='.$user_id);

        }else {
            echo 'Aucun article trouvé';
        }
    } else {
        echo "Aucun identifiant trouvé.";
    }
?>
