
<?php
require "../../utils/functions.php";
require "../../db/connection.php";
$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador != 'Admin'){
    header("location: ../perfil/read.php");
    exit;
}
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';

    $nome2 = isset($_POST['nome2']) ? $_POST['nome2'] : '';


    $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : '';

    // Insert new record into the imagem table
    $stmt = $pdo->prepare('INSERT INTO perfil VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $nome, $nome2, $imagem]);
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

    <i> <label for="nome">nome</label>
        <input type="text" name="nome" placeholder="nome" id="nome">
    </i>
    

    <i> <label for="nome2">nome2</label>
        <input type="text" name="nome2" placeholder="nome2" id="nome2">
    </i>   

    <i> <label for="imagem">imagem</label>
        <input type="text" name="imagem" placeholder="imagem.jpg" id="imagem">
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