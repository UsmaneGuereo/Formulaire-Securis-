<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['msg']) == "logOut") {
        unset($_SESSION['login']);
        unset($_SESSION['token']);
        unset($_SESSION['cryptedToken']);
        unset($_SESSION['identifiant']);
        session_destroy();
        
        header("location:index.html");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $serveur = "localhost";
    $root = "root";
    $password = "";
    $db = "db_form";

    try {
        $pdo = new PDO("mysql:host=$serveur;dbname=$db", $root, $password);

        $identifiant = $_POST['identifiant'];
        $motDePasse = $_POST['motDePasse'];
        $hashedMotDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);

        
        if (isset($_POST['signIn'])) {
            $requete = $pdo->prepare("SELECT * FROM users WHERE identifiant = :identifiant");

            $requete->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);

            $requete->execute();

            if ($requete->rowCount() > 0) {
                while($user = $requete->fetch(PDO::FETCH_ASSOC)) {
                    if (password_verify($motDePasse, $user['motDePasse'])) {

                        $date = new DateTime();
                        $token = $date->getTimestamp();
                        $cle = "MaCleSecrete";
                        
                        $cryptedToken = openssl_encrypt($token, 'AES-256-CBC', $cle, 0, '1234567890123456');
                       
                        $_SESSION['login'] = true;
                        $_SESSION['token'] = $token;
                        $_SESSION['cryptedToken'] = $cryptedToken;
                        $_SESSION['identifiant'] = $identifiant;

                        header('location:admin/index.php');
                    } else {
                        header('location:index.html?msg=failed');
                    }
                }
            } else {
                header('location:index.html?msg=failed');
            }
        }

        if (isset($_POST['signUp'])) {

            $requete = $pdo->prepare("SELECT * FROM users WHERE identifiant = :identifiant");

            $requete->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);

            $requete->execute();

            if ($requete->rowCount() > 0) {
                header('location:index.html?msg=exists');
            } else {
                
                $req = $pdo->prepare("INSERT INTO users (identifiant, motDePasse) VALUES (:identifiant, :motDePasse)");

                $req->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
                $req->bindParam(':motDePasse', $hashedMotDePasse, PDO::PARAM_STR);

                $req->execute();
                header('location:index.html?msg=signUpSuccess');
            }
        } 

    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
    
}


