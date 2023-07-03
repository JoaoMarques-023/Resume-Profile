<?php
require "../../utils/functions.php";
require "../../db/connection.php";

// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 20;

// Prepare the SQL statement and get records from our id table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM skills ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of skills, this is so we can determine whether there should be a next and previous button
$num_skills = $pdo->query('SELECT COUNT(*) FROM skills')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Skills</h2>
	<a href="create.php" class="create-language">Create skills</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>nomeS</td>
                <td>valor</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($skills as $skill): ?>
            <tr>
                <td><?=$skill['id']?></td>
                <td><?=$skill['nomeS']?></td>
                <td><?=$skill['valor']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$skill['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$skill['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_skills): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>