<?php
function template_header($title)
{
    echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
		<title>$title</title>
		<link href="/Linkept/CSS/nav.css" rel="stylesheet" type="text/css">
		<link href="/Linkept/CSS/style.css" rel="stylesheet" type="text/css">
        <script src="https://kit.fontawesome.com/b356ad9dc8.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <script src="https://kit.fontawesome.com/b356ad9dc8.js" crossorigin="anonymous"></script>

    </head>
	<body>
    <nav class="navtop">
    	<div>
        <h1>LinkEPT</h1>
        <a href="/Linkept/Web/home.php"><i class="fa-solid fa-house"></i>Accueil</a>
        <a href="/Linkept/Web/search.php"><i class="fa-solid fa-magnifying-glass"></i>Rechercher</a>
        <a href="Profile.php"><i class="fa-solid fa-user"></i>Mon Profil</a>
        <a href="hub.php"><i class="fa-solid fa-signs-post"></i>EPThub</a>
        <a href="/Linkept/Web/setting.php"><i class="fa-solid fa-gear"></i>Paramètres</a>
        <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Se déconnecter</a>
    	</div>
    </nav>
   
	<!DOCTYPE html>  
EOT;
}
function template_footer()
{
    echo <<<EOT
    <style>
    .footer-dark {
        padding:30px 0;
        color:#f0f9ff;
        background-color:#65799b;
        margin-top:5%;
      }
      
      .footer-dark h3 {
        margin-top:0;
        margin-bottom:12px;
        font-weight:bold;
        font-size:16px;
      }
      
      .footer-dark ul {
        padding:0;
        list-style:none;
        line-height:1.6;
        font-size:14px;
        margin-bottom:0;
      }
      
      .footer-dark ul a {
        color:inherit;
        text-decoration:none;
        opacity:0.6;
      }
      
      .footer-dark ul a:hover {
        opacity:0.8;
      }
      
      @media (max-width:767px) {
        .footer-dark .item:not(.social) {
          text-align:center;
          padding-bottom:20px;
        }
      }
      
      .footer-dark .item.text {
        margin-bottom:36px;
      }
      
      @media (max-width:767px) {
        .footer-dark .item.text {
          margin-bottom:0;
        }
      }
      
      .footer-dark .item.text p {
        opacity:0.6;
        margin-bottom:0;
      }
      
      .footer-dark .item.social {
        text-align:center;
      }
      
      @media (max-width:991px) {
        .footer-dark .item.social {
          text-align:center;
          margin-top:20px;
        }
      }
      
      .footer-dark .item.social > a {
        font-size:20px;
        width:36px;
        height:36px;
        line-height:36px;
        display:inline-block;
        text-align:center;
        border-radius:50%;
        box-shadow:0 0 0 1px rgba(255,255,255,0.4);
        margin:0 8px;
        color:#fff;
        opacity:0.75;
      }
      
      .footer-dark .item.social > a:hover {
        opacity:0.9;
      }
      
      .footer-dark .copyright {
        text-align:center;
        padding-top:24px;
        opacity:0.3;
        font-size:13px;
        margin-bottom:0;
      }
    </style>
    <div class="footer-dark">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                    <h3>Contact</h3>
                    <ul>
                        <li><i class="fa-solid fa-house"></i><a href="#"> B.P. 743 - 2078 La Marsa Tunisia</a></li>
                        <li><i class="fa-solid fa-phone"></i><a href="#"> +216 71 774 611</a></li>
                        <li><i class="fa-solid fa-envelope"></i><a href="#">  lilia.elamraoui@ept.u-carthage.tn</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                
                </div>
                <div class="col-md-6 item text">
                    <h3>Développée par</h3>
                    <p>Un groupe d'élèves ingénieurs à l'EPT de la promotion 2023.</p>
                </div>
            </div>
            <p class="copyright">École Polytechnique de Tunisie © 2023</p>
        </div>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
EOT;
}