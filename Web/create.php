<?php
session_start();

include('function.php');
include('nav.php');
include('logic.php');


?>


<?= template_header('Posts') ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>

   <div class="container mt-5">
        <form method="GET">
            <!-- <input type="text" placeholder="Blog Title" class="form-control my-3 bg-dark text-white text-center" name="title"> -->
            <textarea name="title" placeholder=" Titre du post" class="form-control my-3 bg-dark text-white text-center" cols="10" rows="1"></textarea>
            <textarea name="contenu" class="form-control my-3 bg-dark text-white" cols="40" rows="10"></textarea>
            <button name="new_post" class="btn btn-dark" >Ajouter post</button>
        </form>
   </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <?= template_footer() ?>
