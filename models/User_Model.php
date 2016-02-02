<?php

class User_Model extends model
{
    private $login, $email, $pass, $name, $surname, $status = 0, $role = 'user', $uid = 0;

    static $error_pull = array();

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
        if (strcmp($this->login, '') == 0)
        {
            self::$error_pull['login_err'] = "Invalid login";
            return false;
        }
        global $conn;
        $query = $conn->prepare("SELECT * FROM userdb WHERE login = ?");
        $query->execute(array($this->login));
        $result = $query->fetchAll();
        $length = count($result);
        if ($length == 0)
        {
            self::$error_pull['login_err'] = "No such user";
            return false;
        }

        if ($result[0]['pass'] != $this->pass)
        {
            self::$error_pull['login_err'] = "Incorrect password";
            return false;

        }

        $this->uid = $result[0]['uid'];
        $this->email = $result[0]['email'];
        $this->status = $result[0]['status'];
        $this->role = $result[0]['role'];

        return true;
    }

    private function validate_register_info($repass)
    {
        if (strcmp($this->login, '') == 0 || strcmp($this->pass, '') == 0 || strcmp($this->email, '') == 0)
        {
            //echo "Please, fill all required fields";
            self::$error_pull['register_err'] = 'Please, fill all required fields';
            return false;
        }
        if ($this->pass != $repass)
        {
            self::$error_pull['register_err'] = "Password don't match. Try again";
            return false;
            #return "Password don't match. Try again";
        }

        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        if (!preg_match($regex, $this->email))
        {
            self::$error_pull['register_err'] = "Invalid email";
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
            self::$error_pull['register_err'] = "User with such login exists. Try again";
            return false;
            #return "User with such login exists. Try again";
        }
        $query = $conn->prepare("SELECT * FROM userdb WHERE email = ?");
        $query->execute(array($this->email));
        $result = $query->fetchAll();
        $length = count($result);
        if ($length != 0)
        {
            self::$error_pull['register_err'] = "User with such email exists. Try again";
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
            self::$error_pull['activation_err'] = "account isn't active";
            $this->send_email();
            return false;
        }
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
        $_SESSION = array();
        unset($_COOKIE[session_name()]);
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

        $this->copy_($result_user);
    }

    public function find_user_by_id($uid)
    {
        global $conn;
        $query = $conn->prepare("SELECT * FROM userdb WHERE uid = ?");
        $query->execute(array($uid));
        $result_user = $query->fetchObject('User_Model');

        if (!is_object($result_user))
        {
            return false;
        }

        return true;
    }

    public function get_all_users()
    {
        global $conn;
        $res = $conn->query("SELECT * FROM userdb", PDO::FETCH_LAZY);
        $users = array(count($res));
        $i = 0;
        foreach ($res as $row)
        {
            $cur_user = new User_Model();
            $cur_user->set_login($row['login']);
            $cur_user->set_password($row['pass']);
            $cur_user->set_email($row['email']);
            $cur_user->set_role($row['role']);
            $cur_user->set_status($row['status']);
            $cur_user->set_name($row['name']);
            $cur_user->set_surname($row['surname']);
            $cur_user->set_uid($row['uid']);

            $users[$i] = $cur_user;
            $i++;
        }

        return $users;
    }


    public function is_mine($id)
    {
        $is_valid_id = $this->find_user_by_id($id);
        global $logged_user;

        if (!$is_valid_id)
        {
            return 0;
        }

        if ($logged_user->get_uid() == $id)
        {
            return 1;
        }
        else
        {
            return 2;
        }
    }

    public function copy_(User_Model $user)
    {
        $this->login = $user->get_login();
        $this->pass = $user->get_password();
        $this->email = $user->get_email();
        $this->status = $user->get_status();
        $this->role = $user->get_role();
        $this->uid = $user->get_uid();
        $this->name = $user->get_name();
        $this->surname = $user->get_surname();
    }



}




