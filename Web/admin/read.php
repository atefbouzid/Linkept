<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 6;
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM utilisateur ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM utilisateur')->fetchColumn();
?>
<?=template_header('Read')?>
<style>
    .read .create-contact {
    display: inline-block;
    text-decoration: none;
    background-color: #37afb7;
    font-weight: bold;
    font-size: 14px;
    color: #FFFFFF;
    padding: 10px 15px;
    margin: 15px 0;
}
.read .create-contact:hover {
    background-color: #0f565a;
}
    </style>
<div class="content read">
	<h2>Tous les utilisateurs</h2>
	<a href="create.php" class="create-contact">Créer un compte</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>CIN</td>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Statut</td>
                <td>Email</td>
                <td>Télephone</td>
                <td>Année d'admission</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $utilisateur): ?>
            <tr>
                <td><?=$utilisateur['id']?></td>
                <td><?=$utilisateur['CIN']?></td>
                <td><?=$utilisateur['NOM']?></td>
                <td><?=$utilisateur['PRENOM']?></td>
                <td><?=$utilisateur['STATUT']?></td>
                <td><?=$utilisateur['EMAIL']?></td>
                <td><?=$utilisateur['NUMTEL']?></td>
                <td><?= date('Y', strtotime($utilisateur["ANNEE_ADH"])) ?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$utilisateur['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$utilisateur['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>