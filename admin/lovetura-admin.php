<?php

namespace LoveturaContact\Admin;

/**
  * The admin-specific functionality of the plugin.
  *
  * @link       http://example.com
  * @since      1.3.0
  *
  * @package    LoveturaContact
  * @subpackage LoveturaContact/Admin
  */
  class LoveturaAdmin {

    protected $page_slug = 'contact-page';

    public function lovetura_admin_menu() {

        add_menu_page(
            __( 'Contact', 'lovetura-contact' ),
            __( 'Contact', 'lovetura-contact' ),
            'manage_options',
            $this->page_slug,
            [ $this, 'admin_contact_contents' ],
            'dashicons-email-alt',
            6
            );
    }

    public function get_content_page() {
        ob_start();
        $this->admin_contact_contents();
        $output = ob_get_contents();
        ob_end_clean();
        
        return $output;
    }

    public function admin_contact_contents() {
        include_once LOVETURACONTACT_PATH . 'views/page-lovetura.php';
    }

    public function register_admin_lovescripts() {
        // repeater Script
        wp_register_script( 'lc-repeater', LOVETURACONTACT_URL . 'assets/js/repeater.js' , array( 'jquery' ), LOVETURACONTACT_VERSION, true );
    }


    function load_lovetura_scripts( $hook ) {

    //Load only on ?page=sample-page
    
    if( $hook != 'toplevel_page_contact-page' ) {
        return;         
    }
    
    // Load style & scripts.
    wp_enqueue_script( 'lc-repeater' );
    }

    public function setup_fields() {

    }

    public function setup_sections() {
        add_settings_section('lovecontact_section', 'Lovetura Contact Options', array( $this, 'section_callback' ), $this->page_slug);
    }

    public function register_options() {
        register_setting('lovecontact_section', 'lovetura_email');
        register_setting('lovecontact_section', 'sesiones');
    }

    public function section_callback( $arguments ) {
        switch( $arguments['id'] ) {
            case 'lovecontact_section':
            echo 'This is the first description here!';
            break;
        }
    }
  }

?>