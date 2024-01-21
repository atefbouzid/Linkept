<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'linkept';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['CIN'], $_POST['MOT_DE_PASSE']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, MOT_DE_PASSE, NOM ,PRENOM,EMAIL,FACEBOOK,TWITTER,GITHUB,YOUTUBE,INSTAGRAM,NUMTEL,SITEWEB,DESCRIPTION,DO,EXPERIENCE,STATUT,ANNEE_ADH FROM utilisateur WHERE CIN = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['CIN']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $MOT_DE_PASSE, $NOM ,$PRENOM,$EMAIL,$FACEBOOK,$TWITTER,$GITHUB,$YOUTUBE,$INSTAGRAM,$NUMTEL,$SITEWEB,$DESCRIPTION,$DO,$EXPERIENCE,$STATUT,$ANNEE_ADH);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if ($_POST['MOT_DE_PASSE'] === $MOT_DE_PASSE)  {
            
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['CIN'] = $_POST['CIN'];
            $_SESSION['id'] = $id;
            $_SESSION['PRENOM']=$PRENOM;
            $_SESSION['NOM'] = $NOM;
            $_SESSION['EMAIL']=$EMAIL ;
            $_SESSION['FACEBOOK']=$FACEBOOK ;
            $_SESSION['TWITTER']=$TWITTER ;
            $_SESSION['GITHUB']=$GITHUB ;
            $_SESSION['YOUTUBE']=$YOUTUBE ;
            $_SESSION['INSTAGRAM']=$INSTAGRAM ;
            $_SESSION['NUMTEL']=$NUMTEL ;
            $_SESSION['SITEWEB']=$SITEWEB ;
            $_SESSION['DESCRIPTION']=$DESCRIPTION ;
            $_SESSION['DO']=$DO ;
            $_SESSION['EXPERIENCE']=$EXPERIENCE ;
            $_SESSION['STATUT']=$STATUT ;
            $_SESSION['ANNEE_ADH']=$ANNEE_ADH ;
            if($STATUT==="Admin"){
                header("location:/Linkept/Web/admin/administration.php",true);
                
            }
            else{
                header("location:home.php",true);
            }
            
        } else {
            // Incorrect password
            echo "Nom d'utilisateur et/ou mot de passe incorrect!";
            header("location:login.html",true);

        }
    } else {
        // Incorrect username
        echo "Nom d'utilisateur et/ou mot de passe incorrect!";
        header("location:login.html",true);
    }


	$stmt->close();
}
?>