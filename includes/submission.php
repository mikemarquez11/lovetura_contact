<?php

namespace LoveturaContact\Submission;

class LoveturaSubmit {

    protected $submitted, $message;

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
            $headers .= array('Content-Type: text/html; charset=UTF-8');
            $headers .= 'From: ' . $_POST['name'] . ' <"' . $_POST['email'] . '">';
            $subject = "Consulta lovetura.com | New Message from " . $_POST['name'];

            ob_start();
           
            echo '<p>Nombre: ' . $_POST['name'] . '</p>
                <p>E-mail: ' . $_POST['email'] . '</p>
                <p>Edad: ' . $_POST['edad'] . '</p>
                <p>Whatsapp: ' . $_POST['whatsapp'] . '</p>
                <p>Fecha: ' . $_POST['fechasesion'] . '</p>
                <p>Sesion: ' . $_POST['sesion'] . '</p>
                <h2>Message:</h2>' .
                wpautop($_POST['mensaje']) . '
                <br />
                --
                <p><a href = "' . home_url() . '">lovetura.com</a></p>
            ';
           
            $message = ob_get_contents();
           
            ob_end_clean();

            $mail = wp_mail($to, $subject, $message, $headers);
           
            if ( $mail ) {
                $this->submitted = true;
                $this->$message = 'Mail Sent';

                echo json_encode(
                    array(
                        'submitted' => $this->submitted,
                        'message' => $this->$message,
                    )
                );

            } else {
                $this->submitted = false;
                $this->$message = 'Mail Not Sent';

                echo json_encode(
                    array(
                        'submitted' => $this->submitted,
                        'message' => $this->$message,
                    )
                );
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