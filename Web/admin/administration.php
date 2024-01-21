<?php
include 'functions.php';
// Your PHP code here.

// Home Page template below.
?>

<?=template_header('Home')?>
<style>
img {
text-align: center;
width : 230px;
height : 230px;
}
div {
  text-align: center;
}

</style>
<div class="content">
	<h2 style='font-size: 50px;'>Bienvenue, administrateur !</h2>
	<p style='
    display: block;
	font-size: 25px;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
'>Cet espace est spécialement conçu pour vous permettre d'ajouter et de modifier les données des utilisateurs du site. En tant qu'administrateur, vous avez le pouvoir de gérer les informations essentielles liées aux utilisateurs, assurant ainsi un contrôle efficace sur leur profil et leur expérience sur le site.</p>
<div>
<img src='\Linkept\img\hello gif.gif'>
</div>
</div>

<?=template_footer()?>