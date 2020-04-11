// Auto Dropdown load
function myFunction() {
  window.print();
}

//Save the value function - save it to localStorage as (ID, VALUE)
function saveValue(e) {
  var id = e.id;  // get the sender's id to save it .
  var val = e.value; // get the value.
  if (typeof(Storage) !== "undefined") {
    localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override . 
  }
  else {
    console.log("Sorry, your browser does not support web storage...");
  }
}

//get the saved value function - return the value of "v" from localStorage.
function getSavedValue(v) {
  if (typeof(Storage) !== "undefined") {
    if (!localStorage.getItem(v)) {
        return "";// You can change this to your defualt value.
    }
    return localStorage.getItem(v);
  }
  else {
    console.log("Sorry, your browser does not support web storage...");
  }
}

$(document).ready(function() {
  $('#showtable').DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copy',
        title: $('#union_heading').text()
      },
      {
        extend: 'print',
        title: $('#union_heading').text()
      },
    ]
  });

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
    $('#nid').val(getSavedValue("nid"));
    $('#mobile').val(getSavedValue("mobile"));
    $('#fullName').val(getSavedValue("fullName"));
    $('#sel_ward').val(getSavedValue("sel_ward"));
    $('#sel_depart').val(getSavedValue("sel_depart"));
    $('#sel_relief').val(getSavedValue("sel_relief"));
    $('#sel_fiscal').val(getSavedValue("sel_fiscal"));
    /* Here you can add more inputs to set value. if it's saved */
    document.getElementById("nid").focus();
    $('.serviceDetails').html(data).fadeTo('slow', 1);
  })
  .fail(function() {
    alert('অ্যাজাক্স সাবমিশন সফল হয়নি ...');
  });
  $('form.serviceEntry').trigger("reset");
});

$("form.emergency").submit(function(evt) {
  evt.preventDefault();
  $.ajax({
    url: 'process_emergency.php',
    type: 'POST',
    data: $(this).serialize(), // it will serialize the form data
    dataType: 'html'
  })
  .done(function(data) {
    // $('#nid').val(getSavedValue("nid"));
    // $('#mobile').val(getSavedValue("mobile"));
    // $('#fullName').val(getSavedValue("fullName"));
    // $('#sel_ward').val(getSavedValue("sel_ward"));
    // $('#sel_depart').val(getSavedValue("sel_depart"));
    // $('#sel_relief').val(getSavedValue("sel_relief"));
    // $('#sel_fiscal').val(getSavedValue("sel_fiscal"));
    /* Here you can add more inputs to set value. if it's saved */
    document.getElementById("nid").focus();
    $('.serviceDetails').html(data).fadeTo('slow', 1);
  })
  .fail(function() {
    alert('অ্যাজাক্স সাবমিশন সফল হয়নি ...');
  });
  $('form.emergency').trigger("reset");
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
