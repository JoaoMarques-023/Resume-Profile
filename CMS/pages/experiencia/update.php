<?php
require "../../utils/functions.php";
require "../../db/connection.php";


$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador != 'Admin'){
    header("location: ../experiencia/read.php");
    exit;
}

$pdo = pdo_connect_mysql();
$msg = '';
// Check if the num_experiencia numero exists, for example update.php?id=1 will get the num_experiencias with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;

        $Ensino = isset($_POST['Ensino']) ? $_POST['Ensino'] : '';
    
        $data1 = isset($_POST['data1']) ? $_POST['data1'] : '';
    
        $local1 = isset($_POST['local1']) ? $_POST['local1'] : '';
    
        $texto1 = isset($_POST['texto1']) ? $_POST['texto1'] : '';



        // Update the record
        $stmt = $pdo->prepare('UPDATE experiencia SET id = ?, Ensino = ?, data1 = ?,local1 = ?,texto1 = ? WHERE id = ?');
        $stmt->execute([$id, $Ensino, $data1, $local1, $texto1, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the experiencia from the experiencia table
    $stmt = $pdo->prepare('SELECT * FROM experiencia WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $experiencia = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$experiencia) {
        exit('experiencia doesn\'t exist with that id!');
    }
} else {
    exit('No id specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	
<h2>Update experiencia #<?=$experiencia['id']?></h2>
    
<form action="update.php?id=<?=$experiencia['id']?>" method="post">
        
    
    <i>
        <label for="id">id</label>        
        <input type="text" name="id" placeholder="1" value="<?=$experiencia['id']?>" id="id">
    </i>
       
    <i>
        <label for="Ensino">Ensino</label>
        <input type="text" name="Ensino" placeholder="Ensino" value="<?=$experiencia['Ensino']?>" id="Ensino">
    </i>  
               
    <i>
        <label for="data1">data1</label>
        <input type="text" name="data1" placeholder="data1" value="<?=$experiencia['data1']?>" id="data1">
    </i>
        
    <i>
        <label for="local1">local1</label>
        <input type="text" name="local1" placeholder="local1" value="<?=$experiencia['local1']?>" id="local1">
    </i>
        
    <i> 
        <label for="texto1">texto1</label>
        <input type="text" name="texto1" placeholder="texto1" value="<?=$experiencia['texto1']?>" id="texto1">
    </i>
       

        <input type="submit" value="Update">

    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>