<?php


class User_Model
{
    private $login, $email, $pass, $name, $surname, $status, $role;

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
        return $this->pass;
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
        $this->pass = $password;
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
        $query = "INSERT INTO userdb (login, pass, email, role, status, name, surname) VALUES('$this->get_login()', '$this->get_password()', '$this->get_email()', '$this->get_role()', '$this->get_status()', '$this->get_name()', '$this->get_surname()')";

        global $conn;
        $conn->exec($query);
        $id = $conn->lastInsertId();
    }

    public function create_user($login_,$password_, $email_, $role_, $status_, $name_, $surname_)
    {
        $this->set_login($login_);
        $this->set_password($password_);
        $this->set_email($email_);
        $this->set_role($role_);
        $this->set_status($status_);
        $this->set_name($name_);
        $this->set_surname($surname_);
    }

    public function login($ent_login, $ent_pass)
    {
        global $conn;
        $query = $conn->prepare("SELECT pass FROM users WHERE login = ?");
        $query->execute(array($ent_login));
        $result = $query->fetchAll();
        $length = count($result);
        if ($length == 0)
        {
            echo "No user with such login. Please, sign up or try again";
        }

        if ($result[0]['pass'] != $ent_pass)
        {
            echo "Incorrect password";
        }

        $user_info = $conn->query("SELECT * FROM users WHERE login = $ent_login", PDO::FETCH_OBJ);
        $cur_user = new User_Model();
        $cur_user = $user_info->fetchObject("User_Model");

        if (!$cur_user->is_active())
        {
            echo "Your account isn't active. Please, check your mailbox";
            $cur_user->send_email($cur_user->get_email());
        }

        session_start();
        $_SESSION['login'] = $cur_user->get_login();
        echo "You are logged in";

    }

    public function register()
    {

    }

    public function logout()
    {

    }

    public function send_email($email_)
    {

    }

    public function edit_user()
    {

    }

    public function delete_user()
    {

    }

}




