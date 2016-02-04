/**
 * Created by dchechulina on 2/3/16.
 */



$(document).on("click", ".delete-user-button", delete_user);


function delete_user()
{
    uid = $(this).attr('name');
    $.ajax({
        type: "POST",
        url: "http://testtask/User/delete",
        data: {uid: uid},
        success:  function(){
            location.reload();
        }

    });
}