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

    public function save()
    {
        global $conn;

        if ($this->lid == 0)
        {
            $query = "INSERT INTO links (title, link, description, privacy_status, uid) VALUES ('$this->title', '$this->link', '$this->description', '$this->privacy_status', '$this->uid')";
            $conn->exec($query);
            $this->lid = $conn->lastInsertId();
        }
        else
        {
            $query = "UPDATE links SET title = '$this->title', link = '$this->link', description = '$this->description', privacy_status = '$this->privacy_status', uid = $this->uid WHERE lid = '$this->lid'";
            $conn->exec($query);
        }
    }

    public function get_link_by_id($lid)
    {
        global $conn;
        $query = $conn->prepare("SELECT * FROM links WHERE lid = ?");
        $query->execute(array($lid));
        $result_link = $query->fetchObject('Link_Model');

        return $result_link;
    }

    public function get_all_links()
    {
        if (isset($_SESSION['uid']))
        {
            $logged_user = new User_Model();
            $logged_user = $logged_user->get_user_by_id($_SESSION['uid']);
            if (strcmp($logged_user->get_role(), 'user') !== 0)
            {
                global $conn;
                $res = $conn->query("SELECT * FROM links", PDO::FETCH_LAZY);
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
        }

        else
        {
            $links = array();
            return $links;
        }
    }

    public function get_all_public_links()
    {
        global $conn;
        $res = $conn->query("SELECT * FROM links WHERE  privacy_status = 'public'", PDO::FETCH_LAZY);
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
        global $conn;
        $res = $conn->query("SELECT * FROM links WHERE uid = $uid AND privacy_status = 'public'", PDO::FETCH_LAZY);
        $links = array(count($res));
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
        global $conn;
        $res = $conn->query("SELECT * FROM links WHERE uid = $uid", PDO::FETCH_LAZY);
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

}