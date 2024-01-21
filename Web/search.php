<?php
session_start();

include('function.php');
include('nav.php');

?>
<?= template_header('search') ?>

<meta content='text/html;  charset=UTF-8' http-equiv='Content-Type' />
<link rel="stylesheet" type="text/css" href="/Linkept/CSS/custom.css" />

<link rel="stylesheet" type="text/css" href="/Linkept/CSS/search1.css" />
<link href="/Linkept/CSS/search.css" rel="stylesheet" />

<script src="asset/js/jquery.2.1.3.min.js" type="text/javascript"> </script>
<script src="script.js" type="text/javascript"> </script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link href="/Linkept/CSS/search2.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<style>
	.tp-contentwrap2 {
    width: 100%;
    float: left;
    border: 1px solid #2574A9;
    height: 280px;
    background: #65799b;
}
.table-wrapper .btn.btn-primary {
    color: #fff;
    background: #65799b;
}
	</style>
<div class="tp-contentbox">

	<?php
	$id = session_value("id");
	$user = "";
	if (isset($_POST['user'])) {
		$user = $_POST['user'];
	}
	$sql = "SELECT  *  FROM  utilisateur  WHERE NOM LIKE '%$user%' or PRENOM LIKE '%$user%'";
	$result = mysqli_query($con, $sql);
	?>
	<div class="tp-contentwrap2">
		<div class="container-xl">
			<div class="table-responsive">
				<div class="table-wrapper">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-4">
								<h5>Vous avez recherché " <?php echo $user; ?>  "</h5>
							</div>
							<div class="col-sm-8">

							</div>
						</div>
					</div>
					<div class="table-filter">
						<div class="row">
							<div class="col-sm-8">
								<div class="show-entries">
									<div class="filter-group">
										<form action="search.php" method="post">
											<input type="text" name="user" placeholder="Rechercher.." />
											<input type="submit" class="btn btn-primary" name="submit" value="Rechercher" />
										</form>
									</div>
								</div>
							</div>
							
						</div>



						<table id="myTable" class="table table-striped table-hover">

							<tbody>
								<?php
								if ($result->num_rows > 0) {
									echo '<table class="table table-striped table-hover">';
									echo ' <thead>
							<tr>
								<th>Nom</th>
								<th>Prénom</th>
								<th>STATUT</th>
								<th>Département/Option</th>
								<th>Profil</th>
							</tr>
						</thead>';
									echo '<tbody>';
									while ($row = $result->fetch_assoc()) {
										echo '<tr>';
										echo '<td>' . $row['NOM'] . '</td>';
										echo '<td>' . $row['PRENOM'] . '</td>';
										echo '<td>' . $row['STATUT'] . '</td>';
										echo '<td>' . $row['DO'] . '</td>';
										echo '<td><a href="profileSearch.php?id=' . $row['id'] . '" target="_blank"><i class="fa-solid fa-eye"></i></a></td>';
										echo '</tr>';
									}
									echo '</tbody></table>';
								} else {
									echo '<p>No results found.</p>';
								}
								?>
								<table>
									<?php
									while ($rows = mysqli_fetch_array($result)) {
										$id = $rows['id'];
										?>
										<tr>
											<td class="td_1">
												<?php $image = user_info($id, "image_thumb"); ?>
												<a href="profileSearch.php?id=<?php echo $id; ?>" target="_blank"><img
														src="<?php echo $image; ?>" width="50px" /></a>
											</td>
											<td class="left"><a href="profileSearch.php?id=<?php echo $id; ?>"
													target="_blank"><?php echo $rows['NOM']; ?></a></td>
										</tr>
										<?php
									}
									?>
								</table>
					</div>
				</div>
			</div>
		</div>