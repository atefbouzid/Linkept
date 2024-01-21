<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'linkept';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if (!isset($_SESSION['CIN'])) {
    header('Location: Profile.php');
    exit;
}

// On récupère les informations de l'utilisateur connecté 
$afficher_profil = $DB->query("SELECT *
 FROM utilisateur
 WHERE id = ?",
    array($_SESSION['CIN'])
);
$afficher_profil = $afficher_profil->fetch();

if (!empty($_POST)) {
    extract($_POST);
    $valid = true;
    $DB->insert("UPDATE utilisateur SET ANNEE_ADH = 1980");
    header('Location: Profile.php');
            exit;
    // if (isset($_POST['modification'])) {
    //     $nom = htmlentities(trim($nom));
    //     $prenom = htmlentities(trim($prenom));
    //     $mail = htmlentities(strtolower(trim($mail)));


    //     if ($valid) {

            

    //         $STATUT = $_SESSION['STATUT'];
    //         $YEAR = $_SESSION['ANNEE_ADH'];
    //         $DO = $_SESSION['DO'];
    //         $description = $_SESSION['DESCRIPTION'];
    //         $experience = $_SESSION['EXPERIENCE'];

    //         header('Location: profil.php');
    //         exit;
    //     }
    // }
}
?>