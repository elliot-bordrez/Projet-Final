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
    <?php include("../../session.php");

    if(isset($_SESSION['Connexion'])){
    ?>
    <h1> Index </h2>
    <div> Bienvenu <?php echo $TheUser->getLogin()?></div>

    <?php
        if($TheUser->isAdmin()){
            echo"vous etes admin";
        if(isset($_POST["createStade"])){
    
            $newstade = new Stade (null,$_POST["nom"],$_POST["description"],$_POST["lienImage"]);
            $newstade->saveInBdd();
        }
        ?>

        <form action="" method="Post">
            nom : <input type="text" name="nom">
            description : <input type="text" name="description">
            lienImage : <input type="text" name="lienImage">
            <input type="submit" name="createStade" value="Inserer le stade">
        </form>




        <?php
        }else{
            echo "vous etes un simple visiteur, vous n'avez pas acces au CRUD";
        }

    }

    //affichage des stades
    $Stade = new Stade(null,null,null,null);
    $tabStades = $Stade->getAllStade();
    echo"<ul>";
    foreach ($tabStades as $lestade) {
        $lestade->renderHTML();
    }
    echo "</ul>";
?>
</body>
</html>