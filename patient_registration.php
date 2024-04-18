<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     
   

    
    <div class="patientform-container">
        <form  method="post" class="form" id="patient">
            <h2 class="form-title">Patient </h2>

        

            <div class="form-group ">
                <input type="txt" class="form-control" name="fullname" placeholder="Full Name" >
            </div>

            <div class="form-group mt-2">
                <input type="txt" class="form-control" name="phonenumber" placeholder="Phone Number" >
            </div>
    
            
            <div class="form-group mt-2">
                <input type="email" class="form-control" name="email" placeholder="Email" id="email">
            </div>
    
           <div class="form-group mt-2" >
                <select  class="form-control" name="service">               
                    <option value="doctor">doctor</option>    
                </select>
           </div>
        
            <div class="form-group mt-2">
            <a  class="btn btn-success" id="btn" onclick="patient_registration()" >submit</a>
            </div>
</form>
</div>
        
</body>

</html>
