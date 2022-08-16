<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php 

    try {
        // -------------Connexion à la BDD et récupération et traitement du formulaire
        $ipserver = "localhost:3306";
        $nomBase= "projet_final";
        $loginPrivilege = "SiteWeb";
        $passPrivilege = "SiteWeb";

        $pdo = new PDO('mysql:host='.$ipserver.';dbname='.$nomBase.'', $loginPrivilege, $passPrivilege);

    }catch (Exception $error) {
        $error->getMessage();
    }
    
    if(isset($_POST['connexion'])){
        //Traitement du formulaire
        //On va vérifier en base que le login et le mdp sont bien en BDD
        $RequetSql = "SELECT * FROM 'user' WHERE 'login' = '".$_POST['login']."' AND 'pass' = '".$_POST['pass']."';";

        $resultat = $pdo->query($RequetSql); //resultat de type pdo statement
        if ( $resultat->rowCount()>0){
            echo "on a trouver le bon login";
            $_SESSION['Connexion']=true;
        }else{
            echo "Le login ".$_POST['login']." et le pass ".$_POST['pass']." n'est pas bon";
        }
 }

    if(isset($_SESSION['Connexion'])){
        echo "vous etes deja connecté";
    }else{
        echo "Veuillez vous identifier";
    }


    ?>

    <form action="" method="post">
        Login : <input type="text" name="login" value="elliot"/>
        Pass : <input type="password" name="pass" value="elliot"/>
        <input type="submit" name="connexion">
    </form>
</body>
</html>