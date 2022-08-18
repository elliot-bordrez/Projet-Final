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
    $Stade = new Stade(null,null,null,null);
    $tabStades = $Stade->getAllStade();
    if(isset($_SESSION['Connexion'])){
    ?>
    <h1> Index </h2>
    <div> Bienvenu <?php echo $TheUser->getLogin()?></div>

    <?php
        if($TheUser->isAdmin()){
            echo"vous etes admin";

            if(isset($_POST["idStade"])){
                $Stade->setStadeById($_POST["idStade"]);
            }

            if(isset($_POST["UpdateStade"])){
                $Stade->setStadeById($_POST["id"]); // id vient du champ hidden
                $Stade->setNom($_POST["nom"]);
                $Stade->setDescription($_POST["description"]);
                $Stade->setLienImage($_POST["lienImage"]);

                $Stade->saveInBdd();
            }



        ?>
        <form action="" method="Post" onchange="this.submit()">
            <select id="idStade" name="idStade">
                <option value="null">Chosi un stade</option>
            <?php
                foreach ($tabStades as $TheStade) {

                    if($Stade->getId() == $TheStade->getId()){
                        $selected = "selected";
                    }else{$selected = "";}

                    echo '<option '.$selected.' value="'.$TheStade->getId().'">'.$TheStade->getNom().'</option>';
                }
?>
        </form>

        <form action="" method="Post">
            nom : <input type="text" name="nom" maxlength="100" value="<?= $Stade->getNom() ?>">
            description : <input type="text" name="description" value="<?= $Stade->getDescription() ?>">
            lienImage : <input type="text" name="lienImage" value="<?= $Stade->getlienImage() ?>">
            <input type="Hidden" name="id" value="<?= $Stade->getID() ?>">
            <input type="submit" name="UpdateStade" value="Mettre a jour">
        </form>




        <?php
        }else{
            echo "vous etes un simple visiteur, vous n'avez pas acces au CRUD";
        }

    }

    //affichage des stades
    echo"<ul>";
    foreach ($tabStades as $lestade) {
        $lestade->renderHTML();
    }
    echo "</ul>";
?>
</body>
</html>