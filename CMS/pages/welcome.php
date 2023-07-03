<?php 


session_start();  
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../auth/login.php");
        exit;
    }
    $username = $_SESSION["username"];

?>


    <!DOCTYPE html>
<html>
<body>
<h1> Bem vindo ao Perfil <?php echo $username ?></h1>
<p>My first paragraph.</p>
</body>
</html>