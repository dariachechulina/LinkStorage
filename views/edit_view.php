<?php

var_dump($data);

if ($data[1] == 'admin')
{
    echo "ADMIN";
}

if ($data[1] == 'user')
{

    echo '<form method="post" action="/User/edit/' . $data[0]->get_uid() . '">

    Name: <input type=text name="name" value="' . $data[0]->get_name() . '" <br> <br>
    Surname: <input type=text name="surname" value="' . $data[0]->get_surname() . '"> <br> <br>
    E-mail: <input type=email name="email"  value="' . $data[0]->get_email() . '"> <br> <br>
    Login: <input type=text disabled="true" name="login" value="' . $data[0]->get_login() . '"> <br> <br>
    Password: <input type="password" name="pass" value="' . $data[0]->get_password() . '"> <br> <br>
    <input type="submit" name="edit" value="Edit">
    <input type="submit" name="cancel" onClick="location.href= testtask/index.php" value="Cancel">
</form>';
}