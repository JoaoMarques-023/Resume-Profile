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
// Check if the skills numero exists, for example update.php?id=1 will get the skills with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nomeS = isset($_POST['nomeS']) ? $_POST['nomeS'] : '';
        $valor = isset($_POST['valor']) ? $_POST['valor'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE skills SET id = ?, nomeS = ?, valor = ? WHERE id = ?');
        $stmt->execute([$id, $nomeS, $valor, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the skills from the skills table
    $stmt = $pdo->prepare('SELECT * FROM skills WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $skills = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$skills) {
        exit('skills doesn\'t exist with that id!');
    }
} else {
    exit('No id specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update skills #<?=$skills['id']?></h2>
    <form action="update.php?id=<?=$skills['id']?>" method="post">
        <label for="id">id</label>        
        <input type="text" name="id" placeholder="1" value="<?=$skills['id']?>" id="id">
        <label for="nomeS">nomeS</label>
        <input type="text" name="nomeS" placeholder="nomeS" value="<?=$skills['nomeS']?>" id="nomeS">
        <label for="nomeS">valor</label>
        <input type="text" name="valor" placeholder="valor" value="<?=$skills['valor']?>" id="valor">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>