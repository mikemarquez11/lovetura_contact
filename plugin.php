<?php
namespace LoveturaContact;

use LoveturaContact\Validate\LoveturaValidate;
use LoveturaContact\Submission\LoveturaSubmit;
use LoveturaContact\Admin\LoveturaAdmin;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Lovetura Contact plugin.
 *
 * The main plugin handler class is responsible for initializing LoveturaContact. The
 * class registers and all the components required to run the plugin.
 * @since 1.0.0
 */
  class LoveturaContact {

 /**
 * The unique identifier of this plugin
 *
 * @since 1.0.0
 * @access protected
 * @var string $FabsitesListingsRets The string used to uniquely identify this plugin.
 */
  protected $LoveturaContact;

 /**
  * The current version of the plugin
  *
  * @since 1.0.0
  * @access protected
  * @var string $version The current version of this plugin.
  */
  protected $version;

  /**
   * Instance.
   * 
   * Holds the plugin LC instance.
   * 
   * @since 1.0.0
   * @access public
   * @static
   */
   public static $instance = null;

   /**
    * Instance.
    * 
    * Ensures only one instance of the plugin class is loaded or can be loaded.
    *
    * @since 1.0.0
    * @access public
    * @static
    *
    * @return Plugin an Instance of the class 
    */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

   /**
    * The name of the plugin used to uniquely identify it within the context of
    * Wordpress and to define internationalization functionality.
    *
    * @since 1.0.0
    * @return string The name of the plugin.
    */
    public function get_LoveturaContact() {
        return $this->LoveturaContact;
    }

   /**
    * Retrieve the version number of the plugin
    * 
    * @since 1.0.0
    * @return string The version number of the plugin.
    * 
    */
    public function get_version() {
        return $this->version;
    }

   /**
    * Plugin Constructor.
    *
    * Initializing Lovetura Contact plugin.
    *
    * @since 1.3.0
    * @access private
    */
    private function __construct() {

        $this->LoveturaContact = 'LoveturaContact';
        $this->version = '1.0.0';

        $this->includes();
        $this->load_textdomain();
        $this->define_lovetura_hooks();

        add_action( 'wp_enqueue_scripts', [ $this, 'lovecontact_scripts'] );
        add_action( 'wp_enqueue_scripts', [ $this, 'lovecontact_styles'] );
        add_shortcode( 'lovetura-contact', [ $this, 'contact_form_shortcode' ] );
    }

  /**
   * Loads the globally required Files for the Plugin.
   * 
   * Includes validation
   * 
   * @since 1.0.1
   * @access private
   */
   public function includes() {
        require_once LOVETURACONTACT_PATH . 'admin/lovetura-admin.php';
        require_once LOVETURACONTACT_PATH . 'includes/validation.php';
        require_once LOVETURACONTACT_PATH . 'includes/submission.php';
   }

   /**
    * Register all of the hooks related to the functionality
    * of the plugin
    *
    * @since 1.0.1
    * @access public
    */
    private function define_lovetura_hooks() {
        $lovec_page = new LoveturaAdmin();
        $lovec_val = new LoveturaValidate();
        $lovec_sub = new LoveturaSubmit();

        add_action( 'admin_enqueue_scripts', [ $lovec_page, 'register_admin_lovescripts' ] );
        add_action( 'admin_enqueue_scripts', [ $lovec_page, 'load_lovetura_scripts' ] );
        add_action( 'admin_menu', [ $lovec_page, 'lovetura_admin_menu'] );
        // Add Settings and Fields
        add_action( 'admin_init', array( $lovec_page, 'register_options' ) );
        add_action( 'admin_init', array( $lovec_page, 'register_date_options' ) );
    	//add_action( 'admin_init', array( $lovec_page, 'setup_fields' ) );
        
        add_action( 'wp_ajax_send_info', [ $lovec_val, 'validate_data' ] );
        add_action( 'wp_ajax_nopriv_send_info', [ $lovec_val, 'validate_data' ] );
        add_filter( 'wp_mail_content_type', [ $lovec_sub, 'lc_mail_content_type'] );

        add_action( 'wp_ajax_send_email', [ $lovec_sub, 'sendLoveturaEmail' ] );
        add_action( 'wp_ajax_nopriv_send_email', [ $lovec_sub, 'sendLoveturaEmail' ] );
    }

   /**
    * Loads textdomain for the Plugin
    *
    * @since 1.3.0
    * @access public
    */
    public function load_textdomain() {
       load_plugin_textdomain( 'lovetura-contact' );
    }

    public function lovecontact_scripts() {
        // Popper.js
        wp_register_script( 'lc-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array( 'jquery' ), '1.14.7', true );
        //Bootstrap Script
        wp_register_script( 'lc-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery' ), '4.3.1', true );
        //Bootstrap Validate
        wp_register_script( 'lc-boot-validate', 'https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js', array( 'jquery' ), '2.2.0', true );
        // intTelInput Script
        wp_register_script( 'lc-intTelInput', plugins_url('assets/js/intlTelInput-jquery.min.js', __FILE__), array( 'jquery' ), LOVETURACONTACT_VERSION, true );
        // Ajax Handler
        wp_register_script( 'lc-ajax', plugins_url('assets/js/ajaxcontact.js', __FILE__), array( 'jquery' ), LOVETURACONTACT_VERSION, true );
        // datePicker Script
        wp_register_script( 'ld-init', plugins_url('assets/js/datepicker-init.js', __FILE__), array( 'jquery' ), LOVETURACONTACT_VERSION, true );
        // Date input Polyfill
        //wp_register_script( 'lc-polyfill', plugins_url('assets/js/date-input-polyfill.dist.js', __FILE__), array( 'jquery' ), '1.14.7', true );
        // Localize the script with the new data
        $utils_path = array(
            'utils_js' => plugins_url('assets/js/utils.js', __FILE__),
            'ajax_url' => admin_url( 'admin-ajax.php' ) 
        );
        wp_localize_script( 'lc-ajax', 'utils_path', $utils_path );

        // Localize the script with the new dates
        $lovedates_obj = array(
            'unav_dates' => get_option('unadates')
        );
        wp_localize_script( 'ld-init', 'lovetura_dates', $lovedates_obj );

        // jQuery UI Datepicker
        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_script( 'lc-popper' );
        wp_enqueue_script( 'lc-bootstrap' );
        wp_enqueue_script( 'lc-boot-validate' );
        wp_enqueue_script( 'lc-intTelInput' );
        wp_enqueue_script( 'lc-ajax' );
        wp_enqueue_script( 'ld-init' );
        //wp_enqueue_script( 'lc-polyfill' );
    }

    public function lovecontact_styles() {
        // Bootstrap Stylesheet
        wp_register_style( 'lc-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '4.3.1');
        // intlTelInput
        wp_register_style( 'lc-intlTelInput', plugins_url('assets/css/intlTelInput.min.css', __FILE__), array(), LOVETURACONTACT_VERSION);
        // jQuery UI
        wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), '1.12.1');
        // CSS Styling
        wp_register_style( 'lc-styles', plugins_url('assets/css/styles.css', __FILE__), array(), LOVETURACONTACT_VERSION);
 
        wp_enqueue_style( 'lc-bootstrap' );
        wp_enqueue_style( 'lc-intlTelInput' );
        wp_enqueue_style( 'jquery-ui' );
        wp_enqueue_style( 'lc-styles' );
    }

    public function lovetura_contact_form() {
        // Show the form
		include_once( 'views/form-lovetura.php' );
    }

    public function contact_form_shortcode($atts){
        ob_start();
        $this->lovetura_contact_form();
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
 }

    // Instantiate Plugin Class
    LoveturaContact::instance();
?>