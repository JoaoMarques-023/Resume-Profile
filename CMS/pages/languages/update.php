<?php
require "../../utils/functions.php";
require "../../db/connection.php";
$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador != 'Admin'){
    header("location: ../languages/read.php");
    exit;
}
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the languages numero exists, for example update.php?id=1 will get the languages with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $valor = isset($_POST['valor']) ? $_POST['valor'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE languages SET id = ?, nome = ?, valor = ? WHERE id = ?');
        $stmt->execute([$id, $nome, $valor, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the languages from the languages table
    $stmt = $pdo->prepare('SELECT * FROM languages WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $languages = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$languages) {
        exit('languages doesn\'t exist with that id!');
    }
} else {
    exit('No id specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update languages #<?=$languages['id']?></h2>
    <form action="update.php?id=<?=$languages['id']?>" method="post">
        
    <i><label for="id">id</label>        
        <input type="text" name="id" placeholder="1" value="<?=$languages['id']?>" id="id"></i>
    <i> <label for="nome">nome</label>
        <input type="text" name="nome" placeholder="nome" value="<?=$languages['nome']?>" id="nome"></i>
       
     <i> <label for="nome">valor</label>
        <input type="text" name="valor" placeholder="valor" value="<?=$languages['valor']?>" id="valor"></i>  
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>