<?php
if ($_SESSION == array()) {
    header("Location: /");
}
else{
    $user = $objects['user'];
    $user_searched = $objects['user_searched'];
    $user_searched_picture = $objects['user_searched_picture'];
    $has_new_message = $user->has_new_message();
    include('dashboard_head.php');
    ?>
    <div class="general_box">
        <div class="general">
            <table>
                <?php
                if($user_searched_picture)
                {
                    ?>
                    <tr>
                        <td colspan="2">
                            <a class="example-image-link" href="<?php echo SITE_URL.'/images/'.$user_searched_picture; ?>" data-lightbox="example-1"><img style="width: 340px" src="<?php echo SITE_URL.'/images/'.$user_searched_picture; ?>" alt="image-1" /></a>

                        </td>
                    </tr>
                <?php }
                else{ ?>
                    <tr>
                        <td colspan="2">
                            <a class="no_picture_icon" href="#"><img style="width: 340px" src="<?php echo SITE_URL.'/images/icon/no_picture_icon.png'; ?>" /></a>

                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2">
                        <h3><?php echo $user_searched['first_name'], ' ', $user_searched['last_name']; ?></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        Email:
                    </td>
                    <td>
                        <?php echo $user_searched['email']; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Gender:
                    </td>
                    <td>
                        <?php echo $user_searched['gender']; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Birth date:
                    </td>
                    <td>
                        <?php echo $user_searched['bdate'];
                        echo ' ('.date_diff(date_create($user_searched['bdate']), date_create('today'))->y.')'; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Country:
                    </td>
                    <td>
                        <?php echo $user_searched['country']; ?>
                    </td>
                </tr>


            </table>


            <script src="<?php echo SITE_URL; ?>/resource/js/jquery-1.11.0.min.js"></script>
            <script src="<?php echo SITE_URL; ?>/resource/js/lightbox.js"></script>

            <script>
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-2196019-1']);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();
            </script>
        </div>
    </div>
<?php } ?>