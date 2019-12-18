<?php

namespace LoveturaContact\Submission;

class LoveturaSubmit {

    /**
    * Submission of data.
    *
    * Using wp_email()
    *
    * @since 1.0.2
    * @access private
    */
    public function sendLoveturaEmail() {

        if ( isset( $_POST['mensaje'] ) ) { 
            $to = 'mimarle_elmejor@hotmail.com';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
            $headers .= 'From: abc@gmail.com' . "\r\n";
            //$headers .= 'From: ' . $_POST['name'] . ' <"' . $_POST['email'] . '">';
            $subject = "lovetura.com | New Message from " . $_POST['name'];
            $message = $_POST['mensaje'];

            /*ob_start();
           
            echo '
                <h2>Message:</h2>' .
                wpautop($_POST['message']) . '
                <br />
                --
                <p><a href = "' . home_url() . '">www.carlofontanos.com</a></p>
            ';
           
            $message = ob_get_contents();
           
            ob_end_clean();*/

            $mail = wp_mail($to, $subject, $message, $headers);
           
            if ( $mail ) {
                echo 'Mail Sent';
            } else {
                echo 'Mail not Sent';
            }
       
        exit();

        wp_die();
    }
}

    public function lc_mail_content_type(){
        return "text/html";    
    }

}
?>