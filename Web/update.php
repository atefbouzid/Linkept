<?php
session_start();
include 'nav.php';

function pdo_connect_mysql()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'root';
    $DATABASE_NAME = 'linkept';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to database!');
    }
}
$pdo = pdo_connect_mysql();
$msg = '';


if (isset($_SESSION['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $CIN = isset($_POST['CIN']) ? $_POST['CIN'] : '';
        $PRENOM = isset($_POST['PRENOM']) ? $_POST['PRENOM'] : '';
        $NOM = isset($_POST['NOM']) ? $_POST['NOM'] : '';
        $EMAIL = isset($_POST['EMAIL']) ? $_POST['EMAIL'] : '';
        $NUMTEL = isset($_POST['NUMTEL']) ? $_POST['NUMTEL'] : '';
        $STATUT = isset($_POST['STATUT']) ? $_POST['STATUT'] : '';
        $ANNEE_ADH = isset($_POST['ANNEE_ADH']) ? $_POST['ANNEE_ADH'] : date('Y-m-d H:i:s');
        $EXPERIENCE = isset($_POST['EXPERIENCE']) ? $_POST['EXPERIENCE'] : '';
        $DESCRIPTION = isset($_POST['DESCRIPTION']) ? $_POST['DESCRIPTION'] : '';
        $DO = isset($_POST['DO']) ? $_POST['DO'] : '';


        // Update the record
        $stmt = $pdo->prepare('UPDATE utilisateur SET  STATUT = ?, ANNEE_ADH = ?, DESCRIPTION = ?, EXPERIENCE = ?, DO = ? WHERE id = ?');
        $stmt->execute([$STATUT, $ANNEE_ADH, $DESCRIPTION, $EXPERIENCE, $DO, $_GET['id']]);
        $msg = 'Le changement est engistré !';


        // Redirect to the login page after the update
        header('Location: logout.php?id=' . $_SESSION['id'],true);
        exit;
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE id = ?');
    $stmt->execute([$_SESSION['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('User doesn\'t exist !');
    }
} else {
    exit('No Account specified!');
}
?>
<?= template_header('Modifier le resumé') ?>
<script>
    // Disable departement select element if an option is selected
    function onOptionSelect(a, b) {
        var optionSelect = document.getElementById(a);
        var departementSelect = document.getElementById(b);
        departementSelect.disabled = (optionSelect.value != "");
    }
</script>

<style>
    .update form input[type="submit"] {
    display: block;
    background-color: #65799b;
    border: 0;
    font-weight: bold;
    font-size: 14px;
    color: #FFFFFF;
    cursor: pointer;
    width: 200px;
    margin-top: 15px;
}
.update form input[type="submit"]:hover {
    background-color: #1d3764;
}
    </style>
<div class="content update">
    <h2>Modifier Le Profile </h2>
    <form action="update.php?id=<?= $contact['id'] ?>" method="post">

        <label for="DESCRIPTION">Description</label>
        
        <input type="textarea" name="DESCRIPTION" value="<?= $contact['DESCRIPTION'] ?>" id="DESCRIPTION">
        <label for="EXPERIENCE">Expérience</label>
        <input type="textarea" name="EXPERIENCE" value="<?= $contact['EXPERIENCE'] ?>" id="EXPERIENCE">

        <label for="STATUT">Statut</label>
        <select name="STATUT" id="STATUT">
            <option required>
                <?= $contact['STATUT'] ?>
            </option>
            <option>Etudiant</option>
            <option>Ancien</option>
            <option>Professeur</option>
        </select>
        <h4>Tu dois choisir une option (cas d'un etudiant) ou un departement (cas d'un prof) !</h4>
        <label for="DO">Option</label>
        <select name="DO" id="DO1" class="Option" onchange='onOptionSelect("DO1","DO2")'>
            <option >
                <?= $contact['DO'] ?>
            </option>
            <option></option>
            <option>TC</option>
            <option>SISY</option>
            <option>SYSCO</option>
            <option>EGES</option>
        </select>
        <label for="DO">Département</label>
        <select name="DO" id="DO2" class="Departement" onchange='onOptionSelect("DO2","DO1")'>
            <option >
                <?= $contact['DO'] ?>
            </option>
            <option></option>
            <option>Mathématique Appliquée et Inf</option>
            <option>Mecanique</option>
            <option>Electrique</option>
            <option>Economie gestion</option>
            <option>Langue</option>
        </select>



        <label for="created">Année d'admission</label>
        <input type="datetime-local" name="ANNEE_ADH"
            value="<?= date('Y-m-d\TH:i', strtotime($contact['ANNEE_ADH'])) ?>" id="ANNEE_ADH">
        <script>
            const update = document.querySelector('#update');

            // Add a click event listener to the update button
            update.addEventListener('click', () => {
                // Show an alert with the success message
                alert(' La modification est faite! S\'il vous plait, reconnectez-vous pour voir les changements. ');
            });
        </script>
                <label for="password">Mot de passe</label>
        <input type="password" name="MOT_DE_PASSE" placeholder="Entrez votre mot de passe"
            id="MOT_DE_PASSE">
        <label for="password">Confirmation du mot de passe</label>
        <input type="password" name="CONFIRM_MOT_DE_PASSE" placeholder="Confirmer votre mot de passe"
            id="CONFIRM_MOT_DE_PASSE">

        <input type="submit" value="Enregistrer" id="update">
       
        <script>
           
    const update = document.querySelector('#update');
    var mdpSelect = document.getElementById("MOT_DE_PASSE");
    var cmdpSelect = document.getElementById("CONFIRM_MOT_DE_PASSE");

    // Add a click event listener to the update button
    update.addEventListener('click', () => {
        if (mdpSelect.value !== cmdpSelect.value) {
            alert('Les mots de passe ne correspondent pas!');
            event.preventDefault();
        }else if (mdpSelect.value =="" || cmdpSelect.value==""){
            alert('Vous devez remplir le champ mot de passe pour terminer votre modification');
        }else{
            alert('Reconnectez-vous pour voir les changements. ');
        }
    });
</script>
    </form>
    <?php if ($msg): ?>
        <p>
            <?= $msg ?>
        </p>
    <?php endif; ?>

</div>

<?= template_footer() ?>