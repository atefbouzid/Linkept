<?php
include 'functions.php';

$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = $_GET['id'];
        $CIN = isset($_POST['CIN']) ? $_POST['CIN'] : '';
        $PRENOM = isset($_POST['PRENOM']) ? $_POST['PRENOM'] : '';
        $NOM = isset($_POST['NOM']) ? $_POST['NOM'] : '';
        $EMAIL = isset($_POST['EMAIL']) ? $_POST['EMAIL'] : '';
        $NUMTEL = isset($_POST['NUMTEL']) ? $_POST['NUMTEL'] : '';
        
        $STATUT = isset($_POST['STATUT']) ? $_POST['STATUT'] : '';
        $ANNEE_ADH = isset($_POST['ANNEE_ADH']) ? $_POST['ANNEE_ADH'] : date('Y-m-d H:i:s');
        // Update the record
        $stmt = $pdo->prepare("UPDATE utilisateur SET CIN = ?, NOM = ?, PRENOM = ?, EMAIL = ?, NUMTEL = ?, STATUT = ?, ANNEE_ADH = ? WHERE id = ?");
        $stmt->execute([$CIN, $NOM, $PRENOM, $EMAIL, $NUMTEL, $STATUT, $ANNEE_ADH, $id]);
        $msg = 'Mis à jour avec succés !';


    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>
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
<div class="content update" method="GET">
	<h2>Modifier le compte #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">CIN</label>
        <label for="name">Nom</label>
        <input type="text" name="CIN" placeholder="1" value="<?=$contact['CIN']?>" id="CIN">
        <input type="text" name="NOM" placeholder="John Doe" value="<?=$contact['NOM']?>" id="NOM"> 

        <label for="name">Prénom</label>
        <label for="EMAIL">Email</label>
        <input type="text" name="PRENOM" placeholder="John Doe" value="<?=$contact['PRENOM']?>" id="PRENOM">
        <input type="text" name="EMAIL" placeholder="johndoe@example.com" value="<?=$contact['EMAIL']?>" id="EMAIL">

        <label for="NUMTEL">Numéro de téléphone</label>
        <label for="title">Statut</label>
        <input type="text" name="NUMTEL" placeholder="2025550143" value="<?=$contact['NUMTEL']?>" id="NUMTEL">
        <select name="STATUT" id="STATUT">
        <option disabled selected><?=$contact['STATUT']?></option>
        <option >Etudiant</option>
        <option >Professeur</option>
        <option >Ancien</option></select>
       

        <label for="created">Année d'admission</label>
        <input type="datetime-local" name="ANNEE_ADH" value="<?=date('Y-m-d\TH:i', strtotime($contact['ANNEE_ADH']))?>" id="ANNEE_ADH">
        <input type="submit" value="Modifier">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>