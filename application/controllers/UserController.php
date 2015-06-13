<?php

class UserController extends Controller implements IController
{

    public $countries = array( "Country...", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");


    public function validateDate($date)
    {
        $dateReg = "/^(([1-2]{1,1})+([0-9]{3,3})+([-]{1,1})+([0-1]{1,1})+([0-9]{1,1})+([-]{1,1})+([0-3]{1,1})+([0-9]{1,1})$)/";
        return preg_match($dateReg, $date);
    }

    public function registrationAction()
    {
        if ($_SESSION != array()) {
            if (isset($_SESSION['is_login']) && !empty($_SESSION['is_login'])) {
                header("Location: /user/dashboard");
            }
        } else {
            $validation['first_name'] = '';
            $validation['last_name'] = '';
            $validation['country'] = '';
            $validation['email'] = '';
            $validation['email_status'] = '';
            $validation['password'] = '';
            $validation['password_status'] = '';
            $validation['re_password'] = '';
            $validation['re_password_status'] = '';
            $validation['country_is_ok'] = '';

            $fc = FrontController::getInstance();
            $result = $this->view->render('../views/registration.php', array('validation' => $validation));
            $fc->setBody($result);
        }
    }

    public function registerAction()
    {
        $validation = array();

        if ($_POST != array())
        {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $gender = $_POST['gender'];
            $bdate = $_POST['bdate'];
            $email = $_POST['email'];
            $country = $_POST['country'];
            $password = $_POST['password'];
            $re_password = $_POST['re_password'];

            if (empty($first_name))
            {
                $validation['first_name'] = 'empty';
            }
            else
            {
                $validation['first_name'] = $first_name;
            }

            if (empty($last_name))
            {
                $validation['last_name'] = 'empty';
            }
            else
            {
                $validation['last_name'] = $last_name;
            }

            if ($gender == 'male' || $gender == 'female')
            {
                $validation['gender'] = $gender;
            }

            if ($this->validateDate($bdate))
            {
                $validation['bdate'] = $bdate;
            }
            else
            {
                $validation['bdate'] = 'empty';
            }

            if(!isset($country) && empty($country))
            {
                $country = '';
            }
            else{
                foreach($this->countries as $value)
                {
                    if($country == $value && $country != 'Country...')
                    {
                        $validation['country'] = $country;
                        $validation['country_is_ok'] = 'ok';
                    }
                }
            }

            if($validation['country_is_ok'] != 'ok')
            {
                $validation['country'] = 'Country...';
                $validation['country_is_ok'] = '';
            }



            if (!$this->validEmail($email))
            {
                $validation['email'] = $email;
                $validation['email_status'] = 'Email is no valid';
            }
            else
            {
                if (!$this->is_unique_email($email))
                {
                   $validation['email'] = $email;
                   $validation['email_status'] = 'Email is no unique';
                }
                else
                {
                    $validation['email'] = $email;
                    $validation['email_status'] = '';
                }
            }

            if(!empty($password) &&  isset($password))
            {
                $validation['password'] = $password;
            }
            else
            {
                $validation['password'] = 'empty';
            }
            if(!empty($re_password) &&  isset($re_password))
            {
                $validation['re_password'] = $re_password;
            }
            else
            {
                $validation['re_password'] = 'empty';
            }

            if($validation['password'] != 'empty' && $validation['re_password'] != 'empty')
            {
                if($password != $re_password)
                {
                    $validation['password_status'] = 'no same';
                    $validation['re_password_status'] = 'no same';
                }
                else
                {
                    $validation['password_status'] = '';
                    $validation['re_password_status'] = '';
                }
            }
            else
            {
                $validation['password_status'] = 'no same';
                $validation['re_password_status'] = 'no same';
            }


            if($validation['first_name'] != 'empty' && $validation['last_name'] != 'empty' && $validation['gender'] != 'empty'
                && $validation['bdate'] != 'empty' && $validation['country'] != 'Country...' && $validation['country_is_ok'] == 'ok'
                && $validation['email_status'] == '' && $validation['password'] != 'empty' && $validation['re_password'] != 'empty'
                && $validation['password_status'] != 'no same' && $validation['re_password_status'] != 'no same')
            {
                $password = hash('md5', $password);

                $user = new User();
                $user->register($first_name, $last_name, $gender, $bdate, $country, $email, $password);

                $is_login = $user->login($email, $password);
                if ($is_login)
                {
                    echo 'ok';
                }
                else
                {
                    echo 'incorrect data';
                }
            }
            else
            {
                $fc = FrontController::getInstance();
                $result = $this->view->render('../views/registration.php', array('validation' => $validation));
                $fc->setBody($result);
            }


        }
        else
        {
            $validation = array();
            $fc = FrontController::getInstance();
            $result = $this->view->render('../views/registration.php', array('validation', $validation));
            $fc->setBody($result);
        }

    }

    public function validEmail($email)
    {
        $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
        if (preg_match($regex, $email)) {
            return true;
        } else {
            return false;
        }

    }

    public function is_unique_email($email)
    {
        $user = new User();
        $is_unique = $user->is_unique_email($email);
        return $is_unique;

    }

    public function is_unique_emailAction()
    {
        $email = $_POST['email'];
        $user = new User();
        $is_unique = $user->is_unique_email($email);
        if($is_unique){
            echo 'unique';
        }
        else{
            echo 'not unique';
        }

    }

    public function is_email_and_password_okAction()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new User();
        $is_ok = $user->login($email, $password);
        if($is_ok){
            echo 'ok';
        }
        else{
            echo 'not ok';
        }

    }


    public function loginAction()
    {
        $validation_login = array();

        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash = '';
        if (!empty($email)) {
            $validation_login['email'] = $email;
        }
        else{
            $validation_login['email'] = 'empty';
        }
        if ((!empty($password) && isset($password))) {
            $hash = hash('md5',$password);
            $validation_login['password'] = $hash;
        }
        else {
            $validation_login['password'] = 'empty';
        }

        if($validation_login['email'] != 'empty' && $validation_login['password'] != 'empty'){
            $user = new User();

            $is_login = $user->login($email, $hash);
            if ($is_login) {
                echo 'logined';
            }
            else{
                echo 'incorrect data';
            }
        }
        else {
            echo 'incorrect data';
        }
    }

    public function dashboardAction()
    {
        $user = new User();
        $user->become_logined_user();
        $users = $user->all();
        $fc = FrontController::getInstance();
        $result = $this->view->render('../views/dashboard.php', array('user' => $user, 'users' => $users));
        $fc->setBody($result);
    }

    public function log_outAction()
    {
        session_unset();
        header("Location: / ");
    }

    public function error_page()
    {
        $fc = FrontController::getInstance();
        $result = $this->view->render('../views/error-404.php', array());
        $fc->setBody($result);
    }

    public function searchAction()
    {
        $user = new User();
        $user->become_logined_user();
        $fc = FrontController::getInstance();
        $result = $this->view->render('../views/search/search.php', array('user' => $user));
        $fc->setBody($result);
    }

    public function search_userAction()
    {
        $user = new User();
        $user->become_logined_user();
        $data = null;
        if(empty($_POST['first_name']) && empty($_POST['last_name']) && empty($_POST['gender']) && empty($_POST['bdate']) && empty($_POST['country']))
        {
            $message = 'Fill the rows !';

            $fc = FrontController::getInstance();
            $result = $this->view->render('../views/search/search.php', array('user' => $user, 'message' => $message));
            $fc->setBody($result);
        }
        else{
            $search_data = $_POST;
            $data = $user->search_user($search_data);


            $fc = FrontController::getInstance();
            $result = $this->view->render('../views/search/search.php', array('user' => $user, 'data' => $data, 'search_data' => $search_data));
            $fc->setBody($result);
        }


    }

    public function guestAction()
    {
        $params = new FrontController();
        $id = $params->getParams();

        $user = new User();
        $user_auth = $user->become_logined_user();

        $user_searched = $user->searched_user($id['guest_id']);
        $user_searched_picture = $user->find_profile_picture($id['guest_id']);

        $fc = FrontController::getInstance();
        $result = $this->view->render('../views/guest.php', array('user' => $user, 'user_searched' => $user_searched[0], 'user_searched_picture' => $user_searched_picture));
        $fc->setBody($result);
    }

    public function editAction()
    {
        $user = new User();
        $user->become_logined_user();

        $fc = FrontController::getInstance();
        $result = $this->view->render('../views/dashboard_edit.php', array('user' => $user));
        $fc->setBody($result);
    }

    public function edit_userAction()
    {
        $validation = array();
        $edit_data = $_POST;

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $bdate = $_POST['bdate'];
        $country = $_POST['country'];

        if (empty($first_name))
        {
            $validation['first_name'] = 'empty';
        }
        else
        {
            $validation['first_name'] = $first_name;
        }

        if (empty($last_name))
        {
            $validation['last_name'] = 'empty';
        }
        else
        {

            $validation['last_name'] = $last_name;
        }

        if ($gender == 'male' || $gender == 'female')
        {

            $validation['gender'] = $gender;
        }

        if ($this->validateDate($bdate))
        {

            $validation['bdate'] = $bdate;
        }
        else
        {

            $validation['bdate'] = 'empty';
        }

        if(!isset($country) && empty($country))
        {

            $country = '';

        }else{

            foreach($this->countries as $value)
            {
                if($country == $value && $country != 'Country...')
                {
                    $validation['country'] = $country;
                    $validation['country_is_ok'] = 'ok';
                }
            }

            if($validation['country_is_ok'] != 'ok')
            {
                $validation['country'] = 0;
                $validation['country_is_ok'] = '';
            }
        }


//        echo "<pre>";
//        var_dump( $validation['country'], $validation['country_is_ok']);
//        var_dump($validation['first_name'],$validation['last_name'],$gender,$validation['bdate'],$validation['country'], $validation['country_is_ok']);exit;

//        var_dump($validation['first_name']);
        if($validation['first_name'] != 'empty' && $validation['last_name'] != 'empty' && ($gender == 'male' || $gender == 'female')
        && $validation['bdate'] != 'empty' && $validation['country_is_ok'] == 'ok')
        {
            $user = new User();
            $user->become_logined_user();
            $user->edit_user($edit_data);
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            {
                echo "ok";
            }
            else
            {
                header("Location: /user/dashboard");
            }
        }
        else
        {
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            {
                echo "incorrect data";
            }
            else
            {
                $user = new User();
                $user->become_logined_user();
                
                $fc = FrontController::getInstance();
                $result = $this->view->render('../views/dashboard_edit.php', array('user' => $user ,'validation' => $validation));
                $fc->setBody($result);
            }
        }
    }
}

?>