<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit;
}
?>

<?php

// Don't display server errors 
ini_set("display_errors", "off");

// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'linkept';
// Try and connect using the info above.
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Destroy if not possible to create a connection
if (!$conn) {
    echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
}

// Get data to display on index page
$sql = "SELECT * FROM epthub";
$query = mysqli_query($conn, $sql);

// Create a new post
if (isset($_REQUEST['new_post'])) {
    $id = $_SESSION['id'];
    $title = $_REQUEST['title'];
    $contenu = $_REQUEST['contenu'];

    $sql = "INSERT INTO epthub (title, contenu, date, id) VALUES (?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $contenu, $id);
    $stmt->execute();
    $stmt->close();
    echo $sql;

    header("Location: hub.php?info=added");
    exit();
}

// Get post data based on id
if (isset($_REQUEST['id_post'])) {
    $id_post = $_REQUEST['id_post'];
    $sql = "SELECT * FROM epthub WHERE id_post = $id_post";
    $query = mysqli_query($conn, $sql);
}

// Delete a post

if (isset($_REQUEST['delete'])) {
    $id_post = $_REQUEST['id_post'];

    $sql = "DELETE FROM epthub WHERE id_post = $id_post";
    mysqli_query($conn, $sql);

    header("Location: hub.php");
    exit();
}


?>
