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
$stmt = $pdo->prepare('SELECT * FROM estudos ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$estudos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of estudos, this is so we can determine whether there should be a next and previous button
$num_estudos = $pdo->query('SELECT COUNT(*) FROM estudos')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>estudos</h2>
	<a href="create.php" class="create-language">Create estudos</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Ensino</td>
                <td>data1</td>
                <td>local1</td>
                <td>texto1</td>


                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estudos as $estudo): ?>
            <tr>
                <td><?=$estudo['id']?></td>
                <td><?=$estudo['Ensino']?></td>
                <td><?=$estudo['data1']?></td>
                <td><?=$estudo['local1']?></td>
                <td><?=$estudo['texto1']?></td>

                <td class="actions">
                    <a href="update.php?id=<?=$estudo['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$estudo['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_estudos): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>