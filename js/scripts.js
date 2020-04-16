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
    /** Search HelpLine */
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    /** Get Ward */
    $("#sel_depart").change(function() {
        $.ajax({
          url: './autodropdown.php',
          type: 'GET',
          data: {number: $(this).val(), version: 3},
          cache: false,
          success:function(response) {
            $(".peasthere").html(response);
          },
          error: function(jqXhr, textStatus, errorThrown) {
              console.log(errorThrown);
          }
        });
    });
});