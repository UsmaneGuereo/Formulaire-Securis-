<?php
session_start();


if (!isset($_SESSION['login']) || !isset($_SESSION['token']) ||  !isset($_SESSION['cryptedToken']) || !isset($_SESSION['identifiant'])) {
	header("location:../index.html");
}

$encryptedToken = $_SESSION['cryptedToken'];
$cle = "MaCleSecrete";
$decryptedToken = openssl_decrypt($encryptedToken, 'AES-256-CBC', $cle, 0, '1234567890123456');

if ($_SESSION["login"] == false || $_SESSION['token'] != $decryptedToken) {
	header("location:../index.html");
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Accueil</title>
	<link rel="stylesheet" href="../bootstrap-5.2.3/dist/css/bootstrap.css">
	<link rel="stylesheet" href="../bootstrap-5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<div class="row justify-content-end mt-2">
			<div class="col-auto">
				<a href="../traitement.php?msg=logOut"><button class="btn btn-danger" name="logOut">Déconnexion</button></a>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col text-center">
				<h1>Bienvenue, <?php echo $_SESSION['identifiant']; ?></h1>
			</div>
		</div>
	</div>

	<script src="script.js"></script>
    <script src="bootstrap-5.2.3/dist/js/bootstrap.js"></script>
    <script src="bootstrap-5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>