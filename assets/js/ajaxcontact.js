(function($) {

    "use strict";

    const form = {
        erroralert: document.getElementById('ajaxresponseerror'),
        messages: document.getElementById('form-messages'),
    };
    
    $("#mobile-number").intlTelInput({
        autoHideDialCode: true,
        preferredCountries: ["us","mx","pe","ve","co","cl","ar" ],
        nationalMode: false,
        utilsScript: utils_path.utils_js,
    });

    bootstrapValidate('#name', 'min:5:Ingresa tu nombre completo');
    bootstrapValidate('#email', 'email:Ingresa un correo valido');
    bootstrapValidate('#inputAge', 'max:2:Edad no valida, ingrese dos digitos');

    $('#ajaxcontactform').submit( function( event ) {
        event.preventDefault(); // Prevent the default form submit.

        var data = $(".info-form :input")
        .serialize();

        console.log(data);

        $.ajax({
            url: utils_path.ajax_url,
            data: data,
            action: 'send_info',
            method: 'POST',
            success: function(serverResponse) {
                if (serverResponse) {
                    var responseObject = JSON.parse(serverResponse);
                    handleResponse(responseObject);
                }
            },
            error: function(serverResponse) {
                console.log(serverResponse);
            }
        });

    });

    function handleResponse(responseObject) {
        if ( responseObject.validate && responseObject.messages == 'Success' ) {
            clearLog();
            prepareEmailWP(responseObject.data);
        } else {
            while (form.messages.firstChild) {
                form.messages.removeChild(form.messages.firstChild);
            }

            responseObject.messages.forEach((message) => {
            const li = document.createElement('li');
            li.textContent = message; 
            form.messages.appendChild(li);
            });
                
            form.messages.style.display = "block";
        }
    }

    function prepareEmailWP(dataEmail) {

        var action = { 'action': 'send_email' };

        var data = $.param(dataEmail) + '&' + $.param(action);

        $.ajax({
            url: utils_path.ajax_url,
            data: data,
            method: 'POST',
            success: function(serverResponse) {
                if ( serverResponse ) {
                    console.log(serverResponse);
                    var responseObject = JSON.parse(serverResponse);
                    handleResponseEmail(responseObject);            
                }
            },
            error: function(serverResponse) {
                console.log(serverResponse);
            }
        });
    }

    function handleResponseEmail(responseObject) {
        if ( responseObject.submitted ) {
            form.erroralert.remove();
            document.getElementById("ajaxcontactform").reset();
            $("#ajaxresponsesuccess").append("<h4>Tu mensaje ha sido enviado con éxito</h4>");
        }
        else if ( ! responseObject.submitted ) {
            $("#ajaxresponseerror").append("<h4>Algo salio mal, intenta de nuevo más tarde</h4>");
        }
    }

    function clearLog() {
        while (form.messages.firstChild) {
            form.messages.removeChild(form.messages.firstChild);
            form.messages.style.display = "none";
        }
    }

})(jQuery);