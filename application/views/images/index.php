<?php
if ($_SESSION == array()) {
    header("Location: /");
}
else{
$user = $objects['user'];
$has_new_message = $user->has_new_message();
include('/../dashboard_head.php');
$images = $objects['images'];
?>
<div class="general_box">
    <div class="images_box">

        <div id="upload_image">
            <form action="/image/upload" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload" required>
                <input type="submit" value="Upload Image" name="submit" id="upload_button">
            </form>

        </div>

        <div id="images">
            <?php
            if ($images) {
                foreach ($images as $image) {
                    ?>
                    <div class="one_image_box">
                        <a class="example-image-link" href="/images/<?php echo $image['image_name']; ?>" data-lightbox="example-1"><img class="image" src="/images/<?php echo $image['image_name']; ?>" alt="image-<?php echo $image['id']; ?>" /></a>
                        <div style="width:114px">
                        <form action="/image/make_profile_picture" method="post" class="delete"><input type="hidden" name="image_id" value="<?php echo $image['id']; ?>"/><input type="submit" name="submit" value="Set profile picture" class="<?php echo(($image['is_profile_picture'] == 1)? 'is_profile_picture' : '' ) ?>" /></form>
                        <form action="/image/delete" method="post" class="delete"><input type="hidden" name="image_id" value="<?php echo $image['id']; ?>"/><input type="submit" name="submit" value="Delete" class="<?php echo(($image['is_profile_picture'] == 1)? 'is_profile_picture' : '' ) ?>"/></form>
                        </div>
                    </div>
                <?php
                }
            }
            ?>
        </div>

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