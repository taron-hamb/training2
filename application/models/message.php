<?php

class Message extends Model
{

    private $id;
    private $from_user_id;
    private $to_user_id;
    private $message;
    private $is_read;
    private $created_at;

    function __construct()
    {
        parent::__construct();
    }

    public function create($parent_id, $from_user_id, $to_user_id, $message)
    {
        $sql = "INSERT INTO message (parent_id, from_user_id,to_user_id,message) VALUES ('$parent_id','$from_user_id','$to_user_id','$message')";
        $this->query($sql);

    }


    public function get_id()
    {
        return $this->id;
    }

    public function get_from_user_id()
    {
        return $this->from_user_id;
    }

    public function get_to_user_id()
    {
        return $this->to_user_id;
    }

    public function get_message()
    {
        return $this->message;
    }

    public function get_is_read()
    {
        return $this->is_read;
    }

    public function get_created_at()
    {
        return $this->created_at;
    }

    public function all()
    {
        $sql = 'SELECT * FROM user';
        $result = $this->query($sql);
        return $result;
    }


    public function init($message_array)
    {
        $this->id = $message_array['id'];
        $this->from_user_id = $message_array['from_user_id'];
        $this->to_user_id = $message_array['to_user_id'];
        $this->message = $message_array['message'];
        $this->is_read = $message_array['is_read'];
        $this->created_at = $message_array['created_at'];
    }

    public function set_read($message_id)
    {
        $sql = "UPDATE message SET is_read = 1 WHERE id = '$message_id'";
//        var_dump($sql);die;
        $this->query($sql);
//        return $result;
//        $table_name = "message";
//        $array = "is_read = 1";
//        $where = "id = ".$message_id;
//        $this->update($table_name, $array, $where);
    }

    public  $result = '';
    public function get_parents($parent_id)
    {
        $sql = "SELECT * FROM message WHERE id = '$parent_id'";
        $this->result .= $this->query($sql);
        if($this->result['parent_id'])
        {
            $this->get_parents($this->result['parent_id']);
        }
        return $this->result;
    }
}