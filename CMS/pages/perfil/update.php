<?php
require "../../utils/functions.php";
require "../../db/connection.php";
$tipoUtilizador = $_SESSION["tipo"];

if($tipoUtilizador != 'Admin'){
    header("location: ..//read.php");
    exit;
}
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the perfil numero exists, for example update.php?id=1 will get the perfil with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $nome2 = isset($_POST['nome2']) ? $_POST['nome2'] : '';
        $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE perfil SET id = ?, nome = ?, nome2 = ?, imagem = ? WHERE id = ?');
        $stmt->execute([$id, $nome, $nome2, $imagem, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the perfil from the perfil table
    $stmt = $pdo->prepare('SELECT * FROM perfil WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $perfil = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$perfil) {
        exit('perfil doesn\'t exist with that id!');
    }
} else {
    exit('No id specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update perfil #<?=$perfil['id']?></h2>
    <form action="update.php?id=<?=$perfil['id']?>" method="post">
      
        <i>
            <label for="id">id</label>        
        <input type="text" name="id" placeholder="1" value="<?=$perfil['id']?>" id="id">
        </i>

        <i>
            <label for="nome">nome</label>
            <input type="text" name="nome" placeholder="nome" value="<?=$perfil['nome']?>" id="nome">
        </i>
        
        <i>
            <label for="nome2">nome2</label>
            <input type="text" name="nome2" placeholder="nome2" value="<?=$perfil['nome2']?>" id="nome2">
        </i>

        <i>
        <label for="imagem">imagem</label>
            <input type="text" name="imagem" placeholder="imagem.jpg" value="<?=$perfil['imagem']?>" id="imagem">
        </i>

       <i>
                <input type="submit" value="Update">

       </i>
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>