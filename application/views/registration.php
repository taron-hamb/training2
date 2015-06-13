<?php
$validation = $objects['validation'];
$countries = array( "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
?>

<form action="" method="post" id="registration_form">
    <table>
        <tr>
            <td>
                <h3>Registration</h3>
            </td>
        </tr>
        <tr>
            <td>
                <i id="login_bg"></i>
                <input type="text" name="first_name" id="first_name" autofocus placeholder="First Name" />
                <i id="first_name_incorrect" class="incorrect_hide" title="Fill the first name"></i>

            </td>

        </tr>
        <tr>
            <td>
                <i id="login_bg"></i>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" />
                <i id="last_name_incorrect" class="incorrect_hide" title="Fill the last name"></i>

            </td>

        </tr>

        <tr>
            <td>
                <div  style="float:left;background-color: #fff;width:100%;height: 20px;">
                <i id="gender_bg"></i>
                <input type="radio" name="gender" value="male" style="float:left;  margin-left: 27px;"/> <div style="float:left;color:#A9A9A9">Male</div>
                <input type="radio" name="gender" value="female" style="float:left"/> <div style="float:left;color:#A9A9A9">Female</div>
                <i id="gender_incorrect" class="incorrect_hide" title="Fill the gender"></i>
                </div>
            </td>

        </tr>

        <tr>
            <td>
                <i id="date_bg"></i>
                <script>
                    $(function() {
                        $('#popupDatepicker').datepick({dateFormat: 'yyyy-mm-dd',maxDate: +0,yearRange: "-100:+0"});
                    });
                </script>
                <input type="text" name="bdate" id="popupDatepicker" placeholder="Birth Date(yyyy-mm-dd)" style="color: #BBA9A9" maxlength="10">
                <i id="bdate_incorrect" class="incorrect_hide" title="Fill the birth date(yyyy-mm-dd)"></i>
            </td>

        </tr>

        <tr>
            <td>
                <i id="country_bg"></i>
                <select id="country" name="country">
                    <option value="Country..." disabled selected>Country...</option>
                    <?php
                        foreach($countries as $value){
                            echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                    ?>
                </select>
                <i id="country_incorrect" class="incorrect_hide" title="Fill the country"></i>

<!--           --><?php
//                var_dump($validation['country']);
//                var_dump($validation['country_is_ok']);
//
//                if($validation['country'] == 'Country...'){
//                    echo '<i id="required" title="Country is required"></i>';
//                }
//                ?>
            </td>
        </tr>
        <tr>
            <td>
                <i id="email_bg"></i>
                <input type="email" name="email" id="email" placeholder="Email" />
                <i id="email_incorrect" class="incorrect_hide" title=""></i>

<!--                --><?php
//                if($validation['email_status'] != ''){
//                    echo '<i id="required" title="';
//                    if($validation['email_status'] == 'Email is no unique'){
//                        echo 'Email is no unique';
//                    }
//                    else {
//                        echo 'Email is required';
//                    }
//                    echo '"></i>';
//                }
//                ?>
            </td>
        </tr>
        <tr>
            <td>
                <i id="password_bg"></i>
                <input type="password" name="password" id="password" autocomplete="off" placeholder="Password" />
                <i id="password_incorrect" class="incorrect_hide" title=""></i>

<!--                --><?php
//                if($validation['password'] == 'empty'){
//                    echo '<i id="required" title="Password is required"></i>';
//                }
//                if($validation['password_status'] == 'no same'){
//                    echo '<i id="required" title="Password and re_password no same"></i>';
//                }
//                ?>
            </td>
        </tr>
        <tr>
            <td>
                <i id="password_bg"></i>
                <input type="password" name="re_password" id="re_password" autocomplete="off" placeholder="Re-Password" />
                <i id="re_password_incorrect" class="incorrect_hide" title=""></i>

<!--                --><?php
//                if($validation['re_password'] == 'empty'){
//                    echo '<i id="required" title="Re_password is required"></i>';
//                }
//                if($validation['re_password_status'] == 'no same'){
//                    echo '<i id="required" title="Password and re_password no same"></i>';
//                }
//                ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" name="submit" value="Registration" id="registration_button"/>
            </td>
        </tr>
        <tr>
            <td>
                <a href="/" id="registration_link">
                    <input type="button" name="submit" value="Back" id="back"/>
                </a>
            </td>
        </tr>
    </table>
</form>