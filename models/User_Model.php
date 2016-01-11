<?php

require_once 'Activation_Model.php';

class User_Model
{
    private $login, $email, $pass, $name, $surname, $status = 0, $role = 'user', $uid = 0;

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
    public function get_name()
    {
        return $this->name;
    }
    public function get_surname()
    {
        return $this->surname;
    }
    public function get_uid()
    {
        return $this->uid;
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
    public function set_name($name)
    {
        $this->name = $name;
    }
    public function set_surname($surname)
    {
        $this->surname = $surname;
    }
    public function set_uid($uid)
    {
        $this->uid = $uid;
    }

    public function is_active()
    {
        if ($this->status == 1)
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
        global $conn;

        if ($this->uid == 0)
        {
            $query = "INSERT INTO userdb (login, pass, email, role, status, name, surname) VALUES ('$this->login', '$this->pass', '$this->email', '$this->role', '$this->status', '$this->name', '$this->surname')";
            $conn->exec($query);
            $this->uid = $conn->lastInsertId();
        }
        else
        {
            $query = "UPDATE userdb SET login = '$this->login', pass = '$this->pass', email = '$this->email', role = '$this->role', status = '$this->status', name = '$this->name', surname = '$this->surname' WHERE uid = '$this->uid'";
            $conn->exec($query);
        }
    }

    private function validate_login_info()
    {
        global $conn;
        $query = $conn->prepare("SELECT * FROM userdb WHERE login = ?");
        $query->execute(array($this->login));
        $result = $query->fetchAll();
        $length = count($result);
        if ($length == 0)
        {
            echo "no such user";
            return false;
        }

        if ($result[0]['pass'] != $this->pass)
        {
            echo "incorrect password";
            return false;

        }

        $this->uid = $result[0]['uid'];
        $this->email = $result[0]['email'];
        $this->status = $result[0]['status'];
        $this->role = $result[0]['role'];

        return true;
        #return "success";
    }

    private function validate_register_info($repass)
    {
        if ($this->pass != $repass)
        {
            echo "Password don't match. Try again";
            return false;
            #return "Password don't match. Try again";
        }

        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        if (!preg_match($regex, $this->email))
        {
            echo "Invalid email";
            return false;
            #return "Invalid email";
        }

        global $conn;
        $query = $conn->prepare("SELECT * FROM userdb WHERE login = ?");
        $query->execute(array($this->login));
        $result = $query->fetchAll();
        $length = count($result);
        if ($length != 0)
        {
            echo "User with such login exists. Try again";
            return false;
            #return "User with such login exists. Try again";
        }
        $query = $conn->prepare("SELECT * FROM userdb WHERE email = ?");
        $query->execute(array($this->email));
        $result = $query->fetchAll();
        $length = count($result);
        if ($length != 0)
        {
            echo "User with such email exists. Try again";
            return false;
            #return "User with such email exists. Try again";
        }

        echo "SUCCESS_VALIDATION";
        return true;
        #return 'success';
    }

    public function login()
    {
        $validation_status = $this->validate_login_info();

        if (!$validation_status)
        {
            return false;
        }

        if (!$this->is_active())
        {
            echo "Your account isn't active. Please, check your mailbox";
            $this->send_email();
            return false;
        }

        session_start();
        $_SESSION['login'] = $this->login;
        $_SESSION['uid'] = $this->uid;
        echo $_SESSION['login'] . ", you are successfully logged in";
        return true;
    }

    public function register($repass)
    {
        $validation_status = $this->validate_register_info($repass);
        if(!$validation_status)
        {
            return false;
        }

        $this->save();
        $this->send_email();

        return true;
    }

    public function logout()
    {
        session_destroy();
        return true;
    }

    public function send_email()
    {
        $tmp_link = new Activation_Model();
        global $conn;
        $query = $conn->prepare("SELECT uid FROM userdb WHERE login = ?");
        $query->execute(array($this->login));
        $result = $query->fetchAll();
        if (!count($result))
        {
            return false;
        }
        $tmp_link->send($result[0]['uid'], $this->email);

        return true;
    }

    public function delete_user($login_)
    {
        if ($this->role != 'admin')
        {
            echo "You have no permission for this action";
            return false;
        }

        global $conn;
        $query = $conn->prepare("DELETE FROM userdb WHERE login = ?");
        if (!$query->execute(array($login_)))
        {
            return false;
        }
        return true;
    }

    public function get_user_by_id($uid)
    {
        global $conn;
        $query = $conn->prepare("SELECT * FROM userdb WHERE uid = ?");
        $query->execute(array($uid));
        $result_user = $query->fetchObject('User_Model');

        return $result_user;
    }

}




