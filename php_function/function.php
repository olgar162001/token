<?php
 include_once "connection/connection.php";

 function user_registration(){

    global $conn;
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $fullname=$_POST['fullname'];
    $phonenumber=$_POST['phonenumber'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
    
    if(empty($fullname)|| empty($phonenumber)|| empty($email)|| empty($password)|| empty($confirmpassword)){
        header('location:register.php?error=1');
    }elseif($password==$confirmpassword){

    $sql="INSERT INTO user(Full_Name,Phone_Number,User_Email,User_Password) VALUES ('$fullname',
    '$phonenumber','$email','$password')";
    $result = mysqli_query($conn,$sql);

    if($result){
        //echo "data is submited successfully..!";
        header('location:login.php');
    }
}else{
    header('location:register.php?error=2');
}
}

}

function user_authentication(){
    global $conn;
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $email=$_POST['email'];
    $password=$_POST['password'];   
    if(empty($email)||empty($password)){
        header('location:login.php?result=empty');
    }else{
        $sql="SELECT * FROM user WHERE User_Email = '$email' AND User_Password = '$password'";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)==1){
            while($row=mysqli_fetch_assoc($result)){  
            $_SESSION['auth']=true;
            $_SESSION['name']=$row['First_Name'];
            $_SESSION['userid']=$row['User_Id'];
            $_SESSION['usercategory']=$row['User_Category'];
            $data=array();
            
            $data['name']=$row['First_Name'];
            $data['UserId']=$_SESSION['auth'];
            
            }
            header('location:../index.php');
        }else{
            header('location:login.php?error=1');
        }
    }
}
}

function patient_registration(){

    global $conn;
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $fullname=$_POST['fullname'];
        $phonenumber=$_POST['phonenumber'];
        $email=$_POST['email'];
        $service=$_POST['service'];
        
        
        if(empty($fullname)|| empty($phonenumber)|| empty($email)|| empty($service)){
            echo'2'; 
        }else{
    
        $sql="INSERT INTO patient(Full_Name,Phone_Number,Patient_Email,Patient_Service) VALUES ('$fullname',
        '$phonenumber','$email','$service')";
        $result = mysqli_query($conn,$sql);
    
        if($result){
            echo '1';
        }
    }
    }
}

function view_patient(){
    global $conn;

    $sql="SELECT * FROM patient";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $sn=1;
        ?>
        
      <h1 class="text-center" >Patient Information</h1>
        <div class="containe p-3">
        <table class="table table-striped p-3">
    <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Service</th>
        <th>Token Number</th>
    </tr>
    <?php
        while($row=mysqli_fetch_assoc($result)){
?>
            <tr>
            <td><?php echo $sn?></td>
            <td><?php echo $row['Full_Name']?></td>
            <td><?php echo $row['Phone_Number']?></td>
            <td><?php echo $row['Patient_Email']?></td>
            <td><?php echo $row['Patient_Service']?></td>
            <td><?php echo $row['Patient_Token']?></td>
    </tr>
     <?php    
    $sn++; 

        }
            

    } else{
        echo "No result was found";
    }
}

function generate_token(){
    global $conn;

    $sql="SELECT * FROM patient WHERE Patient_Token=0";
  
    
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $sn=1;
        ?>
        
      <h1 class="text-center" >Patient Information</h1>
        <div class="containe p-3">
        <table class="table table-striped p-3">
    <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Service</th>
        <th>Generate Token</th>
    </tr>
    <?php
        while($row=mysqli_fetch_assoc($result)){
?>
            <tr>
            <td><?php echo $sn?></td>
            <td><?php echo $row['Full_Name']?></td>
            <td><?php echo $row['Phone_Number']?></td>
            <td><?php echo $row['Patient_Email']?></td>
            <td><?php echo $row['Patient_Service']?></td>
            <td><a href='#' class='btn btn-dark' onclick='token_generation(<?php echo $row["Patient_Id"]?>)' id='buy' >Generate Token</a></td>
    </tr>
     <?php    
    $sn++; 

        }
            

    } else{
        echo "No result was found";
    }
}

function token_generation(){
   
    function token(){
        $lastToken = intval(getLastToken());

        // Increment the last token by 1 to generate the next token
        $nextToken = $lastToken + 1;
    
        // Save the next token as the last generated token in the database or file
        saveLastToken($nextToken);
    
        // Return the next token
        return $nextToken;
    
    }

    function  saveLastToken($token){
        global $conn; 

         $patient_id=$_GET['patientid'];

         file_put_contents('php_function/last_token.txt', $token);

         $sql="UPDATE patient SET Patient_Token = $token WHERE Patient_Id = $patient_id";
         $result = mysqli_query($conn,$sql);
     

    
    }

    function getlasttoken(){
        $lastToken = file_get_contents('php_function/last_token.txt');

        return $lastToken;
        
    }
   
    return token();
}
