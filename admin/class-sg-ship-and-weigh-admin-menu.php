<?php
/**
 * Add menus to the Admin Control Panel
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_Admin_Menu {
    /**
     * Menu slug
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected $slug = 'ship-and-weigh-menu';
    /**
     * URL of the admin includes and assets
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected $assets_root_url;
    /**
     * SG_Ship_And_Weigh_Menu constructor
     * 
     * @since 1.0.0
     * 
     * @param string $assets_root Root directory of the includes
     */
    public function __construct( $assets_root_url ) {
        $this->assets_root_url = $assets_root_url;

        add_action( 'admin_enqueue_scripts', array( $this, 'register_assets' ) );

        add_action( 'admin_menu', array( $this, 'add_settings_menu' ) );
    }
    /**
     * Register CSS and JS for page
     * 
     * @uses "admin_enqueue_scripts" action
     */
    public function register_assets() {
        wp_register_script( $this->slug, $this->assets_root_url . '/js/script.js', array( 'jquery' ) );
        wp_register_style( $this->slug, $this->assets_root_url . '/css/style.css' );
        wp_localize_script( $this->slug, 'SHIP_AND_WEIGH', array(
            'strings' => array(
                'saved' => __( 'Settings Saved', 'text-domain' ),
                'error' => __( 'Error', 'text-domain' ),
            ),
            'api'     => array(
                'url'   => esc_url_raw( rest_url( 'sg-ship-and-weigh-api/v1/settings' ) ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
            ),
        ) );
    }
    /**
     * Add settings menu
     * 
     * @since 1.0.0
     * 
     * @uses "admin_menu" action
     */
    public function add_settings_menu() {
        add_menu_page(
            __( 'Ship and Weigh Settings', 'text-domain'),
            __( 'Ship and Weigh Settings', 'text-domain'),
            'manage_options',
            $this->slug,
            array( $this, 'render_settings_menu' )
        );
    }
    /**
     * Enqueue CSS and JS for page
     */
    public function enqueue_assets() {
        if ( ! wp_script_is( $this->slug, 'registered' ) ) {
            $this->register_assets();
        }

        wp_enqueue_script( $this->slug );
        wp_enqueue_style( $this->slug );
    }
    /**
     * Render plugin settings menu
     */
    public function render_settings_menu() {
        $this->enqueue_assets();
        include( $this->assets_root_url . '/pages/sg-ship-and-weigh-settings-menu.php' );
    }
}