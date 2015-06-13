<?php
if ($_SESSION == array()) {
    header("Location: /");
}
else{
$user = $objects['user'];
$has_new_message = $user->has_new_message();
//var_dump($user_searched_picture);
$countries = array( "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
include('/../dashboard_head.php');
?>
<div class="general_box">
    <div class="images_box">

        <?php
        if(isset($objects['message']))
        {
            echo $objects['message'];
        }

        if(isset($objects['data']) && $objects['data'] == array())
        {
            echo 'There is no such user !';
        }

        if(isset($objects['data']))
        {?>
            <div style="float: left;width: 350px;">
                <?php
                for($i = 0; $i < count($objects['data']); $i++){ ?>
                    <a href="/user/guest/guest_id/<?php echo $objects['data'][$i]['id']; ?>">
                        <table>
                        <?php
                        $user_searched_picture = $user->find_profile_picture($objects['data'][$i]['id']);
                        if($user_searched_picture)
                        { ?>
                            <tr><td rowspan="6"><a class="example-image-link" href="<?php echo SITE_URL.'/images/'.$user_searched_picture; ?>" data-lightbox="example-1"><img style="width: 110px" src="<?php echo SITE_URL.'/images/'.$user_searched_picture; ?>" alt="image-1" /></a></td></tr>
                            <?php }
                        else{ ?>
                            <tr><td rowspan="6"><a class="no_picture_icon" ><img style="width: 110px" src="<?php echo SITE_URL.'/images/icon/no_picture_icon.png'; ?>" /></a></td></tr>
                        <?php } ?>
                            <tr><td>First Name: </td><td><?php echo $objects['data'][$i]['first_name']; ?></td></tr>
                            <tr><td>Last Name: </td><td><?php echo $objects['data'][$i]['last_name']; ?></td></tr>
                            <tr><td>Gender: </td><td><?php echo $objects['data'][$i]['gender']; ?></td></tr>
                            <tr><td>Birth date: </td><td><?php echo $objects['data'][$i]['bdate']; ?></td></tr>
                            <tr><td>Country: </td><td><?php echo $objects['data'][$i]['country']; ?></td></tr>
                        </table>
                    </a>
                    <hr>
                <?php } ?>
            </div>
        <?php }
        ?>

        <form action="/user/search_user" method="post" style="float: right">
            <table>
                <?php
                if(isset($objects['search_data']) && !empty($objects['search_data']))
                { ?>
                    <tr><td><i id="login_bg"></i><input type="text" name="first_name" placeholder="First Name" value="<?php echo $objects['search_data']['first_name'] ?>" autofocus/></td></tr>
                    <tr><td><i id="login_bg"></i><input type="text" name="last_name" placeholder="Last Name" value="<?php echo $objects['search_data']['last_name'] ?>" /></td></tr>
                    <tr><td><div style="float:left;background-color: #fff;width:198px;height: 20px;"><i id="gender_bg"></i><input type="radio" name="gender" value="male" <?php if(isset($objects['search_data']['gender']) && $objects['search_data']['gender'] == 'male'){echo 'checked';}else{echo '';}  ?> style="float:left;  margin-left: 27px;"/> <div style="float:left;color:#A9A9A9">Male</div><input type="radio" name="gender" value="female" <?php if(isset($objects['search_data']['gender']) && $objects['search_data']['gender'] == 'female'){echo 'checked';}else{echo '';}  ?> style="float:left"/> <div style="float:left;color:#A9A9A9">Female</div></div></td></tr>
                    <tr><td><i id="date_bg"></i>
                            <script>
                                $(function() {
                                    $('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd',maxDate: +0,yearRange: "-100:+0"});
                                });
                            </script>
                            <input type="text" name="bdate" id="popupDatepicker" value="<?php if($objects['search_data']['bdate'] != ''){echo $objects['search_data']['bdate'];} ?>" placeholder="Birth Date" style="color: #BBA9A9" maxlength="10">
                        </td>
                    </tr>
                    <tr><td><i id="country_bg"></i>
                            <select id="country" name="country">
                                <option value="Country..." disabled selected>Country...</option>
                                <?php
                                foreach($countries as $value){
                                    echo '<option value="'.$value.'" '.(($objects['search_data']['country'] == $value)? 'selected'  : '').'>'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr><td><input type="submit" name="submit" value="Search"/></td></tr>
                <?php
                }
                else
                { ?>
                    <tr><td><i id="login_bg"></i><input type="text" name="first_name" placeholder="First Name" autofocus/></td></tr>
                    <tr><td><i id="login_bg"></i><input type="text" name="last_name" placeholder="Last Name"/></td></tr>
                    <tr><td><div style="float:left;background-color: #fff;width:198px;height: 20px;"><i id="gender_bg"></i><input type="radio" name="gender" value="male" style="float:left;  margin-left: 27px;"/> <div style="float:left;color:#A9A9A9">Male</div><input type="radio" name="gender" value="female" style="float:left"/> <div style="float:left;color:#A9A9A9">Female</div></div></td></tr>
                    <tr><td><i id="date_bg"></i>
                            <script>
                                $(function() {
                                    $('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd',maxDate: +0,yearRange: "-100:+0"});
                                });
                            </script>
                            <input type="text" name="bdate" id="popupDatepicker" placeholder="Birth Date" style="color: #BBA9A9" maxlength="10">
                        </td>
                    </tr>
                    <tr><td><i id="country_bg"></i>
                            <select id="country" name="country">
                                <option value="Country..." disabled selected>Country...</option>
                                <?php
                                foreach($countries as $value){
                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr><td><input type="submit" name="submit" value="Search"/></td></tr>
                <?php
                }
                ?>

            </table>
        </form>

<!--        <script src="--><?php //echo SITE_URL; ?><!--/resource/js/jquery-1.11.0.min.js"></script>-->
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