
<?php
// We need to use sessions, so you should always start sessions using the below code.
include 'nav.php';
include('function.php');
session_start();

// If the user is not logged in redirect to the login page...
?>
<?= template_header('Profile after search') ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LinkEPT - Profile</title>

    <link rel="stylesheet" href="/Linkept/CSS/Profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b356ad9dc8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesgeet"
        href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css">
</head>
<?php
					$id=$_GET['id'];
					$sql="SELECT  *  FROM  utilisateur  where id='$id'";
					$result=mysqli_query($con,$sql);
					$rows=mysqli_fetch_array($result);
			?>
<body class="loggedin">
    <div class="background"></div>
    <div class="container">
        <div class="user">
            <h6><i class="fa-solid fa-link"></i> Pour contacter ce membre </h6>
            <hr>
            <div class="avatar"></div>
            <img style='
            margin-top:-30%;
            width :150px;
            height:150px' src='\Linkept\img\profile.png'>
            <h2 class="Fullname"><?=$rows['NOM']?> <?=$rows['PRENOM']?></h2>
                <div class="detail">
                    <i class="fa-solid fa-envelope"></i>&nbsp;
                    <span><?=$rows["EMAIL"]?></span>
                </div>
                <div class="detail">
                    <i class="fa-solid fa-phone"></i>&nbsp;
                    <span><?=$rows["NUMTEL"]?></span>
                </div>
                <div class="detail">
                    <i class="fa-solid fa-globe"></i>&nbsp;
                    <span><?= $rows["SITEWEB"]?></span>
                </div>
            
                <div class="social-media">
                    <a href="#" class="btn btn-just-icon btn-link btn-pinterest"><i
                            class="fa-solid fa-envelope"></i></a>
                    <a href="#" class="btn btn-just-icon btn-link btn-dribbble"><i
                            class="fa-brands fa-linkedin-in"></i></a>
                    <a href="<?= $rows["FACEBOOK"]?>" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-facebook"></i></a>
                    <a href="<?= $rows["TWITTER"]?>" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                    <a href="<?= $rows["GITHUB"]?>" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa-brands fa-github"></i></a>
                    <a href="<?= $rows["YOUTUBE"]?>" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa-brands fa-youtube"></i></a>
                    <a href="<?= $rows["INSTAGRAM"]?>" class="btn btn-just-icon btn-link btn-dribbble"><i
                            class="fa-brands fa-instagram"></i></a>
                </div>
             
        </div>
        <div class="details">

            <div class="about">
                
                <h2 class="Resumetitre">À propos de ce Profil</h2>
                <hr>
                <div class="element">
                    <h3>DESCRIPTION:</h3>
                    <p><?= $rows["DESCRIPTION"]?></p>
                </div>
                <div class="element">
                    <h3>Statut:</h3>
                    <p>
                    <div class="skill"><?= $rows["STATUT"]?></div>
                    </p>
                </div>
                <div class="element">
                    <h3>Département/Option:</h3>
                    <p><?= $rows["DO"]?></p>
                </div>
                <div class="element">
                    <h3>Année d'admission:</h3>
                    <p><?= date('Y', strtotime($_SESSION["ANNEE_ADH"])) ?></p>
                </div>
               

            </div>
            <div class="experience">
                <h2 class="Resumetitre"><img class="img1" src="/Linkept/img/briefcase.png"></img> Expérience</h2>
                <hr>
                <div class="experiences-list">
                    <div class="element">
                        <h7><?=$rows["EXPERIENCE"]?></h7>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/50e2c75840.js" crossorigin="anonymous"></script>

</body>

</html>
