/**
 * Created by dchechulina on 2/3/16.
 */

function delete_link(lid)
{
    $.ajax({
        type: "POST",
        url: "http://testtask/Link/delete",
        data: {lid: lid},
        success:  function(){
            document.location.href='http://testtask/';
        }

    });
}