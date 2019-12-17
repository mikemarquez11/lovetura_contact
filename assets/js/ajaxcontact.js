(function($) {

    "use strict";
    
    $("#mobile-number").intlTelInput({
        autoHideDialCode: true,
        preferredCountries: ["us","mx","pe","ve","co","cl","ar" ],
        nationalMode: false,
        utilsScript: utils_path.utils_js
    });

    bootstrapValidate('#name', 'min:5:Ingresa tu nombre completo');
    bootstrapValidate('#email', 'email:Ingresa un correo valido');
    bootstrapValidate('#inputAge', 'max:2:Edad no valida, ingrese dos digitos');

    $('#ajaxcontactform').submit( function( event ) {
        event.preventDefault(); // Prevent the default form submit.

        $('#hiddenAJAXAction').val('send_info');

        var data = $(".info-form :input")
        .serialize();

        console.log(data);

        $.ajax({
            url: utils_path.ajax_url,
            data: data,
            method: 'POST',
            success: function(serverResponse) {
                console.log('success');
            },
            error: function(serverResponse) {
                console.log('error');
            }
        });

    });

})(jQuery);