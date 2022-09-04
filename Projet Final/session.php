<?php session_start(); 
include("classes/User.php");
include("classes/Stade.php");
include("classes/Note.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
    <!-- css -->
<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">   
</head>
<body>
<?php

$TheUser = new User(null,null,null);

try {
        // -------------Connexion à la BDD et récupération et traitement du formulaire
        $ipserver = "mysql-bordrez.alwaysdata.net";
        $nomBase= "bordrez_projet";
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

        
    }else{
        echo "Veuillez vous identifier";
    ?>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name="login">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="pass">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn" name="connexion">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="#">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
</body>
</html>