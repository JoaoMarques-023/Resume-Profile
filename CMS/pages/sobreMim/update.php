<?php
require "../../utils/functions.php";
require "../../db/connection.php";
$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador != 'Admin'){
    header("location: ../sobremim/read.php");
    exit;
}
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the sobreMim numero exists, for example update.php?id=1 will get the sobreMim with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $texto = isset($_POST['texto']) ? $_POST['texto'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE sobremim SET id = ?, texto = ? WHERE id = ?');
        $stmt->execute([$id, $texto, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the sobreMim from the sobreMim table
    $stmt = $pdo->prepare('SELECT * FROM sobremim WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $sobreMim = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$sobreMim) {
        exit('sobreMim doesn\'t exist with that id!');
    }
} else {
    exit('No id specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update sobreMim #<?=$sobreMim['id']?></h2>
    <form action="update.php?id=<?=$sobreMim['id']?>" method="post">
      
        <i>
            <label for="id">id</label>        
        <input type="text" name="id" placeholder="1" value="<?=$sobreMim['id']?>" id="id">
        </i>

        <i>
            <label for="texto">texto</label>
            <input type="text" name="texto" placeholder="texto" value="<?=$sobreMim['texto']?>" id="texto">
        </i>

      
       
                <input type="submit" value="Update">

       </i>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>