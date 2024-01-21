<?php
// We need to use sessions, so you should always start sessions using the below code.
// If the user is not logged in redirect to the login page...

session_start();

include('function.php');
include('nav.php');
include('logic.php');

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>
<?= template_header('Posts') ?>

<div class="container mt-5">



    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Blog using PHP & MySQL</title>
</head>
<body> 

<?php
// Récupérer l'id de l'utilisateur connecté
$id = $_SESSION['id'];

// Exécuter la requête SQL pour récupérer les posts de l'utilisateur
$sql = "SELECT * FROM epthub WHERE id = $id ORDER BY id_post DESC";
$result = $conn->query($sql);

// Afficher les posts
foreach($result as $q) {
    ?>
    <div style="margin-top:5%;" class="bg-dark p-5 rounded-lg text-white text-center">
        <h1><?php echo $q['title'];?></h1>

        <div class="d-flex mt-2 justify-content-center align-items-center">
            <form method="POST">
                <input type="text" hidden value='<?php echo $q['id_post']?>' name="id_post">
                <p  class="mt-5 border-left border-dark pl-3"><?php echo $q['contenu'];?></p>

                <button class="btn btn-danger btn-sm ml-2" name="delete">Supprimer</button>
            </form>
        </div>
    </div>

    <?php
}
?>
 <a href="hub.php" class="btn btn-outline-dark my-3">Retour à EptHUB</a>
</div>




    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<?= template_footer() ?>
