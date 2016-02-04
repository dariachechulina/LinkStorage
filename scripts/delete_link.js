/**
 * Created by dchechulina on 2/3/16.
 */


$(document).on("click", ".delete-link-button", delete_link);


function delete_link()
{
    lid = $(this).attr('name');
    $.ajax({
        type: "POST",
        url: "http://testtask/Link/delete",
        data: {lid: lid},
        success:  function(){
            if ($(location).attr('pathname') == '/Link/show_my' ||
                $(location).attr('pathname') == '/')
            {
                location.reload();
            }
            else
            {
                document.location.href = 'http://testtask/';
            }
        }

    });
}
