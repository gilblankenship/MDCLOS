$.ajax({
         type: 'GET',
         url: './assets/php/register_new_patient/patient_id_registration.php',
         data: {},
         success: function (result) {
             document.getElementById("patient_id").innerHTML="Patient ID: " + result;
             document.getElementById("patient_id_summary").innerHTML="Patient ID: " + result;
         },
         error: function (result) {
             alert('Failure on the AJAX: Update physcian list!');
         }
});
