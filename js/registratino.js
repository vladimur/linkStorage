function checkPass() {

    $("#registr_form").submit(function(e){
        e.preventDefault();
    });

    var pass1 = document.getElementById('password1').value;
    var pass2 = document.getElementById('password2').value;

    if (pass1 == pass2 && pass1 != '') {
        document.getElementById('registr_form').submit()
    } else {
        var tmp1 = document.getElementById('error_pass');
        tmp1.innerHTML = 'Пароли не совпадают';
    }
}
