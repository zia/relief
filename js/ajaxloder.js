// Auto Dropdown load
function myFunction() {
  window.print();
}
$(document).ready(function(){
  function myFunction() {
    window.print();
}
  $("#sel_depart").change(function(){
    var unionID = $(this).val();
    var data = 'number=' + unionID;
    $.ajax({
      url: 'autodropdown.php',
      type: 'GET',
      data: data,
      cache: false,
      success:function(response){
        $( ".peasthere" ).html( response );  

        },
      error: function( jqXhr, textStatus, errorThrown ){
          console.log( errorThrown );
          alert(errorThrown); 
      }
  });   
  });

});

// Record Add
$("form.serviceEntry").submit(function(evt){
  evt.preventDefault();
  $.ajax({
    url: 'process.php',
    type: 'POST',
    data: $(this).serialize(), // it will serialize the form data
    dataType: 'html'
  })
  .done(function( data ){
      $('.serviceDetails').html( data ).fadeTo('slow', 1);
  })
  .fail(function(){
    alert('Ajax Submit Failed ...');
  });
  $('form.serviceEntry').trigger("reset");
});

// Search Result
$("form.regSearch").submit(function(evt){
    evt.preventDefault();
    var url = "repDetails.php?id=" + $("#search").val();
    //alert(data);
    $.get( url, function(data, status){
      $( "#txtHint" ).html( data );
      //alert("Data: " + data + "\nStatus: " + status);
    });
  });


// Confirm Nid
function confirmPass() {
  var pass = document.getElementById("nid").value
  var confPass = document.getElementById("c_nid").value
  if(pass != confPass) { 
    $("#errorConfirm>p").text("NID does not match.");
  } else {
    $("#errorConfirm>p").fadeOut("slow");
  }
}
