
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
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nomeS = isset($_POST['nomeS']) ? $_POST['nomeS'] : '';
    $valor = isset($_POST['valor']) ? $_POST['valor'] : '';
    // Insert new record into the languages table
    $stmt = $pdo->prepare('INSERT INTO skills VALUES (?, ?, ?)');
    $stmt->execute([$id, $nomeS, $valor]);
    // Output message
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Create users</h2>
    <form action="create.php" method="post">

    <i><label for="id">id</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id"></i>
<i>   <label for="nomeS">nomeS</label>
        <input type="text" name="nomeS" placeholder="nomeS" id="nomeS"></i>
        <i>  <label for="valor">valor</label>
        <input type="text" name="valor" placeholder="Conta" id="valor"></i>
     
      
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>