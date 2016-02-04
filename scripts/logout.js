/**
 * Created by dchechulina on 2/2/16.
 */

$(document).ready(function()
{
    $("#logout").click(logout);
});

function logout()
{
    $.ajax({
        type: "POST",
        url: "http://testtask/User/logout",
        success: function (data) {
            document.location.href = 'http://testtask/';
        }
    });
}
