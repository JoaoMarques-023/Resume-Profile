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
// Check if the contacto id exists, for example update.php?id=1 will get the contacto with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $email = isset($_POST['email']) ? $_POST['email'] : '';



    
    $telemovel = isset($_POST['telemovel']) ? $_POST['telemovel'] : '';
    
   
    $morada = isset($_POST['morada']) ? $_POST['morada'] : '';
   
            
    $aniversario = isset($_POST['aniversario']) ? $_POST['aniversario'] : '';





        // Update the record
        $stmt = $pdo->prepare('UPDATE contacto SET id = ?, email = ?, telemovel = ?,  morada = ?  ,aniversario = ? WHERE id = ?');
        $stmt->execute([$id, $email, $telemovel, $morada, $aniversario, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contacto from the contacto table
    $stmt = $pdo->prepare('SELECT * FROM contacto WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contacto = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contacto) {
        exit('contacto doesn\'t exist with that id!');
    }
} else {
    exit('No id specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update contacto #<?=$contacto['id']?></h2>
    <form action="update.php?id=<?=$contacto['id']?>" method="post">
   
       <i>
        <label for="id">id</label>        
        <input type="text" name="id" placeholder="1" value="<?=$contacto['id']?>" id="id">
        </i>
        
        <i>
        <label for="email">email</label>
        <input type="text" name="email" placeholder="email" value="<?=$contacto['email']?>" id="email">
        </i>
        
        
        <i>
        <label for="telemovel">telemovel</label>
        <input type="text" name="telemovel" placeholder="telemovel" value="<?=$contacto['telemovel']?>" id="telemovel">
        </i>

        
        <i>
        <label for="morada">morada</label>
        <input type="text" name="morada" placeholder="morada" value="<?=$contacto['morada']?>" id="morada">
        </i>

    <i>
        <label for="aniversario">aniversario</label>
        <input type="text" name="aniversario" placeholder="aniversario" value="<?=$contacto['aniversario']?>" id="aniversario">
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