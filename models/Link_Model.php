<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 12:51 PM
 */
class Link_Model extends model
{
    private $title, $link, $description, $privacy_status, $uid, $lid = 0;

    public function get_title()
    {
        return $this->title;
    }
    public function get_link()
    {
        return $this->link;
    }
    public function get_description()
    {
        return $this->description;
    }
    public function get_privacy_status()
    {
        return $this->privacy_status;
    }
    public function get_uid()
    {
        return $this->uid;
    }
    public function get_lid()
    {
        return $this->lid;
    }

    public function set_title($title_)
    {
        $this->title = $title_;
    }
    public function set_link($link_)
    {
        $this->link = $link_;
    }
    public function set_description($description_)
    {
        $this->description = $description_;
    }
    public function set_privacy_status($privacy_status_)
    {
        $this->privacy_status = $privacy_status_;
    }
    public function set_uid($uid_)
    {
        $this->uid = $uid_;
    }
    public function set_lid($lid_)
    {
        $this->lid = $lid_;
    }

    public function validation()
    {
        if (strcmp($this->title, '') == 0 ||
            strcmp($this->link, '') == 0 ||
            strcmp($this->description, '') == 0)
        {
            error::$error_pull['validation_err'] = 'Fill all fields';
            return false;
        }
        return true;
    }

    public function save()
    {
        $validation_status = $this->validation();

        if ($validation_status) {

            if ($this->lid == 0) {
                $query = "INSERT INTO links (title, link, description, privacy_status, uid) VALUES ('$this->title', '$this->link', '$this->description', '$this->privacy_status', '$this->uid')";
                $this->connection->exec($query);
                $this->lid = $this->connection->lastInsertId();
            } else {
                $query = "UPDATE links SET title = '$this->title', link = '$this->link', description = '$this->description', privacy_status = '$this->privacy_status', uid = $this->uid WHERE lid = '$this->lid'";
                $this->connection->exec($query);
            }
            return true;
        }

        else
        {
            return false;
        }
    }

    public function get_link_by_id($lid)
    {
        $query = $this->connection->prepare("SELECT * FROM links WHERE lid = ?");
        $query->execute(array($lid));
        $result_link = $query->fetchObject('Link_Model');

        if (is_object($result_link))
        {
            $this->copy($result_link);
            return true;
        }

        return false;
    }

    public function get_all_links()
    {
        $res = $this->connection->query("SELECT * FROM links", PDO::FETCH_LAZY);
        $links = array();
        $i = 0;
        foreach ($res as $row)
        {
            $cur_link = new Link_Model();
            $cur_link->set_title($row['title']);
            $cur_link->set_link($row['link']);
            $cur_link->set_description($row['description']);
            $cur_link->set_privacy_status($row['privacy_status']);
            $cur_link->set_uid($row['uid']);
            $cur_link->set_lid($row['lid']);
            $links[$i] = $cur_link;
            $i++;
        }

        return $links;
    }

    public function get_all_public_links()
    {
        $res = $this->connection->query("SELECT * FROM links WHERE  privacy_status = 'public'", PDO::FETCH_LAZY);
        $links = array();
        $i = 0;
        foreach ($res as $row)
        {
            $cur_link = new Link_Model();
            $cur_link->set_title($row['title']);
            $cur_link->set_link($row['link']);
            $cur_link->set_description($row['description']);
            $cur_link->set_privacy_status($row['privacy_status']);
            $cur_link->set_uid($row['uid']);
            $cur_link->set_lid($row['lid']);
            $links[$i] = $cur_link;
            $i++;
        }

        return $links;
    }

    public function get_public_links_by_uid($uid)
    {
        $res = $this->connection->query("SELECT * FROM links WHERE uid = $uid AND privacy_status = 'public'", PDO::FETCH_LAZY);
        $links = array();
        $i = 0;
        foreach ($res as $row)
        {
            $cur_link = new Link_Model();
            $cur_link->set_title($row['title']);
            $cur_link->set_link($row['link']);
            $cur_link->set_description($row['description']);
            $cur_link->set_privacy_status($row['privacy_status']);
            $cur_link->set_uid($row['uid']);
            $cur_link->set_lid($row['lid']);
            $links[$i] = $cur_link;
            $i++;
        }

        return $links;
    }

    public function get_links_by_uid($uid)
    {
        $res = $this->connection->query("SELECT * FROM links WHERE uid = $uid", PDO::FETCH_LAZY);
        $links = array();
        $i = 0;
        foreach ($res as $row)
        {
            $cur_link = new Link_Model();
            $cur_link->set_title($row['title']);
            $cur_link->set_link($row['link']);
            $cur_link->set_description($row['description']);
            $cur_link->set_privacy_status($row['privacy_status']);
            $cur_link->set_uid($row['uid']);
            $cur_link->set_lid($row['lid']);
            $links[$i] = $cur_link;
            $i++;
        }

        return $links;
    }


    public function is_mine($id)
    {
        global $logged_user;

        $is_obj = $this->get_link_by_id($id);
        if (!$is_obj)
        {
            return 0;
        }

        if ($is_obj && $this->get_uid() == $logged_user->get_uid())
        {
            return 1;
        }

        if ($is_obj && $this->get_uid() !== $logged_user->get_uid())
        {
            return 2;
        }
    }

    public function copy(Link_Model $link)
    {
        $this->title = $link->get_title();
        $this->link = $link->get_link();
        $this->description = $link->get_description();
        $this->uid = $link->get_uid();
        $this->lid = $link->get_lid();
        $this->privacy_status = $link->get_privacy_status();
    }

    public function delete_link($lid)
    {
        $query = $this->connection->prepare("DELETE FROM links WHERE lid = $lid");
        $query->execute();
    }
}