<?php
class status
{
    var $id;
    var $content; // content cua status
    var $user_post;

    function __construct($id, $content, $user_post)
    {
        $this->id = $id;
        $this->content = $content;
        $this->user_post = $user_post;
    }
    static function getList()
    {
        $conn = db::connect();
        $sql = "SELECT * From status ";
        $result = $conn->query($sql);
        $ls = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status = new status($row['id'], $row['content'], $row['user_post']);
                $ls[] = $status;
            }
        }
        //Buoc 3: Dong ket noi
        $conn->close();
        return $ls;
    }

    static function getStatusById($id)
    {
        $ls = status::getList();
        foreach ($ls as $status) {
            if ($status->id == $id)
                return $status;
        }
        return null;
    }
    static function add($status)
    {
        $conn = db::connect();

        $sql = "INSERT INTO `status` (`content`, `user_post`) 
                VALUES ('" . $status->content . "',
                        '" . $status->user_post . "')";
        echo $sql;

        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }
    static function delete($id)
    {
        $conn = db::connect();
        $sql = "DELETE FROM `status` WHERE `id` = " . $id;
        $result = $conn->query($sql);
        echo $result;
        echo $conn->error;
        $conn->close();
    }


    static function update($status)
    {
        $conn = db::connect();

        $sql = "UPDATE `status` SET `content`='" . $status->content . "',`user_post`='" . $status->user_post . "'
                                    WHERE `id` = '" . $status->id . "' ";
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }
}
