<?php
require "../../utils/functions.php";
require "../../db/connection.php";
$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador != 'Admin'){
    header("location: ../skills/read.php");
    exit;
}
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the language id exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM skills WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $skill = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$skill) {
        exit('skill doesn\'t exist with that id!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM skills WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the skill!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No id specified!');
}
?>

<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete skill #<?=$skill['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete skill #<?=$skill['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$skill['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$skill['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>