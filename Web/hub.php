<?php
session_start();
include('function.php');
include('nav.php');
include('logic.php');
?>

<?= template_header('HUB') ?>

<script src="https://kit.fontawesome.com/b356ad9dc8.js" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css"
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
  integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" href="\Linkept\CSS\hub.css">

</head>
<style>
  .title {
    text-align: center;
    font-family: Roboto,Helvetica,Arial,sans-serif;
    font-size: 80px;
    color: white;
    margin-top: 116px;
    margin-bottom: -100px;
}
.clock {
    text-align: center;
    margin-bottom: -100px;
    align-items: center;
    margin-top: 83px;
    color: white;
    font-size: 70px;
    font-family: Roboto,Helvetica,Arial,sans-serif;

    letter-spacing: 7px;
}
.btn-outline-dark {
    color: #343a40;
    border-color: #343a40;
    background-color: white;
}
.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    
    margin-right: -90px;
    margin-left: 80px;
}

  </style>
<body>


  <?php if (isset($_REQUEST['info']) && $_REQUEST['info'] == "added") { ?>
    <!-- Alert for post added -->
  <?php } ?>
    <!-- Create a new Post button -->
    
  <div class="title">Bienvenue à EptHUB</div>
  <div id="MyClockDisplay" class="clock" onload="showTime()" style="margin-bottom: 10px;"></div>
    <div class="text-center" style="margin-bottom: 10px;">
      <a href="create.php" class="btn btn-outline-dark">+ Créer un post</a>
    </div>
    <div class="text-center" style="margin-bottom: 10px;">
      <a href="view.php" class="btn btn-outline-dark">Mes posts</a>
    </div>

    <!-- Display posts from database -->
    <div class="row">
      <?php
      // Connexion à la base de données
      $conn = new mysqli('localhost', 'root', 'root', 'linkept');

      // Vérification de la connexion
      if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
      }

      // Requête SQL pour récupérer les données des posts et de leurs auteurs
      $sql = "SELECT p.*, u.NOM AS auteur_nom, u.PRENOM AS auteur_prenom FROM epthub p JOIN utilisateur u ON p.id = u.id ORDER BY date DESC";
      $result = $conn->query($sql);

      // Vérification des résultats
      if ($result->num_rows > 0) {
        // Affichage des résultats dans une boucle foreach
        foreach ($result as $row) {
          ?>
          <div class="col-12 col-lg-4">
            <div class="card text-white bg-dark mt-5" style="width: 18rem;">
              <div class="card-body" >
                <h5 class="card-title">
                  <?php echo $row['title']; ?>
                </h5>
                <p class="card-textt">
                  <?php echo $row['date']; ?>
                </p>
                <div class="card-text" id="post-content">
                  <?php
                  $content = $row['contenu'];
                  ?>
                  <span style="margin-top:5%;" class="btn btn-light" onclick="togglePostContent(this)">En savoir-plus <span
                      class="text-danger">&rarr;</span></span>
                  <div class="full-text d-none">
                    <?php echo $content; ?>
                  </div>
                </div>
                <p style="margin-top:5%;" class="auteur">Par
                  <?php echo $row['auteur_nom'] . ' ' . $row['auteur_prenom']; ?>
                </p>
              </div>
            </div>
          </div>


        <script>
          function togglePostContent(element) {
            var postContent = element.closest('.card').querySelector('.full-text');
            var readMore = element;
            if (postContent.classList.contains('d-none')) {
              postContent.classList.remove('d-none');
              readMore.innerHTML = 'Réduire <span class="text-danger">&larr;</span>';
            } else {
              postContent.classList.add('d-none');
              readMore.innerHTML = 'En savoir-plus <span class="text-danger">&rarr;</span>';
            }
          }
        </script>

        <?php
        }
      } else {
        echo "Aucun résultat trouvé.";
      }

      // Fermeture de la connexion à la base de données
      $conn->close();
      ?>
  </div>





  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
  <script src="hub.js"></script>
