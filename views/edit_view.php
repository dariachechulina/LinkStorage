<?php
/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/21/15
 * Time: 3:12 PM
 */


/*class edit_view extends view
{
    public function render($content_view, $template_view, User_Model $user)
    {
        echo '<form method="post" action="/User/edit">

    Name: <input type=text name="name" value="' . $user->get_name() . '" <br> <br>
    Surname: <input type=text name="surname" value="' . $user->get_surname() . '"> <br> <br>
    E-mail: <input type=email name="email"  value="' . $user->get_email() . '"> <br> <br>
    Login: <input type=text disabled="true" name="login" value="' . $user->get_login() . '"> <br> <br>
Password: <input type="password" name="pass" value="' . $user->get_password() . '"> <br> <br>
    <input type="submit" name="edit" value="Edit">
    <input type="submit" name="cancel" onClick="location.href= testtask/index.php" value="Cancel">
</form>';
    }
}*/



echo '<form method="post" action="/User/edit">

    Name: <input type=text name="name" value="" <br> <br>

    <input type="submit" name="edit" value="Edit">
</form>';
