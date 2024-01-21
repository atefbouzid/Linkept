<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $CIN = isset($_POST['CIN']) ? $_POST['CIN'] : '';
    $MOT_DE_PASSE = isset($_POST['MOT_DE_PASSE']) ? $_POST['MOT_DE_PASSE'] : '';
    $PRENOM = isset($_POST['PRENOM']) ? $_POST['PRENOM'] : '';
    $NOM = isset($_POST['NOM']) ? $_POST['NOM'] : '';
    $EMAIL = isset($_POST['EMAIL']) ? $_POST['EMAIL'] : '';
    $NUMTEL = isset($_POST['NUMTEL']) ? $_POST['NUMTEL'] : '';
    $STATUT = isset($_POST['STATUT']) ? $_POST['STATUT'] : '';
    $ANNEE_ADH = isset($_POST['ANNEE_ADH']) ? $_POST['ANNEE_ADH'] : date('Y-m-d H:i:s');
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO utilisateur (CIN, MOT_DE_PASSE , NOM, PRENOM, EMAIL, NUMTEL,STATUT, ANNEE_ADH) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$CIN,$MOT_DE_PASSE, $NOM, $PRENOM, $EMAIL, $NUMTEL,$STATUT, $ANNEE_ADH]);
    // Output message
    $msg = 'Créé avec succès !';
}
?>
<?=template_header('Create')?>
<style>
.update form input[type="submit"] {
    display: block;
    background-color: #37afb7;
    border: 0;
    font-weight: bold;
    font-size: 14px;
    color: #FFFFFF;
    cursor: pointer;
    width: 200px;
  margin-top: 15px;
}
.update form input[type="submit"]:hover {
    background-color: #1f575a;
}
    </style>
<div class="content update">
	<h2>Créer un compte</h2>
    <form action="create.php" method="post">
        <label for="id">CIN</label>
        <label for="password">Mot de passe</label>
        <input type="text" name="CIN" placeholder="12345678" id="CIN">
        <input type="text" name="MOT_DE_PASSE" placeholder="12345678" id="MOT_DE_PASSE">

        
        <label for="name">Nom</label>
        <label for="name">Prénom</label>
        <input type="text" name="NOM" placeholder="Nom"  id="NOM"> 
        <input type="text" name="PRENOM" placeholder="Prenom"  id="PRENOM">

        <label for="EMAIL">Email</label>
        <label for="NUMTEL">Numéro de téléphone</label>
        <input type="text" name="EMAIL" placeholder="nomprenom@example.com"  id="EMAIL">
        <input type="text" name="NUMTEL" placeholder="20101010"  id="NUMTEL">

        <label for="title">Statut</label>
        <label for="created">Année d'admission</label>
        <select name="STATUT" id="STATUT">
        <option >--Choisir votre statut--</option>
        <option >Etudiant</option>
        <option >Professeur</option>
        <option >Ancien</option></select>
        <input type="datetime-local" name="ANNEE_ADH" value="<?=date('Y-m-d\TH:i')?>" id="ANNEE_ADH">
        
        <input type="submit" value="Créer">
    </form>
    
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>