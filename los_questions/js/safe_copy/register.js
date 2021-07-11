function is_numeric_key(evt) {
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if ((charCode <= 90 && charCode >= 65) || (charCode <= 122 && charCode >= 97))
		return true;
	return false;
}  

function is_mrn_key(evt) {
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if ((charCode <= 90 && charCode >= 65) || (charCode <= 122 && charCode >= 97) || 
	    (charCode > 47 && charCode < 58)|| charCode == 45)
		return true;
	return false;
}  

function is_number_key(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
	    return false;
	return true;
} 

(function() {
    'use strict';
    window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
        }, false);
    });
    }, false);
})();

$(document).ready(function(){
    document.getElementById("select_physician").disabled = true;    
    
});

$('#select_center').change(function() {
  window.center_id = document.getElementById("select_center").value;
  document.getElementById("select_physician").disabled = false;

    // Used to populate patient info card ------------------------------
    $.ajax({
        type: 'GET',
        url: './php/update_physician_list.php',
        data: {'center_id' : document.getElementById("select_center").value},
        success: function (result) {
            document.getElementById("select_physician").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX: Update physcian list!');
        }
    });      
});