<?php
/**
 * Admin Page View
 *
 * Template
 */
$unadates = get_option('unadates');
?>
<div class="wrap">
<style>
#addDate {
    font-size: 20px;
    font-weight: 800;
}

#remDate {
    padding: 0 10px;
    font-size: 15px;
    font-weight: 800;
}
</style>
    <h1><?php esc_html_e( 'Lovetura Date', 'lovetura-date' ); ?></h1>
    <?php //var_dump($unadates); ?>
    <form class="" action="options.php" method="post">
    <?php settings_fields('lovedate_section'); 
    do_settings_sections('lovedate_section'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Date Format</th>
                <!--<td><input type="text" name="lovetura_email" value="dd-mm-yy" disabled></td>-->
                <td><label for="">dd-mm-yy</label></td>

            <tr valign="top">
                <th scope="row">Unavailable Dates</th>
                <td>
                <button class="button button-primary" id="addDate">+</button>
                <div id="p_dates">
                <?php $index = 0;
                    foreach ( $unadates as $unadate => $date) {
                        ?>
                    <p>
                    <label for="p_dats">
                        <input type="text" name="unadates[<?php echo esc_attr($unadate); ?>]" id="" value="<?php echo esc_attr($date); ?>">
                        <?php if ( $index > 0 ) { ?>
                        <button class="button button-primary" id="remDate">X</button>
                        <?php } ?>
                    </p>
                        <?php $index++;
                    } ?>
                </div>
                </td>
            </tr>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>

</div>