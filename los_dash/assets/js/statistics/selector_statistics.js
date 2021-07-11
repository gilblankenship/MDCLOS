$(document).ready(function() {

  const $valueSpan = $('.valueSpan');
  const $value = $('#slider2');
  $valueSpan.html($value.val());
//   $value.on('input change', () => {
//     $valueSpan.html($value.val());
//     console.log($('#slider2').val());
//     window.selectedMinLOS_statistics = $('#slider2').val();
//     console.log('hola');
//     console.log(window.selectedMinLOS_statistics);
    
//     updateData();
//   });
  
  $('#slider2').mouseup(function() {
        $valueSpan.html($('#slider2').val());
        console.log($('#slider2').val());
        window.selectedMinLOS_statistics = $('#slider2').val();
        updateData();
    });
});
