<?php
if ($_SESSION == array()) {
    header("Location: /");
}
else{
$user = $objects['user'];
$users = $objects['users'];
$has_new_message = $user->has_new_message();
include('/../dashboard_head.php');
$dialog = $objects['dialog'];
$parents_messages = $objects['parents_messages'];
$send_messages = $objects['send_messages'];
$receive_messages = $objects['receive_messages'];
?>
<div class="general_box">
    <div class="messages_box">

        <div id="receive_messages_box">

            <h3>Send Message</h3>
            <hr>
            <form action="/message/send" method="post">
                <table>
                    <tr>
                        <td>
                            Send message to:
                        </td>
                        <td>
                            <select name="to_user_id" style="float:right">
                                <?php foreach ($users as $to_user) {
                                    if ($to_user['id'] != $user->get_id()) {
                                        ?>
                                        <option
                                            value="<?php echo $to_user['id']; ?>"><?php echo $to_user['first_name'] . ' ' . $to_user['last_name']; ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <textarea rows="5" name="message" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" value="<?php echo $_SESSION['user']['id']; ?>" name="from_user_id"/>
                            <input type="submit" style="float: right" value="Send"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div id="messages">
            <h3>All Messages</h3>
            <hr>
            <div id="dialog_box">

                <?php foreach ($dialog as $message) { ?>
<!--                    --><?php //var_dump($message) ?>
                    <div id="<?php echo $message['id']; ?>" class="<?php if($message['from_user_id'] == $user->get_id()){echo 'message_send';}else{echo 'message_receive';} ?>">
                        <div  class="<?php if($message['from_user_id'] == $user->get_id()){echo 'send';}else{echo 'receive';} if ($message['is_read'] == '0' && $message['from_user_id'] != $user->get_id()) { ?> new_message <?php } ?> " id="<?php echo $message['id']; ?>" >

                            <div>
                                <?php echo (($message['from_user_id'] == $user->get_id())? 'To:' : 'From:'); ?><?php echo $message['first_name'], ' ', $message['last_name']; ?>
                            </div>
                            <div class="hide">
                                Email: <?php echo $message['email']; ?><br>
                                Date: <?php echo $message['created_at']; ?><br>
                                Message: <?php echo $message['message']; ?>
                            </div>

                        </div>

                    </div>


                    <div class="reply" id="reply_<?php echo $message['id'] ?>" >
                        <img src="../../images/icon/reply.png" alt="" /><div style="float: left">Reply</div>
                    </div>
                    <div class="hide" id="form_<?php echo $message['id'] ?>">
                        <form action="/message/send" method="POST">
                            <textarea rows="5" name="message" required > &#10; <?php echo $message['message']; ?> &#10;<?php echo $parents_messages[$message['id']]; ?></textarea>
                            <input type="hidden" value="<?php echo $message['id'] ?>" name="parent_id"/>
                            <input type="hidden" value="<?php echo $user->get_id() ?>" name="from_user_id"/>
                            <input type="hidden" value="<?php echo (($message['from_user_id'] == $user->get_id())? $message['to_user_id'] : $message['from_user_id'] ) ?>" name="to_user_id"/>
                            <div style="float:left; width: 100%"><input type="submit" style="float: right" value="Send"/></div>
                        </form>
                    </div>


                    <hr>
                <?php } ?>
            </div>
        </div>

<!--        <div id="receive_messages_box">-->
<!--            <h3>Receive messages</h3>-->
<!--            <hr>-->
<!--            --><?php //foreach ($receive_messages as $receive_message) { ?>
<!--                <div id="--><?php //echo $receive_message['id']; ?><!--"-->
<!--                     class="receive_message --><?php //if ($receive_message['is_read'] == '0') { ?><!-- new_message --><?php //} ?><!-- ">-->
<!--                    <div>-->
<!--                        From: --><?php //echo $receive_message['first_name'], ' ', $receive_message['last_name']; ?><!--<br>-->
<!--                    </div>-->
<!--                    <div class="hide">-->
<!--                        Email: --><?php //echo $receive_message['email']; ?><!--<br>-->
<!--                        Date: --><?php //echo $receive_message['created_at']; ?><!--<br>-->
<!--                        Message: --><?php //echo $receive_message['message']; ?>
<!--                    </div>-->
<!--                </div>-->
<!--                <hr>-->
<!--            --><?php //} ?>
<!--        </div>-->
<!--        <div id="send_messages_box">-->
<!--            <h3>Send messages</h3>-->
<!--            <hr>-->
<!---->
<!--            --><?php //foreach ($send_messages as $send_message) { ?>
<!--                <div class="send_message">-->
<!--                    To: --><?php //echo $send_message['first_name'], ' ', $send_message['last_name']; ?><!--<br>-->
<!---->
<!--                    <div class="hide">-->
<!--                        Email: --><?php //echo $send_message['email']; ?><!--<br>-->
<!--                        Date: --><?php //echo $send_message['created_at']; ?><!--<br>-->
<!--                        Message: --><?php //echo $send_message['message']; ?>
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--                <hr>-->
<!--            --><?php //} ?>
<!--        </div>-->






    </div>


</div>
<?php } ?>