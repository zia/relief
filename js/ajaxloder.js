// Auto Dropdown load
function myFunction() {
  window.print();
}

//Save the value function - save it to localStorage as (ID, VALUE)
function saveValue(e) {
  var id = e.id;  // get the sender's id to save it .
  var val = e.value; // get the value.
  localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
}

//get the saved value function - return the value of "v" from localStorage.
function getSavedValue(v) {
  if (!localStorage.getItem(v)) {
      return "";// You can change this to your defualt value.
  }
  return localStorage.getItem(v);
}

$(document).ready(function() {
  $('#showtable').DataTable();

  function myFunction() {
    window.print();
  }

  $("#sel_depart").change(function() {
    var unionID = $(this).val();
    // console.log(unionID);
    var data = 'number=' + unionID;
    $.ajax({
      url: 'autodropdown.php',
      type: 'GET',
      data: data,
      cache: false,
      success:function(response) {
        $(".peasthere").html(response);
      },
      error: function(jqXhr, textStatus, errorThrown) {
          console.log(errorThrown);
          // alert(errorThrown);
      }
    });
  });
});

// Record Add
$("form.serviceEntry").submit(function(evt) {
  evt.preventDefault();
  $.ajax({
    url: 'process.php',
    type: 'POST',
    data: $(this).serialize(), // it will serialize the form data
    dataType: 'html'
  })
  .done(function(data) {
    document.getElementById("nid").value        = getSavedValue("nid"); // set the value to this input
    document.getElementById("mobile").value     = getSavedValue("mobile"); // set the value to this input
    document.getElementById("fullName").value   = getSavedValue("fullName"); // set the value to this input
    document.getElementById("sel_ward").value   = getSavedValue("sel_ward"); // set the value to this input
    document.getElementById("sel_depart").value = getSavedValue("sel_depart"); // set the value to this input
    document.getElementById("sel_relief").value = getSavedValue("sel_relief"); // set the value to this input
    document.getElementById("sel_fiscal").value = getSavedValue("sel_fiscal"); // set the value to this input
    /* Here you can add more inputs to set value. if it's saved */
    document.getElementById("nid").focus();
    $('.serviceDetails').html(data).fadeTo('slow', 1);
  })
  .fail(function() {
    alert('অ্যাজাক্স সাবমিশন সফল হয়নি ...');
  });
  $('form.serviceEntry').trigger("reset");
});

// Search Result
$("form.regSearch").submit(function(evt) {
    evt.preventDefault();
    var url = "repDetails.php?id=" + $("#search").val();
    //alert(data);
    $.get( url, function(data, status) {
      $("#txtHint").html( data );
      //alert("Data: " + data + "\nStatus: " + status);
    });
});

// Confirm Nid
function confirmPass() {
  var pass = document.getElementById("nid").value
  var confPass = document.getElementById("c_nid").value
  if(pass != confPass) {
    $("#errorConfirm>p").text("এনআইডি ম্যাচ করেনি।");
  } else {
    $("#errorConfirm>p").fadeOut("slow");
  }
}
