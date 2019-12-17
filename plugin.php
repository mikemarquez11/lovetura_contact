<?php
namespace LOVETURACONTACT;

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
    * Initializing Fabsite Listing RETS plugin.
    *
    * @since 1.3.0
    * @access private
    */
    private function __construct() {

        $this->LoveturaContact = 'LoveturaContact';
        $this->version = '1.0.0';

        $this->includes();
        $this->load_textdomain();

        add_action( 'wp_enqueue_scripts', [ $this, 'lovecontact_scripts'] );
        add_action( 'wp_enqueue_scripts', [ $this, 'lovecontact_styles'] );
        add_shortcode( 'lovetura-contact', [ $this, 'contact_form_shortcode' ] );
        add_action( 'wp_ajax_send_info', [ $this, 'lovesend_email' ] );
        add_action( 'wp_ajax_nopriv_send_info', [ $this, 'lovesend_email' ] );
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
        // Localize the script with the new data
        $utils_path = array(
            'utils_js' => plugins_url('assets/js/utils.js', __FILE__),
            'ajax_url' => admin_url( 'admin-ajax.php' ) 
        );
        wp_localize_script( 'lc-ajax', 'utils_path', $utils_path );
    }

    public function lovecontact_styles() {
         // Bootstrap Stylesheet
         wp_register_style( 'lc-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '4.3.1');
         // intlTelInput
         wp_register_style( 'lc-intlTelInput', plugins_url('assets/css/intlTelInput.min.css', __FILE__), array(), LOVETURACONTACT_VERSION);
         // CSS Styling
         wp_register_style( 'lc-styles', plugins_url('assets/css/styles.css', __FILE__), array(), LOVETURACONTACT_VERSION);
 
         wp_enqueue_script( 'lc-popper' );
         wp_enqueue_script( 'lc-bootstrap' );
         wp_enqueue_script( 'lc-boot-validate' );
         wp_enqueue_script( 'lc-intTelInput' );
         wp_enqueue_script( 'lc-ajax' );
         wp_enqueue_style( 'lc-bootstrap' );
         wp_enqueue_style( 'lc-intlTelInput' );
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

    // Instantiate Plugin Class
    LoveturaContact::instance();
?>