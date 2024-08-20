function validate_password()
{
    var pass = document.getElementById('input_passwordCreate').value;
    var confirm_pass = document.getElementById('input_confirmPasswordCreate').value;
    if (pass != confirm_pass)
    {
        document.getElementById('wrongPasswordAlert').style.color = 'red';
        document.getElementById('wrongPasswordAlert').innerHTML
            = '☒ Les mots de passe doivent être identiques';
        document.getElementById('submit').disabled = true;
        document.getElementById('submit').style.opacity = (0.4);
    } else
    {
        document.getElementById('wrongPasswordAlert').style.color = 'green';
        document.getElementById('wrongPasswordAlert').innerHTML =
            '🗹 Mot de passe OK';
        document.getElementById('submit').disabled = false;
        document.getElementById('submit').style.opacity = (1);
    }
}

/*
function success_alert()
{
    if (document.getElementById('input_passwordCreate').value != "" && document.getElementById('input_confirmPasswordCreate').value != "")
    {
        //fade effect
        document.getElementById('successAlert').style.opacity = 1;
        setTimeout(function()
        {
            document.getElementById('successAlert').style.opacity = 0;
        }
        , 500);
    }
}
*/