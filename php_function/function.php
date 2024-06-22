<?php
 include_once "connection/connection.php";

 // import namespaces into current file. 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



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
`
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
         //function to generate token
            $token=token_generation();
    
        $sql="INSERT INTO patient(Full_Name,Phone_Number,Patient_Email,Patient_Service,Patient_Token) VALUES ('$fullname',
        '$phonenumber','$email','$service','$token')";
        $result = mysqli_query($conn,$sql);
    
        if($result){
            $notificationMessage="Dear $fullname, your token is  $token please becarefully inorder to know when its your your time to get service.";
            sendEmailNotification($email, $notificationMessage , $fullname); 
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

/*function generate_token(){
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
}*/

function token_generation(){
   
    function token(){
        $lastToken = intval(getLastToken());

        // Increment the last token by 1 to generate the next token
        $nextToken = $lastToken + 1;
    
        // Save the next token as the last generated token in the file
        saveLastToken($nextToken);
    
        // Return the next token
        return $nextToken;
    
    }

    function  saveLastToken($token){
        global $conn; 

         //$patient_id=$_GET['patientid'];

         file_put_contents('php_function/last_token.txt', $token);

        // $sql="UPDATE patient SET Patient_Token = $token WHERE Patient_Id = $patient_id";
         //$result = mysqli_query($conn,$sql);
     

    
    }

    function getlasttoken(){
        $lastToken = file_get_contents('php_function/last_token.txt');

        return $lastToken;
        
    }
   
    return token();
}

function createAppointement(){
    global $conn;
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $Full_Name=$_POST['fullname'];
        $Patient_Phonenumber=$_POST['phonenumber'];
        $Patient_Email=$_POST['email'];
        $Appointement_Date=$_POST['date'];
        $Appointement_Time=$_POST['time'];
        $Appointement_Description=$_POST['description'];
        
        
        if(empty($Full_Name)|| empty($Patient_Phonenumber)|| empty($Patient_Email)|| empty( $Appointement_Date)|| empty( $Appointement_Time)|| empty( $Appointement_Description)){
            echo'2'; 
        }else{
    
        $sql="INSERT INTO appointement(Full_Name,Patient_PhoneNumber,Patient_Email,Appointement_Date,Appointement_Time,Appointement_Descriptions) VALUES ('$Full_Name',
        '$Patient_Phonenumber','$Patient_Email','$Appointement_Date','$Appointement_Time','$Appointement_Description')";
        $result = mysqli_query($conn,$sql);
    
        if($result){
            echo "<h2>Appointment Scheduled Successfully</h2>";
            echo "Name: " . $Full_Name . "<br>";
            echo "Email: " . $Patient_Email . "<br>";
            echo "Phone: " . $Patient_Phonenumber . "<br>";
            echo "Date: " . $Appointement_Date . "<br>";
            echo "Time: " . $Appointement_Time . "<br>";

            $notificationMessage=$notificationMessage = "Dear $Full_Name, your appointment is successfully created and is scheduled for $Appointement_Date at $Appointement_Time. Please remember to attend.";

            sendEmailNotification($Patient_Email, $notificationMessage , $Full_Name);   

        }
    }
    }
}

function Sendnotification(){
    global $conn;
    

// Prepare SQL statement to retrieve upcoming appointments
$sql = "SELECT Appointement_Id, Full_Name,Patient_PhoneNumber,Patient_Email, Appointement_Date, Appointement_Time FROM appointement WHERE Appointement_Date = CURDATE()";
$result = $conn->query($sql);

// Check if there are any upcoming appointments
if ($result->num_rows > 0) {
    // Loop through each appointment
    while ($row = $result->fetch_assoc()) {
        // Process each appointment
        $appointmentId = $row['Appointement_Id'];
        $patientName = $row['Full_Name'];
        $appointmentDate = $row['Appointement_Date'];
        $appointmentTime = $row['Appointement_Time'];
        $patientEmail=$row['Patient_Email'];

        // Generate notification message
        $notificationMessage = "Dear $patientName, your appointment is scheduled for $appointmentDate at $appointmentTime. Please remember to attend.";

        // Send notification (implementation of this step depends on the method of notification delivery)
       sendEmailNotification($patientEmail, $notificationMessage , $patientName);
        // Example: sendSMSNotification($patientPhoneNumber, $notificationMessage);
    }
} else {
    echo "No upcoming appointments.";
}

// Close connection
$conn->close();



}

// Function to send email notification
function sendEmailNotification($email, $message,$name) {
// initializing the mailer. 
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'olgar162001@gmail.com';
    $mail->Password = 'oryd ktxj teby pdsv';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('olgar162001@gmail.com', 'Hospital Token');
    $mail->addAddress($email, $name);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Appointment Reminder';
    $mail->Body = $message;
    //$mail->AltBody = "Dear $name,\n\nThis is a reminder for your appointment today at $appointment_time.\n\nThank you,\nHospital";

    $mail->send();
    echo "Reminder sent to $email<br>";
} catch (Exception $e) {
    echo "Reminder could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
}
 }
 

// Function to send SMS notification
function sendSMSNotification($phoneNumber, $message) {
    
}

?>  