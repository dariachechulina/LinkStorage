/**
 * Created by dchechulina on 2/3/16.
 */

function resend_email()
{
    var email = $('#email').val();
    $.ajax({
        type: "POST",
        url: "http://testtask/Activation/resend",
        data: {email: email},
        success: function(data){
        }
    });
}