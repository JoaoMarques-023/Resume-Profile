<?php
include './CMS/db/connection.php';


$pdo =  pdo_connect_mysql();
?>
<?php

$stmt = $pdo->prepare('SELECT * FROM languages ORDER BY id');
$stmt->execute();
// Fetch the records so we can display them in our template.
$languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of languages, this is so we can determine whether there should be a next and previous button
$num_languages = $pdo->query('SELECT COUNT(*) FROM languages')->fetchColumn();



$stmt = $pdo->prepare('SELECT * FROM hobbies ORDER BY id');
$stmt->execute();
// Fetch the records so we can display them in our template.
$hobbies = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of languages, this is so we can determine whether there should be a next and previous button
$num_hobbies = $pdo->query('SELECT COUNT(*) FROM hobbies')->fetchColumn();



$stmt = $pdo->prepare('SELECT * FROM experiencia ORDER BY id');
$stmt->execute();
// Fetch the records so we can display them in our template.
$experiencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of languages, this is so we can determine whether there should be a next and previous button
$num_experiencias = $pdo->query('SELECT COUNT(*) FROM experiencia')->fetchColumn();



$stmt = $pdo->prepare('SELECT * FROM estudos ORDER BY id');
$stmt->execute();
// Fetch the records so we can display them in our template.
$estudos = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of languages, this is so we can determine whether there should be a next and previous button
$num_estudos = $pdo->query('SELECT COUNT(*) FROM estudos')->fetchColumn();


$stmt = $pdo->prepare('SELECT * FROM contacto ORDER BY id');
$stmt->execute();
// Fetch the records so we can display them in our template.
$contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of languages, this is so we can determine whether there should be a next and previous button
$num_contactos = $pdo->query('SELECT COUNT(*) FROM contacto')->fetchColumn();

$stmt = $pdo->prepare('SELECT * FROM skills ORDER BY id');
$stmt->execute();
// Fetch the records so we can display them in our template.
$skills = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of languages, this is so we can determine whether there should be a next and previous button
$num_skills = $pdo->query('SELECT COUNT(*) FROM skills')->fetchColumn();




$stmt = $pdo->prepare('SELECT * FROM sobremim ORDER BY id');
$stmt->execute();
// Fetch the records so we can display them in our template.
$sobreMims = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of languages, this is so we can determine whether there should be a next and previous button
$num_sobreMims = $pdo->query('SELECT COUNT(*) FROM sobremim')->fetchColumn();




$stmt = $pdo->prepare('SELECT * FROM perfil ORDER BY id');
$stmt->execute();
// Fetch the records so we can display them in our template.
$perfils = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of languages, this is so we can determine whether there should be a next and previous button
$num_perfilss = $pdo->query('SELECT COUNT(*) FROM perfil')->fetchColumn();





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Profissional</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;600&family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <a href=./CMS/auth/login.php>Ir dashboard</a>


</head>
<body>
    <main class="main-content">
        <section class="left-section">
           <div class="left-content">
            <div class="profile">
           
            <?php foreach ($perfils as $perfil) :?>


                <div class="image">
                    <img src="imagem/<?=$perfil['imagem']?>" alt="">
                </div>
                <h2 class="nome"> <?=$perfil['nome']?>
                    </h2>
                <p class="carreira"> <?=$perfil['nome2']?></p>
                
                <?php endforeach ?>

            </div>
            <div class="contacto-info">

                <h3 class="main-title">Contacto</h3>

                <?php foreach ($contactos as $contacto) :?>
                  
                    
                     <ul>  
                        
                     <li>
                     <i class="fa-regular fa-envelope"></i>                        
                     <?=$contacto['email']?>
                    </li>

                        <li>
                         <i class="fa fa-phone"></i>
                         <?=$contacto['telemovel']?>
                    </li>
                  

                    <li>
                    <i class="fa fa-map-marker"></i>
                        <?=$contacto['morada']?>
                    </li>
                    <li>
                        <i class="fa-solid fa-cake-candles"></i>
                        <?=$contacto['aniversario']?>
                    </li>
                 
                  




                </ul>
                    
                    <?php endforeach ?>
               
            </div>
           
            <div class="skills-section">
                <h3 class="main-title">skills</h3>

                <?php foreach ($skills as $skill) :?>
                    <ul>
                    <li>
                        <p class="skill-title"><?=$skill['nomeS']?></p>
                        <p class="skill-title"><?=$skill['valor']?></p>

                    </li>
                </ul>
                    <?php endforeach ?>


                
            </div>

   
            
            <div class="linguas-section">

                <h3 class="main-title">Linguas</h3>
                <ul>


                        <?php foreach ($languages as $language) :?>
                    <li>
                        <p class="linguas-title"><?=$language['nome']?> </p>
                        <p class="linguas-title"><?=$language['valor']?> </p>

                    </li>
                    <?php endforeach ?>
                     

                </ul>
                
            </div>

          </div>
        </section>
  
        <section class="right-section">
            <div class="right-main-content">
                <section class="about sect">
                    <h2 class="right-title">Sobre mim</h2>

                    <?php foreach ($sobreMims as $sobreMim) :?>

                    <p class="para">

                    <?=$sobreMim['texto']?>
                       
                    </p>
                    <?php endforeach ?>

                </section>
                
                <section class="experiencia"> 
                    <h2 class="right-title"> Estudos</h2>
                    <div class="timeline">


                    <?php foreach ($estudos as $estudo) :?>
                        <div class="left-tl-content">
                            <h5 class="tl-title"><?=$estudo['local1']?></h5>
                            <p class="para"><?=$estudo['data1']?></p>

                            
                        </div>
                        <div class="right-tl-content">
                            <div class="tl-content">
                                <h5 class="tl-title-2"><?=$estudo['Ensino']?></h5>
                               
                                           
                               <p class="para"><?=$estudo['texto1']?></p>
                            </div>
                        </div>       
                    <?php endforeach ?>


                    </div>
                   
                </section>

                <section class="educacao sect"> 
                    <h2 class="right-title"> Experiência</h2>
                    <div class="timeline">

                    <?php foreach ($experiencias as $experiencia) :?>
                      <div class="left-tl-content">
                            <h5 class="tl-title"><?=$experiencia['local1']?></h5>
                            <p class="para"><?=$experiencia['data1']?></p>
                        </div>
                        <div class="right-tl-content">
                            <div class="tl-content">
                                <h5 class="tl-title-2"> <?=$experiencia['Ensino']?></h5>
                               <p class="para">
                               <?=$experiencia['texto1']?>
                            </p>
                               
                            </div>
                        </div>
                    <?php endforeach ?>

                     
                    

                    </div>    

                </section>

                <section class="interest">
                    <h3 class="title">Hobbies</h3>



                    
                     <div class="interest_items">
                                                   
                       
                       
                        <?php foreach ($hobbies as $hobbie) :?>
                 
                          


                          <div class="interest_item">

                        <i data-feather="music"></i>
                        <i><span><?=$hobbie['nome1']?></span></i>                          
                      
                        </div>

                       
                        <div class="interest_item">
                            <i data-feather="book"></i>
                            <i><span><?=$hobbie['nome2']?></span></i>                          
                       </div>
            

                            <div class="interest_item">
                            <i data-feather="film"></i>
                            <i><span><?=$hobbie['nome3']?></span></i>                          
                            </div>

                          
                          

                          <?php endforeach ?>
                               
                        
                      
                     </div>
                </section>

                <section class="contact">
                        <div class="contact-form">
                            <h1>Envie um Email</h1>
                            <P>
                                Escreva a sua mensagem 
                            </P>
                                <form action="">
                                    <input type="" placeholder="Digite o seu nome" required>

                                    <input type="email" name="email" id="" placeholder="Email" required>
                                    
                                    <input type="" placeholder="Assunto" required>
                                    
                                    <textarea name="" id="" cols="30" rows="10" placeholder="A sua mensagem">
                                    
                                </textarea>
                                
                                <input type="submit" name="" value="Enviar" class="btn"> 
                                
                            </form>
                        </div>
                </section>

            </div>
        </section>

    </main>
    <script>
        feather.replace()
    </script>
</body>
</html>


