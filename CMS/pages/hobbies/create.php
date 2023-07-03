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
    header("location: ../hobbies/read.php");
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
    $nome1 = isset($_POST['nome1']) ? $_POST['nome1'] : '';
    $nome2= isset($_POST['nome2']) ? $_POST['nome2'] : '';
    $nome3 = isset($_POST['nome3']) ? $_POST['nome3'] : '';

    // Insert new record into the languages table

    $stmt = $pdo->prepare('INSERT INTO hobbies VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $nome1, $nome2, $nome3]);
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
    
    <i> <label for="nome1">nome1</label>
        <input type="text" name="nome1" placeholder="nome1" id="nome1">
    </i>
    <i> <label for="nome1">nome2</label>
        <input type="text" name="nome2" placeholder="nome2" id="nome2">
    </i>
    <i> <label for="nome1">nome3</label>
        <input type="text" name="nome3" placeholder="nome3" id="nome3">
    </i>  
       
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>