<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     
     <?php
     include_once('../php_function/connection/connection.php');
    include_once("../partials/header.php");
    if(isset($_SESSION['auth'])){

        header('location:../index.php');
    }else{
    ?>

    
    <div class="form-container">
        <form action="signup.php" method="post" class="myform  ">
            <h2 class="form-title">Signup </h2>

            <?php if(isset($_GET['error'])){
     $msg2=$_GET['error'];    
      if($msg2=='1'){
        ?>
    <div class="alert alert-danger  text-center">All field are required..!!</div>
    
<?php }else{
    ?>
    <div class="alert alert-danger  text-center">Password Mismatch..!!</div>
    <?php
}
} }?>

            <div class="form-group ">
                <input type="txt" class="form-control" name="fullname" placeholder="Full Name" >
            </div>

            <div class="form-group ">
                <input type="txt" class="form-control" name="phonenumber" placeholder="Phone Number" >
            </div>
    
            
            <div class="form-group ">
                <input type="email" class="form-control" name="email" placeholder="Email" id="email">
            </div>
    
            <div class="form-group ">
                <input type="password" class="form-control" name="password" placeholder="Password" id="password">
            </div>

            <div class="form-group ">
                <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" id="password">
            </div>
        
            <div class="form-group">
            <input type="submit" class="button" name="submit" value="Signup">
            </div>
</form>
</div>
        
</body>

</html>
