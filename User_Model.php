<?php


class User_model
{
    private $login, $email, $password, $name, $surname, $status, $role;

    public function get_name()
    {
        return $this->name;
    }
    public function get_surname()
    {
        return $this->surname;
    }
    public function get_login()
    {
        return $this->login;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function get_password()
    {
        return $this->password;
    }
    public function get_status()
    {
        return $this->status;
    }
    public function get_role()
    {
        return $this->role;
    }


    public function set_name($name)
    {
        $this->name = $name;
    }
    public function set_surname($surname)
    {
        $this->surname = $surname;
    }
    public function set_login($login)
    {
        $this->login = $login;
    }
    public function set_email($email)
    {
        $this->email = $email;
    }
    public function set_password($password)
    {
        $this->password = $password;
    }
    public function set_status($status)
    {
        $this->status = $status;
    }
    public function set_role($role)
    {
        $this->role = $role;
    }

    public function is_active()
    {
        if ($this->status)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function save()
    {
        #$query = "INSERT INTO userdb (login, pass, email, role, status, name, surname) VALUES('$this->get_login()', '$this->get_password()', '$this->get_email()', '$this->get_role()', '$this->get_status()', '$this->get_name()', '$this->get_surname()')";

        global $conn;
       # $conn->exec($query);
       # $id = $conn->lastInsertId();
    }
    /*
        public function login()
        {

        }

        public function register()
        {

        }

        public function logout()
        {

        }

        public function send_email()
        {

        }

        public function edit_user()
        {

        }

        public function delete_user()
        {

        }*/

}




