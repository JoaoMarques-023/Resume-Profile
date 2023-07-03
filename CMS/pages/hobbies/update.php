<?php
require "../../utils/functions.php";
require "../../db/connection.php";
$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador != 'Admin'){
    header("location: ../hobbies/read.php");
    exit;
}
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contacto id exists, for example update.php?id=1 will get the contacto with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
       

        // Update the record
        $stmt = $pdo->prepare('UPDATE hobbies SET id = ?, nome1 = ?, nome2 = ?, nome3 = ? WHERE id = ?');
        $stmt->execute([$id, $nome, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contacto from the contacto table
    $stmt = $pdo->prepare('SELECT * FROM hobbies WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $hobbies = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$hobbies) {
        exit('hobbies doesn\'t exist with that id!');
    }
} else {
    exit('No id specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update hobbies #<?=$hobbies['id']?></h2>
    <form action="update.php?id=<?=$hobbies['id']?>" method="post">
    
    
    <i><label for="id">id</label>        
        <input type="text" name="id" placeholder="1" value="<?=$hobbies['id']?>" id="id"></i>
   
        <i><label for="nome1">nome1</label>
        <input type="text" name="nome1" placeholder="nome1" value="<?=$hobbies['nome1']?>" id="nome1"></i>
  
        <i><label for="nome2">nome</label>
        <input type="text" name="nome2" placeholder="nome2" value="<?=$hobbies['nome2']?>" id="nome2"></i>
    
        <i><label for="nom3">nome</label>
        <input type="text" name="nome3" placeholder="nome3" value="<?=$hobbies['nome3']?>" id="nome3"></i>
       
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>