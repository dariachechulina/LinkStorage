<?php

require_once 'Activation_Model.php';

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

    public function save($login_, $pass_, $email_, $role_, $status_, $name_, $surname_)
    {
        $this->login = $login_;
        $this->pass = $pass_;
        $this->email = $email_;
        $this->role = $role_;
        $this->status = $status_;
        $this->name = $name_;
        $this->surname = $surname_;

        $query = "INSERT INTO userdb (login, pass, email, role, status, name, surname) VALUES('$login_', '$pass_', '$email_', '$role_', '$status_', '$name_', '$surname_')";

        global $conn;
        $conn->exec($query);
        $id = $conn->lastInsertId();
    }

    public function save_changes_to_db($uid_)
    {
        $query = "UPDATE userdb SET login = '$this->login', pass = '$this->pass', email = '$this->email', role = '$this->role', status = '$this->status', name = '$this->name', surname = '$this->surname' WHERE uid = '$uid_')";

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

    public function validate_login_info($ent_login, $ent_pass)
    {
        global $conn;
        $query = $conn->prepare("SELECT pass FROM users WHERE login = ?");
        $query->execute(array($ent_login));
        $result = $query->fetchAll();
        $length = count($result);
        if ($length == 0)
        {
            return "no such user";
        }

        if ($result[0]['pass'] != $ent_pass)
        {
            return "incorrect password";
        }

        return "success";
    }

    public function validate_register_info($ent_login, $ent_pass, $ent_repass, $ent_email)
    {
        if ($ent_pass != $ent_repass)
        {
            return "Password don't match. Try again";
        }

        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
        if (!preg_match($regex, $ent_email))
        {
            return "Invalid email";
        }

        global $conn;
        $query = $conn->prepare("SELECT * FROM userdb WHERE login = ?");
        $query->execute(array($ent_login));
        $result = $query->fetchAll();
        $length = count($result);
        if ($length != 0)
        {
            return "User with such login exists. Try again";
        }
        $query = $conn->prepare("SELECT * FROM userdb WHERE email = ?");
        $query->execute(array($ent_email));
        $result = $query->fetchAll();
        $length = count($result);
        if ($length != 0)
        {
            return "User with such email exists. Try again";
        }

        return 'success';
    }

    public function login($ent_login, $ent_pass)
    {
        $validation_status = $this->validate_login_info($ent_login, $ent_pass);

        if ($validation_status != 'success')
        {
            return;
        }

        global $conn;
        $user_info = $conn->query("SELECT * FROM users WHERE login = $ent_login", PDO::FETCH_OBJ);
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

    public function register($login_,$pass_, $re_pass, $email_, $name_, $surname_)
    {
        $validation_status = $this->validate_register_info($login_, $pass_, $re_pass, $email_);
        if($validation_status != 'success')
        {
            return;
        }

        $new_user = new User_Model();
        $new_user->save($login_, $pass_, $email_, 'user', 0, $name_, $surname_);
        $new_user->send_email();
    }

    public function logout()
    {
        session_destroy();
    }

    public function send_email()
    {
        $tmp_link = new Activation_Model();
        $tmp_link->send();

        global $conn;
        $query = $conn->prepare("SELECT uid FROM userdb WHERE login = ?");
        $query->execute(array($this->login));
        $result = $query->fetchAll();

        $tmp_link->send($result[0]['uid'], $this->email);
    }

    public function edit_user(User_Model $user, $login_,$password_, $email_, $role_, $status_, $name_, $surname_)
    {
        if ($this->role != 'admin')
        {
            echo "You have no permission for this action";
            return;
        }

        global $conn;
        $query = $conn->prepare("SELECT uid FROM userdb WHERE login = '$user->get_login()'");
        $query->execute();
        $result = $query->fetchAll();
        $cur_uid = $result[0]["uid"];

        if ($login_ != NULL)
        {
            $user->set_login($login_);
        }

        if ($password_ != NULL)
        {
            $user->set_password($password_);
        }

        if($email_ != NULL)
        {
            $user->set_email($email_);
        }

        if ($status_ != NULL)
        {
            $user->set_status($status_);
        }

        if ($role_ != NULL)
        {
            $user->set_role($role_);
        }

        if ($name_ != NULL)
        {
            $user->set_name($name_);
        }

        if ($surname_ != NULL)
        {
            $user->set_surname($surname_);
        }

        $user->save_changes_to_db($cur_uid);
    }

    public function delete_user(User_Model $user)
    {
        if ($this->role != 'admin')
        {
            echo "You have no permission for this action";
            return;
        }

        global $conn;
        $query = $conn->prepare("DELETE FROM userdb WHERE login = '$user->get_login()'");
        $query->execute();
    }

}




