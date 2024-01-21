<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include 'nav.php';
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>
<?= template_header('Home') ?>
<style>
	div .IMAGE {
  		text-align: center;
		width: auto;
		margin-top: 5%;
	}
	.intro-text {
  font-family: Arial, sans-serif;
  font-size: 24px;
  line-height: 1.5;
  text-align: left;
  color: #333333;
  margin: 20px;
}

.intro-text strong {
  color: #0066cc;
}
.intro-text p{
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
font-size: 19px;
letter-spacing: 0px;
word-spacing: 2px;
color: #000000;
font-weight: 400;
text-decoration: none;
font-style: normal;
text-transform: none;
}

.intro-text a {
  color: #0066cc;
  text-decoration: none;
}

.intro-text a:hover {
  text-decoration: underline;
}

	</style>
	<body class="loggedin">
		<div class="content">
			<div class="IMAGE"><h1>Bienvenue  <?=$_SESSION['NOM']?> <?=$_SESSION['PRENOM']?> dans la communauté Linkept ,Connectons les polytechniciens d'hier, d'aujourd'hui et de demain !</h2>
			
			<img style="margin-top:5%;" src='\Linkept\img\homelink.jpg'></div>
			<div class="intro-text">
	
			<p style="margin-top:5%;">
			LinkEPT est votre passerelle vers un réseau florissant de polytechniciens passionnés, où les liens entre les anciens élèves, les professeurs et les étudiants actuels sont renforcés et valorisés. Que vous soyez un expert chevronné dans votre domaine ou un étudiant ambitieux en quête de conseils, LinkEPT est là pour vous connecter, vous inspirer et vous aider à atteindre de nouveaux sommets.
			</p>
			<p>
			En tant que polytechnicien, vous faites partie d'une communauté exceptionnelle. Notre plateforme vous permet de rester en contact avec vos camarades de promotion, d'établir des relations professionnelles fructueuses avec des anciens de renom et de soutenir activement les étudiants actuels dans leur parcours académique.
		</p>
		<p>
		Grâce à LinkEPT, vous pouvez explorer les profils détaillés des utilisateurs, rechercher des polytechniciens par leurs noms et élargir votre réseau en établissant des connexions significatives. Partagez vos expériences, échangez des conseils et découvrez de nouvelles opportunités de collaboration professionnelle.
		</p>
		<p>
		 Restez à l'affût des dernières actualités, des offres d'emploi spécifiques à votre domaine.
		</p>
		<p>
		Chez LinkEPT, nous croyons fermement en la force des relations polytechniciennes. Ensemble, nous pouvons construire un réseau solide, propice à l'échange de connaissances, à l'innovation et à l'avancement professionnel.
		</p>
		<p>
		Rejoignez-nous dès aujourd'hui et découvrez les opportunités infinies qui vous attendent sur LinkEPT.
		</p>
		</div>
		</div>
	</body>
</html>
<?= template_footer() ?>
