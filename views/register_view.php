<?php
/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/21/15
 * Time: 11:57 AM
 */

echo '<form method="post" action="/User/register">

    Name: <input type=text name="name" value=""> <br> <br>
    Surname: <input type=text name="surname" value=""> <br> <br>
    E-mail: <input type=email name="email" value=""> <br> <br>
    Login: <input type=text name="login" value=""> <br> <br>
Password: <input type="password" name="pass" value=""> <br> <br>
Re-enter Password: <input type="password" name="repass" value=""> <br> <br>
    <input type="submit" name="register" value="Register">
    <input type="submit" name="cancel" onClick="location.href= testtask/index.php" value="Cancel">
</form>';