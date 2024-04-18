<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="../asset/Bootstrap/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../asset/fonts/css/all.css">
    <link rel="stylesheet" href="../resources/CSS/style.css">
    <script src="../Resources/JS/script.js"></script>
    <script src="../Resources/JS/jquery.js"></script>
    </head>
    <body> 
    
        <div class="container-xxl bg-white p-0">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0 " id="nav-bar"  >
      
            
               <a href="#" class="navbar-brand p-0">
                    <h1 class=" m-0"><i class="fa fa-hospital me-3"></i>Mt. Meru Hospital</h1>
                    
                    </a>
               
             
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mt-4" id="navmenu">
            <div class="navbar-nav ms-auto py-0 pe-4">
     <?php     
    
    if(isset($_SESSION['auth'])){
        ?>
        <a href="<?php //echo baseUrl;?>../auth/logout.php" class="nav-item nav-link">Logout</a>
        <?php
    }else{
        ?>                     
                         <a href="<?php //echo baseUrl;?>../auth/login.php" class="nav-item nav-link">Login</a>
                        <a href="<?php // echo baseUrl;?>../auth/register.php" class="nav-item nav-link">Register</a>
                        
                
                <?php }?>
            </div>
        </div>
        
     </nav>


            