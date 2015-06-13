<?php

class ImageController extends Controller implements IController
{

    public function indexAction()
    {
        $user = new User();
        $user->become_logined_user();
        $uploaded_images = $this->get_uploaded_images();

        $fc = FrontController::getInstance();
        $result = $this->view->render('../views/images/index.php', array('images' => $uploaded_images, 'user' => $user));
        $fc->setBody($result);
    }

    public function uploadAction()
    {
        if ($_FILES) {
            $upload_file = $_FILES;
            $image = new Image();
            $file = $image->upload($upload_file);
            header("Location: /image");
//            $this->indexAction();
        }

    }

    public function get_uploaded_images()
    {
        $images = new Image();
        $images_name = $images->get_uploaded_images();
        return $images_name;
    }

    public function deleteAction()
    {
        $image_id = $_POST["image_id"];

        $image = new Image();
        $image->delete_image($image_id);
        header("Location: /image");
//        $this->indexAction();
    }

    public function make_profile_pictureAction()
    {
        $image_id = $_POST["image_id"];

        $user = new User();
        $user->become_logined_user();

        $image = new Image();

        $image->make_profile_picture($image_id,$user->get_id());

        $this->indexAction();
    }

}

?>