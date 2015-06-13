<?php
$validation_login = $objects['validation_login'];
?>
    <form action="" method="post" id="login_form">
        <table>
            <tr>
                <td>
                    <h3>Login</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <i id="login_bg"></i>
                    <input type="email" name="email" id="login" value="<?php echo ($validation_login['email'] == 'empty') ? '' : $validation_login['email'] ?>" autofocus placeholder="Email" />
                    <i id="email_incorrect" class="incorrect_hide" title=""></i>

                    <!--                    --><?php
//
//                    if($validation_login['incorrect'] == 'incorrect'){
//                        echo '<i id="required" title="';
//                        echo 'Incorrect Email or Password';
//                        echo '"></i>';
//                    }
//                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <i id="password_bg"></i>
                    <input type="password" name="password" id="password"  autocomplete="off" placeholder="Password" />
                    <i id="password_incorrect" class="incorrect_hide" title=""></i>
                    <!--                    --><?php
//                    if($validation_login['incorrect'] == 'incorrect'){
//                        echo '<i id="required" title="';
//                        echo 'Incorrect Email or Password';
//                        echo '"></i>';
//                    }
//                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" name="submit" value="Log In" id="login_button"/>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="/user/registration" id="registration_link">
                        <input type="button" name="submit" value="Create account" id="create_account"/>
                    </a>
                </td>

            </tr>
        </table>
    </form>
<?php

?>
