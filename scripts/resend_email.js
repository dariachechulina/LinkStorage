/**
 * Created by dchechulina on 2/3/16.
 */

$(document).ready(function()
{
    $("#resend").click(resend_email);
});

function resend_email()
{
    var email = $('#email').val();
    $.ajax({
        type: "POST",
        url: "http://testtask/Activation/resend",
        data: {email: email},
        success: function(data){
            document.location.href="http://testtask/";
        }
    });
}