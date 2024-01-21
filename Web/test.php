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
// Acquire ID
$id = $_GET['id'];
// GET Request
$query = $pdo->prepare("SELECT * FROM articles WHERE id='$id'");
$query->execute();
$article = $query->fetch(PDO::FETCH_ASSOC);
// Get Data from POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Acquire Data
    $name = $_POST['name'];
    if(isset($_POST['submit_im'])){
  
        // Define the target folder for the uploaded photo
        $target_dir = 'images/';
      
        // Get the name of the uploaded file
        $file_name = $_FILES["fileToUpload"]["name"];
      
        // Concatenate the target directory and file name to get the full path of the uploaded file
        $target_file = $target_dir . $file_name;
      
        // Check if the file already exists in the target directory
        if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          return;
        }
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check === false) {
            echo "File is not an image.";
            return;
        }

        // Try to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". $file_name . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $description = $_POST['description'];
    $tel = $_POST['tel'];
    $price = $_POST['price'];
    // Validation
    if (!$name) {
        $errors[] = "Name not found";
    }
    if (!$file_name) {
        $errors[] = "Image not found";
    }
    if (!$description) {
        $errors[] = "Description not found";
    }
    if (!$tel) {
        $errors[] = "Telephone Number not found";
    }
    if (!$price) {
        $errors[] = "Price not found";
    }
    if (empty($errors)) {
        $query = $pdo->prepare("UPDATE articles SET name='$name',image='$file_name',description='$description',tel='$tel',price='$price' WHERE (id='$id')");
        $query->execute();
        header('Location:index.php');
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body style="padding:30px 50px">
    <h1 style="font-weight:bold">Update Article</h1>
    <!--Go Back Button-->
    <a href="index.php" type="button" class="btn btn-secondary" style="margin:30px 0px 10px">Articles List</a>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error) : ?>
                <div>
                    <?php echo ($error) ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <!--Form-->
    <form action="" method="post" enctype='multipart/form-data'>
        <div class="mb-3">
            <label>Article Image</label><br>
            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" value="<?php echo $article['image'] ?>">
            <input type="submit" class="form-control" value="Upload Image" name="submit_im">
        </div>
        <div class="mb-3">
            <label>User Name</label><br>
            <input type="text" class="form-control" name="name" value="<?php echo $article['name'] ?>">
        </div>
        <div class="mb-3">
            <label>Description</label><br>
            <input type="text" class="form-control" name="description" value="<?php echo $article['description'] ?>">
        </div>
        <div class="mb-3">
            <label>Price</label><br>
            <input type="text" class="form-control" name="price" value="<?php echo $article['price'] ?>">
        </div>
        <div class="mb-3">
            <label>Telphone Number</label><br>
            <input type="text" class="form-control" name="tel"value="<?php echo $article['tel'] ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>