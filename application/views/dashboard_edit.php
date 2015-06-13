<?php
if ($_SESSION == array()) {
    header("Location: /");
} else {
    $user = $objects['user'];
    $has_new_message = $user->has_new_message();
    $countries = array( "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    include('dashboard_head.php');
    ?>
    <div class="general_box">
        <div class="general">
            <form action="/user/edit_user" method="POST" id="edit_form">
                <table>
                    <tr>
                        <td>
                            <label for="first_name">First name:</label>
                        </td>
                        <td>
                            <i id="login_bg"></i>
                            <input type="text" name="first_name" id="first_name" value="<?php echo $_SESSION['user']['first_name']; ?>" placeholder="First name"/>
                            <i id="first_name_incorrect" class="incorrect_hide" title="Fill the first name"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="last_name">Last name:</label>
                        </td>
                        <td>
                            <i id="login_bg"></i>
                            <input type="text" name="last_name" id="last_name" value="<?php echo $_SESSION['user']['last_name']; ?>" placeholder="Last name"/>
                            <i id="last_name_incorrect" class="incorrect_hide" title="Fill the last name"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Gender:
                        </td>
                        <td>

                            <div style="float:left;background-color: #fff;width:198px;height: 20px;">
                                <i id="gender_bg"></i>
                                <input type="radio" name="gender" value="male" <?php if($_SESSION['user']['gender'] == 'male'){echo 'checked';}else{echo '';}  ?> style="float:left;  margin-left: 27px;"/>
                                    <div style="float:left;color:#000">Male</div>
                                <input type="radio" name="gender" value="female" <?php if($_SESSION['user']['gender'] == 'female'){echo 'checked';}else{echo '';}  ?> style="float:left"/>
                                    <div style="float:left;color:#000">Female</div>
                                <i id="gender_incorrect" class="incorrect_hide" title="Fill the gender"></i>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="popupDatepicker">Birth date:</label>
                        </td>
                        <td>
                            <i id="date_bg"></i>
                            <script>
                                $(function() {
                                    $('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd',maxDate: +0,yearRange: "-100:+0"});
                                });
                            </script>
                            <input type="text" name="bdate" id="popupDatepicker" value="<?php echo $_SESSION['user']['bdate'] ?>" maxlength="10">
                            <i id="bdate_incorrect" class="incorrect_hide" title="Fill the birth date(yyyy-mm-dd)"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="country">Country:</label>
                        </td>
                        <td>
                            <i id="country_bg"></i>
                            <select id="country" name="country">
                                <option value="Country..." disabled selected>Country...</option>
                                <?php
                                foreach($countries as $value){
                                    echo '<option value="'.$value.'" '.(($_SESSION['user']['country'] == $value)? 'selected'  : '').' style="color:#000">'.$value.'</option>';
                                }
                                ?>
                            </select>
                            <i id="country_incorrect" class="incorrect_hide" title="Fill the country"></i>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">

                            <input type="submit" value="Save" id="edit_button">
                        </td>
                    </tr>

                </table>
            </form>


<!--            <script src="--><?php //echo SITE_URL; ?><!--/resource/js/jquery-1.11.0.min.js"></script>-->
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
<?php
}
?>