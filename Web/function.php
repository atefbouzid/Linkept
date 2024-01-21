<?php
$mysqli_hostname = "localhost";
$mysqli_user = "root";
$mysqli_password = "root";
$mysqli_database = "linkept";
$con = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password, $mysqli_database);
if (!$con) {
	echo "Database Connection failed!";
	exit();
}
function session_value($val)
{
	if ($val == "id") {
		$res = $_SESSION['id'];
	} elseif ($val == "NOM") {
		$res = $_SESSION['NOM'];
	}
	return $res;
}

function user_check($page)
{
	if ($page == "home") {
		if (length(session_value("login")) != '1') {
			header("location:  welcome.php");
		}
	}
	if ($page == "") {
		$ss = length(session_value("login"));
		if (length(session_value("login")) == '1') {
			header("location:  index.php?remark_login=failed");
		}
	}
}
function session_check($arg)
{
	if ($arg == "formaccess") {
		$x = $_SESSION['login_user'];
		$len = length($x);
		if ($len != "1") {
			header("location:  ./dashboard/index.php?remark=previous_session_error");
		}
	}
	if ($arg == "") {
		$_SESSION['user_id'] = "";
		session_start();
		if ($_SESSION['user_id'] == 0) {
			header("location:  ./index.php?goback");
		}
	}
}
function user_session()
{
	global $con, $prefix;
	session_start();
	if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
	} else {
		$x = substr(str_shuffle('23456789'), 0, 4);
		$_SESSION['user_id'] = $x;
	}
	if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
	} else {
		$x = substr(str_shuffle('ABCDEFRTOPICS23456789'), 0, 5);
		$_SESSION['username'] = "Guest_" . $x . "";
	}
	if (isset($_SESSION['login_user']) && $_SESSION['login_user'] != "") {
	} else {
		$x = substr(str_shuffle('abcdefrtopics23456789'), 0, 1);
		$_SESSION['login_user'] = $x;
	}
}

function length($get)
{
	$x = strlen($get);
	return $x;
}
function user_info($id, $value = "NOM")
{
	global $con;
	$sql = mysqli_query($con, "Select * from utilisateur where id='$id'");
	$row = mysqli_fetch_array($sql);
	if ($value == "NOM") {
		$rs = $row['NOM'];
	}
	if ($value == "PRENOM") {
		$rs = $row['PRENOM'];
	}
	if ($value == "STATUT") {
		$rs = $row['STATUT'];
	}
	if ($value == "DO") {
		$rs = $row['DO'];
	}
	if ($value == "ANNEE_ADH") {
		$rs = $row['ANNEE_ADH'];
	}
	if ($value == "image_check") {
		$rs = $row['image_url'];
	}
}
?>