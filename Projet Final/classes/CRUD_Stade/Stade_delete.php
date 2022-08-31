<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <link rel='shortcut icon' href='favicon.ico'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

     <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-sm   navbar-light bg-light">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
  <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item">
      <a class="nav-link" href="../../index.php">Accueil <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
    <li class="nav-item dropdown dmenu">
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
      Stade
    </a>
    <div class="dropdown-menu sm-menu">
      <a class="dropdown-item" href="Stade_create.php">Ajouter un stade</a>
      <a class="dropdown-item" href="Stade_update.php">Modifier un stade</a>
      <a class="dropdown-item" href="Stade_delete.php">Supprimer un stade</a>
      <a class="dropdown-item" href="../CRUD_Note/Note_create.php">Modifer note</a>
    </div>
</form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
    $('.navbar-light .dmenu').hover(function () {
       $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
    $(this).find('.sm-menu').second().stop(true, true).slideUp(105)
    }, function () {
    $(this).find('.sm-menu').third().stop(true, true).slideUp(105)
    }, function () {
    $(this).find('.sm-menu').four().stop(true, true).slideUp(105)
});
});
</script>    
</nav>
    <?php include("../../session.php");
    $Stade = new Stade(null,null,null,null,0);

    if(isset($_POST["DeleteStade"])){
        $Stade->setStadeById($_POST["id"]);
        $Stade->deleteInBdd();
    }

    $tabStades = $Stade->getAllStade();


    if(isset($_SESSION['Connexion'])){
    ?>
    <div> Bienvenu <?php echo $TheUser->getLogin()?></div>

    <?php
        if($TheUser->isAdmin()){
            echo"vous etes admin";

            if(isset($_POST["idStade"])){?>
                <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                $Stade->setStadeById($_POST["idStade"]);
                $Stade->renderHTML();
            ?>
            </div>
             </div>
            </div>
        </section>
            <form action="" method="Post">
            <input type="Hidden" name="id" value="<?= $Stade->getID() ?>">
            <input type="submit" name="DeleteStade" value="Supprimer le stade <?= $Stade->getNom() ?>">
        </form>
        <?php
       }

            /*if(isset($_POST["UpdateStade"])){
                $Stade->setStadeById($_POST["id"]); // id vient du champ hidden
                $Stade->setNom($_POST["nom"]);
                $Stade->setDescription($_POST["description"]);
                $Stade->setLienImage($_POST["lienImage"]);

                $Stade->saveInBdd();
            }*/



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

        <?php
        }else{
            echo "vous etes un simple visiteur, vous n'avez pas acces au CRUD";
        }

    }
    
?>
</body>
</html>