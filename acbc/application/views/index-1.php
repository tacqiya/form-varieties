<script src="assets/js/jquery-latest.min.js"></script>

<link rel="stylesheet" href="<?=base_url()?>assets/plugins/jqueryConfirm/dist/jquery-confirm.min.css" />
<link rel="stylesheet" href="<?=base_url()?>assets/plugins/jqueryConfirm/css/jquery-confirm.custom.min.css" />
<script src="<?=base_url()?>assets/plugins/jqueryConfirm/dist/jquery-confirm.min.js"></script>


<form id="register-form" action="<?= base_url(); ?>"  method="POST" enctype="multipart/form-data">
<label>First Name</label><input type="text" name="firstname" placeholder="First Name" required/><br/><br>
<label>Last Name</label><input type="text" name="lastname" required/><br><br>
<label>Country</label>
<select name="country" id="country" required>
    <option value="">Select country</option>
</select>
<br><br>
<label>Affiliation</label><input type="text" name="affiliation" required/><br><br>
<label>Email</label><input type="text" name="email" id="email" required/><br><br>
<label>Confirm email</label><input type="text" name="confirm_email" id="r-email" required/><br><br>
<label>Type of Presentation</label><input type="radio" name="presentation" value="Podium"required/>Podium<input type="radio" name="presentation" value="Poster"required/>Poster<input type="radio" name="presentation" value="Either"required/>Either<br><br>
<label>Conference Topic</label>
<input type="checkbox" name="conference[]" value="Applied and Clinical Anatomy"/>Applied and Clinical Anatomy
<input type="checkbox" name="conference[]" value="Embryology and Cellular Biology"/>Embryology and Cellular Biology
<input type="checkbox" name="conference[]" value="Tissue Engineering and Precision Medicine"/>Tissue Engineering and Precision Medicine
<input type="checkbox" name="conference[]" value="Education and Pedagogy"/>Education and Pedagogy
<input type="checkbox" name="conference[]" value="Arts in Life Sciences: (Exhibition non-presentation)"/>Arts in Life Sciences: (Exhibition non-presentation)
<br><br>
<label>Abstract title</label><input type="text" name="abstract_title" required/><br><br>
<label>Abstract (file)</label><input type="file" name="abstract" accept=".doc, .docx, .pdf" required/><br><br>
<input type="submit" id="submit-btn" />
</form>
<script>

    var country_list = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"];
    $.each(country_list, function() {
        $('#country').append($("<option />").val(this).text(this));
    });

    $("#r-email").on("focusout", function() {
        var mail = $('#email').val();
        var rmail = $('#r-email').val();
        if (mail != '') {
            if (rmail != mail) {
                $.dialog({
                    type: 'red',
                    title: 'Failed',
                    content: 'Email is not matching',
                    boxWidth: '30%',
                    useBootstrap: false,
                });
                return false;
            }
        }
    });
    $("#email").on("focusout", function() {
        var mail = $('#email').val();
        var rmail = $('#r-email').val();
        if (rmail != '') {
            if (rmail != mail) {
                $.dialog({
                    type: 'red',
                    title: 'Failed',
                    content: 'Email is not matching',
                    boxWidth: '30%',
                    useBootstrap: false,
                });
                return false;
            }
        }
    });

$("#submit-btn").on("click", function() {
        var form = $('#register-form')[0];
        var warnArray = [];
        for (var i = 0; i < form.elements.length; i++) {
            if (form.elements[i].value === '' && form.elements[i].hasAttribute('required')) {
                    var cont = '<strong style="text-transform: capitalize;">' + $(form.elements[i]).attr('placeholder') + '</strong> is required<br><br>';
                warnArray.push(cont);
            }
        }
        if($('input[name="conference[]"]:checked').length < 1) {
            var cont = '<strong style="text-transform: capitalize;">Conference Topic</strong> is required<br><br>';
            warnArray.push(cont);
        }
        if (cont) {
            $.dialog({
                type: 'orange',
                title: 'Warning',
                content: warnArray,
                boxWidth: '30%',
                useBootstrap: false,
            });
            return false;
        }
    });

$("#register-form").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);
        var actionUrl = form.attr('action');
        var mail = $('#email').val();
        var rmail = $('#r-email').val();
        if (rmail != mail) {
            $.dialog({
                type: 'red',
                title: 'Failed',
                content: 'Email is not matching',
                boxWidth: '30%',
                useBootstrap: false,
            });
            return false;
        }

        $.ajax({
            url: actionUrl,
            type: "POST",
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            async: false,
            success: function(data) {
                if (!data['error']) {
                    $.dialog({
                        type: 'green',
                        title: 'Success',
                        content: data['message'],
                        boxWidth: '30%',
                        useBootstrap: false,
                    });
                    $('#register-form')[0].reset();
                } else {
                    $.dialog({
                        type: 'red',
                        title: 'Failed',
                        content: data['message'],
                        boxWidth: '30%',
                        useBootstrap: false,
                    });
                }
            },
            error: function(error) {
                $.dialog({
                    type: 'red',
                    title: 'Failed',
                    content: 'Something went wrong',
                    boxWidth: '30%',
                    useBootstrap: false,
                });
            }
        });
    });

</script>