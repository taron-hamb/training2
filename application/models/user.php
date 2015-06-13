<?php

class User extends Model
{

    private $id;
    private $first_name;
    private $last_name;
    private $bdate;
    private $gender;
    private $country;
    private $email;
    private $password;
    private $profile_picture;

    function __construct()
    {
        parent::__construct();
    }

    public function register($first_name, $last_name, $gender, $bdate, $country, $email, $password)
    {
        $sql = "INSERT INTO user (first_name,last_name,gender,bdate,country,email,password) VALUES ('$first_name','$last_name','$gender','$bdate','$country','$email','$password')";
        $this->query($sql);

        $user_by_email = $this->get_user_by_email($email);
        $this->init($user_by_email);
        $_SESSION['user'] = $user_by_email;
        $_SESSION['is_login'] = 'ok';

    }

    public function searched_user($id){
        $sql = "SELECT * FROM user WHERE id='$id'";
        $user = $this->query($sql);
        return $user;
    }

    public function is_unique_email($email)
    {
        $sql = "SELECT email FROM user WHERE email='$email'";
        $is_unique = $this->query($sql);
        if ($is_unique) {
            return false;
        } else {
            return true;
        }

    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        $result = $this->query($sql);

        if ($result) {
            $user_by_email = $this->get_user_by_email($email);
            $this->init($user_by_email);
            $_SESSION['user'] = $user_by_email;
            $_SESSION['is_login'] = 'ok';
            return true;
        } else {

        }
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_first_name()
    {
        return $this->first_name;
    }

    public function get_last_name()
    {
        return $this->last_name;
    }

    public function get_gender()
    {
        return $this->gender;
    }

    public function get_bdate()
    {
        return $this->bdate;
    }

    public function get_country()
    {
        return $this->country;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function get_profile_picture()
    {
        return $this->profile_picture;
    }

    public function all()
    {
        $user_id = $_SESSION['user']['id'];

        $sql = "SELECT * FROM user where id !='$user_id'";
        $result = $this->query($sql);

        return $result;
    }

    public function get_user_by_email($email)
    {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $this->query($sql);
        return $result[0];
    }

    public function init($user_array)
    {
        $this->id = $user_array['id'];
        $this->first_name = $user_array['first_name'];
        $this->last_name = $user_array['last_name'];
        $this->gender = $user_array['gender'];
        $this->bdate = $user_array['bdate'];
        $this->country = $user_array['country'];
        $this->email = $user_array['email'];
        $this->password = $user_array['password'];
    }

    public function become_logined_user()
    {
        $this->id = $_SESSION['user']['id'];
        $this->first_name = $_SESSION['user']['first_name'];
        $this->last_name = $_SESSION['user']['last_name'];
        $this->gender = $_SESSION['user']['gender'];
        $this->bdate = $_SESSION['user']['bdate'];
        $this->country = $_SESSION['user']['country'];
        $this->email = $_SESSION['user']['email'];
        $this->profile_picture = $this->find_profile_picture($this->id);
    }

    public function find_profile_picture($user_id)
    {
        $sql = "SELECT image_name FROM image WHERE user_id = '$user_id' AND is_profile_picture = 1";
        $result = $this->query($sql);
        if(count($result))
        {
            return $result[0]['image_name'];
        }
        return false;
    }

    public function get_send_messages()
    {
        $sql = "SELECT user.first_name, user.last_name, user.email, message.* FROM message LEFT JOIN user ON message.to_user_id = user.id WHERE from_user_id = '$this->id' ORDER BY message.created_at DESC";
        $result = $this->query($sql);
        return $result;
    }

    public function get_receive_messages()
    {
        $sql = "SELECT user.first_name, user.last_name, user.email, message.* FROM message LEFT JOIN user ON message.from_user_id = user.id WHERE to_user_id = '$this->id' ORDER BY message.created_at DESC";
        $result = $this->query($sql);
        return $result;
    }

    public  function dialog()
    {
        $sql = "SELECT user.first_name, user.last_name, user.email, message.* FROM message LEFT JOIN user ON message.from_user_id = user.id WHERE to_user_id = '$this->id' OR from_user_id = '$this->id' ORDER BY message.created_at DESC";
        $result = $this->query($sql);
        return $result;
    }

    public function get_parents_messages($dialog)
    {
        $parents = array();

        foreach($dialog as $dialog_item)
        {
            $parents[$dialog_item['id']] = $this->get_parents($dialog_item['parent_id']);
        }
        return $parents;
    }

//    public function test($dialog,$parent_id){
//        foreach(){
//
//        }
//
//     }

    public function get_parents($parent_id)
    {

        $sql = "SELECT * FROM message WHERE id = '$parent_id'";
        $result = $this->query($sql);
        if(isset($result[0]))
        {
            $message = $result[0]['message'];

            if($result[0]['parent_id'])
            {
                return $message."<br>".$this->get_parents($result[0]['parent_id']);
            }
            else
            {
                return $message;
            }
        }
        else
        {
            return '';
        }
    }

    public function has_new_message()
    {
        $sql = "SELECT * FROM message WHERE to_user_id = '$this->id' AND is_read = '0'";
        $result = $this->query($sql);
        if (count($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function search_user($data)
    {
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        if(isset($data['gender']))
        {
            $gender = $data['gender'];
        }
        else
        {
            $gender = '';
        }
        $bdate = $data['bdate'];
        if(isset($data['country']))
        {
            $country = $data['country'];
        }
        else
        {
            $country = '';
        }

        if($data)
        {
            $sql = "SELECT * FROM user WHERE ";
        }
        else
        {
            $sql = 'SELECT * FROM user';
        }

        if($first_name)
        {
            $sql .= "first_name LIKE '%$first_name%' ";
        }

        if($last_name){
            if($first_name){
                $sql .= " AND last_name LIKE '%$last_name%' ";
            }else{
                $sql .= " last_name LIKE '%$last_name%' ";
            }

        }
        if($gender){
            if($first_name){
                $sql .= " AND gender LIKE '$gender%' ";
            }
            elseif($last_name){
                $sql .= " AND gender LIKE '$gender%' ";
            }
            else{
                $sql .= " gender LIKE '$gender%' ";
            }

        }
        if($bdate){
            if($first_name){
                $sql .= " AND bdate LIKE '$bdate%' ";
            }
            elseif($last_name){
                $sql .= " AND bdate LIKE '$bdate%' ";
            }
            elseif($gender){
                $sql .= " AND bdate LIKE '$bdate%' ";
            }
            else{
                $sql .= " bdate LIKE '$bdate%' ";
            }

        }
        if($country){
            if($first_name){
                $sql .= " AND country LIKE '%$country%' ";
            }
            elseif($last_name){
                $sql .= " AND country LIKE '%$country%' ";
            }
            elseif($gender){
                $sql .= " AND country LIKE '%$country%' ";
            }
            elseif($bdate){
                $sql .= " AND country LIKE '%$country%' ";
            }
            else{
                $sql .= " country LIKE '%$country%' ";
            }

        }
        $result = $this->query($sql);
        return $result;
    }

    public function update_session($data)
    {
        foreach($data as $key => $value)
        {
            $_SESSION['user'][$key] = $value;
        }
    }

    public function edit_user($edit_data)
    {
//        $sql = "UPDATE user SET ";
//        $i = 1;
//        foreach($edit_data as $column => $value)
//        {
//            $sql .= "`$column` = '$value'";
//            if(count($edit_data) > $i)
//            {
//                $sql .= ",";
//            }
//            $i++;
//        }
//        $sql .= " WHERE id = ".$_SESSION['user']['id'];
//        $this->query($sql);
//
//        $this->update_session($edit_data);

        $table_name = "user";
        $array = "";
        $i = 1;
        foreach($edit_data as $column => $value)
        {
            $array = "`$column` = '$value'";
            if(count($edit_data) > $i)
            {
                $array .= ",";
            }
            $i++;
        }
        $where = "id = ".$_SESSION['user']['id'];
        $this->update($table_name, $array, $where);

        $this->update_session($edit_data);


    }

}