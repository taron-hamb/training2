<?php

class Image extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function upload($upload_file)
    {

        if ($upload_file['fileToUpload']['error'] > 0) {
            die('An error ocurred when uploading.');
        }
        if ($upload_file['fileToUpload']['type'] != 'image/png' && $upload_file['fileToUpload']['type'] != 'image/jpeg' && $upload_file['fileToUpload']['type'] != 'image/gif') {
            die('Unsupported filetype uploaded.');
        }
        if ($upload_file['fileToUpload']['size'] > 500000) {
            die('File uploaded exceeds maximum upload size.');
        }
        if (file_exists('images/' . $upload_file['fileToUpload']['name'])) {
            die('File with that name already exists.');
        }
        $rand = rand(0, 1000);
        $file_name = $rand . '_' . $upload_file['fileToUpload']['name'];
        if (!move_uploaded_file($upload_file['fileToUpload']['tmp_name'], 'images/' . $file_name)) {
            die('Error uploading file - check destination is writeable.');
        }
        $user_id = $_SESSION['user']['id'];

        $sql = "INSERT INTO image (user_id, image_name)VALUES ('$user_id', '$file_name') ";
        $result = $this->query($sql);
        if (count($result)) {
            return true;
        } else {
            return false;
        }

    }

    public function  get_uploaded_images()
    {
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT image_name , id , is_profile_picture FROM image WHERE user_id = '$user_id'";
        $result = $this->query($sql);
        if (count($result)) {

            return $result;
        } else {
            return false;
        }
    }

    public function delete_image($image_id)
    {
//        $sql = "DELETE FROM image WHERE id='$image_id'";
        $table_name = "image";
        $this->delete($table_name, $image_id);
    }

    public function make_profile_picture($image_id,$user_id)
    {
        $sql = "UPDATE image SET is_profile_picture='0' WHERE user_id='$user_id'";

        $this->query($sql);

        $sql = "UPDATE image SET is_profile_picture='1' WHERE id='$image_id' AND user_id='$user_id'";

        $this->query($sql);
    }
}

?>