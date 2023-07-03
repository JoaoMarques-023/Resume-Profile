<!doctype html>
<html lang="en">


<?php
require "../../utils/functions.php";
require "../../db/connection.php";

$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador != 'Admin'){
    header("location: ../estudos/read.php");
    exit;
}

$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $Ensino = isset($_POST['Ensino']) ? $_POST['Ensino'] : '';

    $data1 = isset($_POST['data1']) ? $_POST['data1'] : '';

    $local1 = isset($_POST['local1']) ? $_POST['local1'] : '';

    $texto1 = isset($_POST['texto1']) ? $_POST['texto1'] : '';

    // Insert new record into the languages table
    $stmt = $pdo->prepare('INSERT INTO estudos VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $Ensino, $data1, $local1, $texto1]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create users</h2>

    <form action="create.php" method="post">
        
        <i>
             <label for="id">id</label>
            <input type="text" name="id" placeholder="26" value="auto" id="id">
        </i>
       
       <i>
            <label for="Ensino">Ensino</label>
            <input type="text" name="Ensino" placeholder="Ensino" id="Ensino">
       </i> 
        
        <i>
            <label for="data1">data1</label>
            <input type="text" name="data1" placeholder="data1" id="data1">
        </i>
        
        <i> 
            <label for="local1">local1</label>
            <input type="text" name="local1" placeholder="local1" id="local1">
        </i>
       
        <i>
             <label for="texto1">texto1</label>
             <input type="text" name="texto1" placeholder="texto1" id="texto1">
        </i>
       
        <input type="submit" value="Create">

    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>