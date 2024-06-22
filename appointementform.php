<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="patientform-container">
<form class="form" method="post" id="appointementform">
<h2 class="form-title">Appointement</h2>

    <div class="form-group ">
        <input type="text" id="patient_name" name="fullname" class="form-control" placeholder="patient name"><br>
    </div>
    <div class="form-group ">
        <input type="text" id="patient_name" name="phonenumber" class="form-control" placeholder="patient phone number"><br>
    </div>
    <div class="form-group ">
        <input type="text" id="patient_name" name="email" class="form-control" placeholder="patient email"><br>
    </div>
    <div class="form-group ">
        <input type="date" id="appointment_date" name="date" class="form-control" placeholder="date" ><br>
    </div>
    <div class="form-group ">
        <input type="time" id="appointment_time" name="time" class="form-control" placeholder="time" ><br>
    </div>
    <div class="form-group ">
        <textarea id="reason" name="description" rows="2"  class="form-control" placeholder="resson of appointement"></textarea><br>
    </div>
    <div class="form-group mt-1">
            <a  class="btn btn-success" id="btn" onclick="createAppointement()" >submit</a>
    </div>
</form>
</div>
</body>
</html>