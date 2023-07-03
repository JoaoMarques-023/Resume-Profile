<!doctype html>
<html lang="en">

<head>
  <title>DB (CRUD) | demo</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Demonstrações da aula">
  <meta name="author" content="José Viana">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

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
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $texto = isset($_POST['texto']) ? $_POST['texto'] : '';


    // Insert new record into the  table
    $stmt = $pdo->prepare('INSERT INTO sobreMim VALUES (?, ?)');
    $stmt->execute([$id, $texto]);
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

        <i> <label for="texto">texto</label>
        <input type="text" name="texto" placeholder="texto" id="texto">
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