<?php include("../classes/Note.php"); 
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
?>
<DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>5 ETOILE</title>
  <link rel="stylesheet" href="main.css">
  <script src="script.js"></script>
</head>
<body>


<form action="" method="post" class="stars5" onclick="this.submit();" >
<div class="starRating">
    <input id="s5" type="radio" name="etoile" value="5">
    <label for="s5">5</label>
    <input id="s4" type="radio" name="etoile" value="4">
    <label for="s4">4</label>
    <input id="s3" type="radio" name="etoile" value="3">
    <label for="s3">3</label>
    <input id="s2" type="radio" name="etoile" value="2">
    <label for="s2">2</label>
    <input id="s1" type="radio" name="etoile" value="1">
    <label for="s1">1</label>
</div>

<?php
    if(isset($_POST["etoile"])){
        echo "la note est : ".$_POST["etoile"];
        $Note = new Note(1,1,$_POST["etoile"]);
        $Note->saveInBdd();
    }

/*
    Select stade.nom,user.login,note.note FROM stade,note,user
    WHERE
    stade.id = note.idstade
    AND
    note.iduser = user.id;
    Les notes d'un user
    Select stade.nom,note.note FROM stade,note,user
    WHERE
    stade.id = note.idstade
    AND
    note.iduser = user.id
    AND
    user.id = 1
    La moyenne pour un film via son id
    Select AVG(Note.note) FROM stade,note,user
    WHERE
    stade.id = note.idstade
    AND
    note.iduser = user.id
    AND
    stade.id = 1
    */
    ?>
</body>
</html>