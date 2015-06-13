<?php

class MessageController extends Controller implements IController
{
    public function indexAction()
    {
        $user = new User();
        $user->become_logined_user();
        $users = $user->all();
        $dialog = $user->dialog();
        $parents_messages = $user->get_parents_messages($dialog);
        $send_messages = $user->get_send_messages();
        $receive_messages = $user->get_receive_messages();
        $fc = FrontController::getInstance();
        $result = $this->view->render('../views/message/index.php', array('send_messages' => $send_messages, 'receive_messages' => $receive_messages, 'user' => $user, 'users' => $users, 'dialog' => $dialog, 'parents_messages' => $parents_messages));
        $fc->setBody($result);
    }

    public function sendAction()
    {
        if(isset($_POST['message']) && !empty($_POST['message'])) {
            $from_user_id = $_POST['from_user_id'];
            $to_user_id = $_POST['to_user_id'];
            $message_text = $_POST['message'];
            $parent_id = ((isset($_POST['parent_id']))? $_POST['parent_id'] : null );
            $message = new Message();
            $message->create($parent_id, $from_user_id, $to_user_id, $message_text);
            header("Location: /message");
//            $this->indexAction();
        } else {
           header("Location: /user/dashboard");
        }
    }

    public function readAction()
    {
        $message_id = $_POST['message_id'];
        $message = new Message();
        $message->set_read($message_id);
    }
}

?>