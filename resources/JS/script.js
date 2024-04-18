function patient_form(){
    $.ajax({    
        type: "GET",
        url: "patient_registration.php",             
        dataType: "html",                  
        success: function(data){  
          $("#content").empty();                  
            $("#content").html(data); 
           
        }
    });
}

function patient_registration(){
    var form = $('#patient')[0];
       
  // FormData object 
  var data = new FormData(form);

  // If you want to add an extra field for the FormData
  //data.append("CustomField", "This is some extra data, testing");

  // disabled the submit button
  $("#btn").prop("disabled", true);
  $("#patient").trigger("reset");

  $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "patient.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 800000,
      success: function (data) {
        if(data=1){
          //window.location.href="vieworder.php";
          $("#content").empty();
          $("#content").load("viewpatient.php");
        }else{
          $("#error").html(data);
        }
      },
});
}

function view_patient(){
    $.ajax({    
        type: "GET",
        url: "viewpatient.php",             
        dataType: "html",                  
        success: function(data){  
          $("#content").empty();                  
            $("#content").html(data); 
           
        }
    });
}

function generate_token(){
    $.ajax({    
        type: "GET",
        url: "generate_token.php",             
        dataType: "html",                  
        success: function(data){  
          $("#content").empty();                  
            $("#content").html(data); 
           
        }
    });
}

function token_generation(id){
  var ID = id;
   
  $.ajax({
       type: 'GET',
       dataType: 'html',
       url: 'token.php',
       data:{patientid:ID},
       success: function (data) {
       //console.log(data);
      $("#content").html(data);
      $("#content").load("viewpatient.php");
           }
               
       });
}