$(document).ready(function(){

    function return_countries()
    {
        var countries = [ "Country...", "Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"];
        return countries;
    }

    function validateDate(date)
    {
        var dateReg = /^(([1-9]{1,1})+([0-9]{3,3})+([-]{1,1})+([0-1]{1,1})+([0-9]{1,1})+([-]{1,1})+([0-3]{1,1})+([0-9]{1,1})$)/;
        return dateReg.test( date );
    }


    var login = function(){

        //Login validation
        var email = $("#login").val();
        var password = $("#password").val();

        $.ajax({
            type: "POST",
            url: "user/login",
            data: ({email : email, password: password}),
            success: function(success) {
                if(success == 'incorrect data'){
                    $("#email_incorrect").removeClass("incorrect_hide").addClass("incorrect");
                    $("#password_incorrect").removeClass("incorrect_hide").addClass("incorrect");
                }
                else if(success == 'logined'){
                    window.location.href = "user/dashboard";
                }
                console.log(success);
            }


        });


    };
    $('#login_button').click(login);
    $("#login_form").keypress(function() {
        if (event.which == 13) login();
    });//The End login

        var registration = function(){

        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var gender = $("input[name='gender']:checked").val();
        var bdate = $("#popupDatepicker").val();
        var email_is_ok = '';
        var password_is_ok = '';

        //First name validation
        if(first_name == ''){
            $("#first_name_incorrect").removeClass("incorrect_hide").addClass("incorrect");
        }
        else{
            $("#first_name_incorrect").removeClass("incorrect").addClass("incorrect_hide");
        }

        //Last name validation
        if(last_name == ''){
            $("#last_name_incorrect").removeClass("incorrect_hide").addClass("incorrect");
        }
        else{
            $("#last_name_incorrect").removeClass("incorrect").addClass("incorrect_hide");
        }

        //Gender name validation
        if(gender != 'male' && gender != 'female'){
            $("#gender_incorrect").removeClass("incorrect_hide").addClass("gender_incorrect");
        }
        else{
            $("#gender_incorrect").removeClass("gender_incorrect").addClass("incorrect_hide");
        }

        //Bday validation
        if(validateDate(bdate))
        {
            $("#bdate_incorrect").removeClass("incorrect").addClass("incorrect_hide");
        }
        else
        {
            $("#bdate_incorrect").removeClass("incorrect_hide").addClass("incorrect");
        }

        //Country validation
        var choosen_country = $('select[name="country"] option:selected').val();
        var  country_is_ok = null;

        $.each(return_countries(), function(id, value){
            if(choosen_country == value && choosen_country != "Country..."){
                $("#country_incorrect").removeClass("incorrect").addClass("incorrect_hide");
                country_is_ok = 'ok';
            }
        });
        if (country_is_ok != 'ok'){
            $("#country_incorrect").removeClass("incorrect_hide").addClass("incorrect");
        }

        //Email validation
        var email = $('#email').val();
        function validateEmail(email) {
            var emailReg = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return emailReg.test( email );
        }
        if(!validateEmail(email)){
            $("#email_incorrect").removeClass("incorrect_hide").addClass("incorrect");
            $("#email_incorrect").attr("title", "Email is incorrect");
        }
        else{
            $("#email_incorrect").removeClass("incorrect").addClass("incorrect_hide");
            $.ajax({
                type: "POST",
                url: "is_unique_email",
                data: ({email: email}),
                success: function(success) {
                    if(success == 'not unique'){
                        $("#email_incorrect").removeClass("incorrect_hide").addClass("incorrect");
                        $("#email_incorrect").attr("title", "Email is not unique");
                    }
                    else if(success == 'unique'){
                        $("#email_incorrect").removeClass("incorrect").addClass("incorrect_hide");
                        email_is_ok = 'ok';
                        console.log(email_is_ok);
                    }
                },
                async: false

            });

        }
        console.log(email_is_ok);

        //Password validation
        var password = $("#password").val();
        var re_password = $("#re_password").val();
        if(password == re_password){
            if(password.length < 6){
                $("#password_incorrect").removeClass("incorrect_hide").addClass("incorrect");
                $("#password_incorrect").attr("title", "Password length will by minimum 6");
                $("#re_password_incorrect").removeClass("incorrect_hide").addClass("incorrect");
                $("#re_password_incorrect").attr("title", "Password length will by minimum 6");
            }
            else{
                $("#password_incorrect").removeClass("incorrect").addClass("incorrect_hide");
                $("#re_password_incorrect").removeClass("incorrect").addClass("incorrect_hide");
                password_is_ok = 'ok';
            }
        }
        else{
            $("#password_incorrect").removeClass("incorrect_hide").addClass("incorrect");
            $("#password_incorrect").attr("title", "Password and re_password not same");
            $("#re_password_incorrect").removeClass("incorrect_hide").addClass("incorrect");
            $("#re_password_incorrect").attr("title", "Password and re_password not same");
        }


        if(first_name != '' && last_name != '' && (gender == 'male' || gender == 'female') && validateDate(bdate) && country_is_ok == 'ok' && email_is_ok == 'ok' && password_is_ok == 'ok' ){
            $.ajax({
                type: "POST",
                url: "register",
                data: ({first_name : first_name, last_name : last_name, gender : gender, bdate : bdate , country : choosen_country, email : email, password : password,re_password : re_password}),
                success: function(success) {
                    if(success == 'incorrect data'){
                        console.log(success);
                    }
                    else if(success == 'ok'){
                        window.location.href = "dashboard";
                    }

                }

            });

        }

    };
    $('#registration_button').click(registration);
    $("#registration_form").keypress(function() {
        if (event.which == 13) registration();
    });//The End registration

    var edit = function(e){
        e.preventDefault();

        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var gender = $("input[name='gender']:checked").val();
        var bdate = $("#popupDatepicker").val();

        //First name validation
        if(first_name == ''){
            $("#first_name_incorrect").removeClass("incorrect_hide").addClass("incorrect");
        }
        else{
            $("#first_name_incorrect").removeClass("incorrect").addClass("incorrect_hide");
        }

        //Last name validation
        if(last_name == ''){
            $("#last_name_incorrect").removeClass("incorrect_hide").addClass("incorrect");
        }
        else{
            $("#last_name_incorrect").removeClass("incorrect").addClass("incorrect_hide");
        }

        //Gender name validation
        if(gender != 'male' && gender != 'female'){
            $("#gender_incorrect").removeClass("incorrect_hide").addClass("gender_incorrect");
        }
        else{
            $("#gender_incorrect").removeClass("gender_incorrect").addClass("incorrect_hide");
        }

        //Bdate validation
        if(validateDate(bdate))
        {
            $("#bdate_incorrect").removeClass("incorrect").addClass("incorrect_hide");
        }
        else
        {
            $("#bdate_incorrect").removeClass("incorrect_hide").addClass("incorrect");
        }

        //Country validation
        var choosen_country = $('select[name="country"] option:selected').val();
        var  country_is_ok = null;

        $.each(return_countries(), function(id, value){
            if(choosen_country == value && choosen_country != "Country..."){
                $("#country_incorrect").removeClass("incorrect").addClass("incorrect_hide");
                country_is_ok = 'ok';
            }
        });
        if (country_is_ok != 'ok'){
            $("#country_incorrect").removeClass("incorrect_hide").addClass("incorrect");
        }

        if(first_name != '' && last_name != '' && (gender == 'male' || gender == 'female') && validateDate(bdate) && country_is_ok == 'ok')
        {
            var valid = null;
            $.ajax({
                type: "POST",
                url: "/user/edit_user",
                data: ({first_name : first_name, last_name : last_name, gender : gender, bdate : bdate , country : choosen_country}),
                success: function(success) {
                    valid = success;
                },
                async: false
            });
            if(valid == 'incorrect data'){
                console.log(valid);
            }
            else if(valid == 'ok'){
                window.location.href = "dashboard";
            }

        }


    };
    $('#edit_button').click(edit);
    $("#edit_form").keypress(function() {
        if (event.which == 13) edit();
    });//The End Edit

});//The End