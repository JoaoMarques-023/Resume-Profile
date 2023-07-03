<?php
function pdo_connect_mysql() {
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'id20107136_marques';
  $DATABASE_PASS = '|YH4veG$D-_3Zoj>';
  $DATABASE_NAME = 'id20107136_joao';
  try{
    return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);

  }catch (PDOException $exception) {
    echo "failed";
    exit('Failed to connect to database!');
  }
}
?>