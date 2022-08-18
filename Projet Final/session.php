<?php session_start(); 
include("classes/User.php");
include("classes/Stade.php");

$TheUser = new User(null,null,null);

try {
        // -------------Connexion à la BDD et récupération et traitement du formulaire
        $ipserver = "localhost:3306";
        $nomBase= "projet_final";
        $loginPrivilege = "SiteWeb";
        $passPrivilege = "SiteWeb";

       $GLOBALS["pdo"] = new PDO('mysql:host='.$ipserver.';dbname='.$nomBase.'', $loginPrivilege, $passPrivilege);

    }catch (Exception $error) {
        $error->getMessage();
    }

    if(isset($_POST['connexion'])){
        $TheUser->seConnecter($_POST['login'],$_POST['pass']);
 
 }

    if(isset($_POST['deconnexion'])){
        //echo "vous etes déconnecter";
        $TheUser->seDeConnecter();
    }


    if(isset($_SESSION['Connexion']) && $_SESSION['Connexion']==true){

        $TheUser->setUserById($_SESSION['id']);

        ?>
        <form action="" method="post">
            <input type="submit" name="deconnexion" value="Se déconnecter">
        </form>
        <a href="page2.php">acces à la page2</a>
        <?php
    }else{
        echo "Veuillez vous identifier";
        ?>
        <form action="" method="post">
            Login : <input type="text" name="login" value="elliot"/>
            Pass : <input type="password" name="pass" value="elliot"/>
            <input type="submit" name="connexion">
        </form>
        <?php
    }


    ?>