<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        // $bdd = new PDO('mysql:host=localhost;dbname=blog_yousra;charset=utf8', 'yousra', 'yous099440');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
?>