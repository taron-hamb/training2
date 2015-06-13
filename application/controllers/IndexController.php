<?php

class IndexController extends Controller implements IController
{

    function  indexAction()
    {
        if ($_SESSION != array()) {
            if (isset($_SESSION['is_login']) && !empty($_SESSION['is_login'])) {
                header("Location: /user/dashboard");
            }
        } else {
            $validation_login = array();
            $validation_login['email'] = '';
            $validation_login['password'] = '';
            $validation_login['incorrect'] = '';

            $fc = FrontController::getInstance();
            $result = $this->view->render('../views/index.php', array('validation_login'  => $validation_login));
            $fc->setBody($result);
        }
    }
}

?>