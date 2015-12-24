<?php

/**
 * Created by PhpStorm.
 * User: dchechulina
 * Date: 12/10/15
 * Time: 12:51 PM
 */
class Link_Model
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

}