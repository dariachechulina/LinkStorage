/**
 * Created by dchechulina on 2/2/16.
 */


function logout(){
    $.ajax({
        type: "POST",
        url: "http://testtask/User/logout",
        success: function(data){
        }
    });
}
