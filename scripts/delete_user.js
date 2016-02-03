/**
 * Created by dchechulina on 2/3/16.
 */

function delete_user(uid)
{
    $.ajax({
        type: "POST",
        url: "http://testtask/User/delete",
        data: {uid: uid},
        success:  function(){
            location.reload();
        }

    });
}