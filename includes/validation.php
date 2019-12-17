<?php

namespace LovetureValidate;
/**
 * Helper file for validation
 */
class Lovetura_Validate{

    public function lovesend_email() {
        check_ajax_referer( 'loveturaoutput', 'nonce' );

        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $edad = isset($_POST['edad']) ? $_POST['edad'] : '';
        $whatsapp = isset($_POST['whatsapp']) ? $_POST['whatsapp'] : '';
        $fecha_sesion = isset($_POST['fechasesion']) ? $_POST['fechasesion'] : '';
        $sesion = isset($_POST['sesion']) ? $_POST['sesion'] : '';
        $message = isset($_POST['mensage']) ? $_POST['mensage'] : '';

        wp_die();
    }
}
?>