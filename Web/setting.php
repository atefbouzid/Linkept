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
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $PRENOM = isset($_POST['PRENOM']) ? $_POST['PRENOM'] : '';
        $NOM = isset($_POST['NOM']) ? $_POST['NOM'] : '';
        $EMAIL = isset($_POST['EMAIL']) ? $_POST['EMAIL'] : '';
        $NUMTEL = isset($_POST['NUMTEL']) ? $_POST['NUMTEL'] : '';
        $LINKEDIN = isset($_POST['LINKEDIN']) ? $_POST['LINKEDIN'] : '';
        $FACEBOOK = isset($_POST['FACEBOOK']) ? $_POST['FACEBOOK'] : '';
        $TWITTER = isset($_POST['TWITTER']) ? $_POST['TWITTER'] : '';
        $GITHUB = isset($_POST['GITHUB']) ? $_POST['GITHUB'] : '';
        $INSTAGRAM = isset($_POST['INSTAGRAM']) ? $_POST['INSTAGRAM'] : '';
        $YOUTUBE = isset($_POST['YOUTUBE']) ? $_POST['YOUTUBE'] : '';
        $SITEWEB = isset($_POST['SITEWEB']) ? $_POST['SITEWEB'] : '';
        $MOT_DE_PASSE = isset($_POST['MOT_DE_PASSE']) ? $_POST['MOT_DE_PASSE'] : '';
        $CONFIRM_MOT_DE_PASSE = isset($_POST['CONFIRM_MOT_DE_PASSE']) ? $_POST['CONFIRM_MOT_DE_PASSE'] : '';

        if (!empty($MOT_DE_PASSE) && $MOT_DE_PASSE != $CONFIRM_MOT_DE_PASSE) {
            // Password and confirmation don't match, show error message
            $msg = "Les mots de passe ne correspondent pas !";
        } else if (empty($MOT_DE_PASSE) || empty($CONFIRM_MOT_DE_PASSE)) {
            // Password fields are empty, and user hasn't completed registration before
            $msg = "Vous devez remplir le champ mot de passe pour terminer votre modification";
            
        } else {
            // Update the record
            $stmt = $pdo->prepare('UPDATE utilisateur SET PRENOM =?, NOM =?, EMAIL =?, NUMTEL =?, LINKEDIN =?, FACEBOOK =?, TWITTER =?, GITHUB =?, INSTAGRAM =?, YOUTUBE =?, SITEWEB =?, MOT_DE_PASSE =? WHERE id = ?');
            $stmt->execute([$PRENOM, $NOM, $EMAIL, $NUMTEL, $LINKEDIN, $FACEBOOK, $TWITTER, $GITHUB, $INSTAGRAM, $YOUTUBE, $SITEWEB, $MOT_DE_PASSE, $_GET['id']]);
            $msg = 'Le changement est enregistré !';

            // Redirect to the login page after the update
            header('Location: logout.php?id=' . $_SESSION['id'], true);
            exit;
        }
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
<style>
      #alert {
         display: none;
         background-color: rgb(252, 219, 219);
         border: 1px solid green;
         position: fixed;
         height: 80px;
         width: 250px;
         left: 40%;
         top: 2%;
         padding: 6px 8px 8px;
         text-align: center;
      }
      button {
         border-radius: 12px;
         height: 2rem;
         padding: 7px;
         cursor: pointer;
         border: 2px solid green;
         background-color: aqua;
      }
      #close {
         position: absolute;
         right: 20px;
         bottom: 10px;
      }
      
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
    <h2>Paramètres</h2>
    <form action="setting.php?id=<?= $contact['id'] ?>" method="post">

        <label for="name">Nom</label>
        <label for="name">Prénom</label>
        <input type="text" name="NOM" placeholder="Nom" value="<?= $contact['NOM'] ?>" id="NOM">
        <input type="text" name="PRENOM" placeholder="Prenom" value="<?= $contact['PRENOM'] ?>" id="PRENOM">

        <label for="EMAIL">Email</label>
        <label for="NUMTEL">Numero de téléphone</label>
        <input type="text" name="EMAIL" placeholder="nomprenom@example.com" value="<?= $contact['EMAIL'] ?>" id="EMAIL">
        <input type="text" name="NUMTEL" placeholder="20101010" value="<?= $contact['NUMTEL'] ?>" id="NUMTEL">

        <label>LinkedIn</label>
        <label>Facebook</label>
        <input type="text" name="LINKEDIN" placeholder="Entrer votre LinkedIn" value="<?= $contact['LINKEDIN'] ?>">
        <input type="text" name="FACEBOOK" placeholder="Entrer votre Facebook " value="<?= $contact['FACEBOOK'] ?>">

        <label>Twitter</label>
        <label>Github</label>
        <input type="text" name="TWITTER" placeholder="Entrer votre Twitter" value="<?= $contact['TWITTER'] ?>">
        <input type="text" name="GITHUB" placeholder="Entrer votre Github" value="<?= $contact['GITHUB'] ?>">

        <label>Instagram</label>
        <label>YouTube</label>
        <input type="text" name="INSTAGRAM" placeholder="Entrer votre Instagram" value="<?= $contact['INSTAGRAM'] ?>">
        <input type="text" name="YOUTUBE" placeholder="Entrer votre chaine YouTube" value="<?= $contact['YOUTUBE'] ?>">


        <label>Site web</label>
        <input type="mail" name="SITEWEB" placeholder="Entrer votre site web" value="<?= $contact['SITEWEB'] ?>">

        <label for="password">Mot de passe</label>
        <input type="password" name="MOT_DE_PASSE" placeholder="Votre mot de passe (tu peux le changer)"
            id="MOT_DE_PASSE">
        <label for="password">Confirmation du mot de passe</label>
        <input type="password" name="CONFIRM_MOT_DE_PASSE" placeholder="Confirmer votre mot de passe"
            id="CONFIRM_MOT_DE_PASSE">

        <input type="submit" value="Enregistrer" id="update">
        <?php if ($msg): ?>
            <p>
                <?= $msg ?>
            </p>
        <?php endif; ?>
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

</div>

<?= template_footer() ?>