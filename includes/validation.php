<?php

namespace LoveturaContact\Validate;
/**
 * Helper file for validation
 */
class LoveturaValidate {

    protected $fields = array('name', 'email', 'edad', 'whatsapp', 'fechasesion', 'sesion', 'mensaje'); 

    public function validate_data() {
        check_ajax_referer( 'loveturaoutput', 'nonce' );

        foreach( $this->fields as $field ) {
            $data[$field] = isset( $_POST[$field]) ? $_POST[$field] : '';
        }

        $validate = true;
        $error_messages = array();

        foreach( $data as $dat => $value ) {
            if ( ! isset( $value ) || empty( $value ) ){
                $validate = false;
                $error_messages[] = "$dat es requerido";
            }
        }
        
        if( ! is_email( $data['email'] ) ) {
            $validate = false;
            $error_messages[] = 'Ingresa un email valido';
        }

        if ($validate){ 
            $error_messages[] = 'Success';
        }

        echo json_encode(
            array(
                'validate' => $validate,
                'messages' => $error_messages,
                'data' => $data
            )
        );

        wp_die();
    }
}
?>