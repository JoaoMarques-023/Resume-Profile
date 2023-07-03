

<?php
require "../../utils/functions.php";
require "../../db/connection.php";

$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador != 'Admin'){
    header("location: ../contacto/read.php");
    exit;
}


$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
       $email = isset($_POST['email']) ? $_POST['email'] : '';

    
    $telemovel = isset($_POST['telemovel']) ? $_POST['telemovel'] : '';
    
   
    $morada = isset($_POST['morada']) ? $_POST['morada'] : '';
   
    $aniversario = isset($_POST['aniversario']) ? $_POST['aniversario'] : '';

    
    
    
    // Insert new record into the languages table
    $stmt = $pdo->prepare('INSERT INTO contacto VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $email, $telemovel, $morada, $aniversario]);
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
        <label for="email">email</label>
        <input type="text" name="email" placeholder="email" id="email">
        </i>
 <i>   
        <label for="telemovel">telemovel</label>
        <input type="text" name="telemovel" placeholder="telemovel" id="telemovel">
        </i>

        <i>   
        <label for="morada">morada</label>
        <input type="text" name="morada" placeholder="morada" id="morada">
        </i>
  <i>   
        <label for="aniversario">aniversario</label>
        <input type="text" name="aniversario" placeholder="aniversario" id="aniversario">
        </i>
        <i>   
        <input type="submit" value="Create">
        </i>

    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>