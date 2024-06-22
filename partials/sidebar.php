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
    <script src="../asset/Bootstrap/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../asset/Bootstrap/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>

<ul class="nav flex-column bg-dark justfy-content-center txt-secondary" id="nav-item">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#" onclick="patient_form()">Patient Registration</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#" onclick="view_patient()">view patient</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#" onclick="generate_token()">Generate Token</a>
  </li>
  <li class="nav-item">
  <div class="dropdown ">
  <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Appointement
  </a>

  <ul class="dropdown-menu " aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="#" onclick="appointement()">Create Appointement</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>
  </li>
</ul>
</body>
</html>