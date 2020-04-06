function confirmPass() {
    var pass = document.getElementById("nid").value
    var confPass = document.getElementById("c_nid").value
    if(pass != confPass) {
        alert('Wrong confirm password !');
    }
}

