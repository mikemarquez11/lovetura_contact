<?php
/**
 * Admin Page View
 * 
 * Template
 */
$sesiones = get_option('sesiones');
?>
<div class="wrap">
<style>
    * { font-family:Arial; }
h2 { padding:0 0 5px 5px; }
h2 a { color: #224f99; }
a { color:#999; text-decoration: none; }
a:hover { color:#802727; }
p { padding:0 0 5px 0; }
#addScnt {
    font-size: 20px;
    font-weight: 800;
}

#remScnt {
    padding: 0 10px;
    font-size: 15px;
    font-weight: 800;
}

input { padding:5px; border:1px solid #999; border-radius:4px; -moz-border-radius:4px; -web-kit-border-radius:4px; -khtml-border-radius:4px; }
</style>
    <h1><?php esc_html_e( 'Lovetura Contact Form', 'lovetura-contact' ); ?></h1>
    <?php //var_dump($sesiones); ?>
    <form class="" action="options.php" method="post">
    <?php settings_fields('lovecontact_section'); 
    do_settings_sections('lovecontact_section'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Correo</th>
                <td><input type="text" name="lovetura_email" value="<?php echo get_option('lovetura_email'); ?>"></td>
            </tr>

            <tr valign="top">
                <th scope="row">Sesiones</th>
                <td>
                <button class="button button-primary" id="addScnt">+</button>
                <div id="p_scents">
                <?php $index = 0;
                    foreach ( $sesiones as $sesion => $value ) {
                        ?>
                    <p>
                    <label for="p_scnts">
                        <input type="text" id="p_scnt" size="20" name="sesiones[<?php echo esc_attr($sesion); ?>]" value="<?php echo esc_attr($value); ?>" placeholder="Ingresa Sesion"/></label>
                        <?php if ( $index > 0 ) { ?>
                        <button class="button button-primary" id="remScnt">X</button>
                        <?php } ?>
                    </p>
                    <?php $index++;
                    }
                    ?>
                </div>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
        
    </form>
</div>