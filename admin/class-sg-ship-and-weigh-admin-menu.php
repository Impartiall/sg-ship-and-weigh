<?php
/**
 * Add menus to the Admin Control Panel
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_Admin_Menu {

    /**
     * Shipping menu slug
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected string $shipping_slug = 'sg-ship-and-weigh-shipping-menu';

    /**
     * Settings menu slug
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected string $settings_slug = 'sg-ship-and-weigh-settings-menu';

    /**
     * URL of the admin includes and assets
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected string $assets_root_url;

    /**
     * Path to the admin includes and assets
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected string $assets_root_path;

    /**
     * SG_Ship_And_Weigh_Admin_Menu constructor
     * 
     * @since 1.0.0
     * 
     * @param string $assets_root_url URL of the includes and assets
     * @param string $assets_root_path Path to the includes and assets
     */
    public function __construct( $assets_root_url, $assets_root_path ) {
        $this->assets_root_url = $assets_root_url;
        $this->assets_root_path = $assets_root_path;

        $this->init_hooks();
    }

    /**
     * Initialize hooks for the menu pages
     * 
     * @since 1.0.0
     */
    public function init_hooks() {
        add_action( 'admin_menu', array( $this, 'add_shipping_menu' ) );
        add_action( 'admin_menu', array( $this, 'add_settings_menu' ) );
    }

    /**
     * Enqueue CSS and JS for page and pass an object to the created page
     * 
     * @since 1.0.0
     * 
     * @param string $slug Slug of the page to be created
     * @param string $script_url URL from assets_root_url to the page script
     * @param string $style_url URL from assets_root_url to the page stylesheet
     * @param string $object_name JS object name to be passed to wp_localize_script()
     * @param string $object JS object to be passed to wp_localize_script() 
     */
    public function enqueue_assets(
        string $slug,
        string $script_url, string $style_url,
        string $object_name, array $object
    ) {
        wp_enqueue_script( $slug, $this->assets_root_url . $script_url, array( 'jquery' ) );
        wp_enqueue_style( $slug, $this->assets_root_url . $style_url );
        wp_localize_script( $slug, $object_name, $object );
    }

    /**
     * Load and enqueue assets for shipping_menu
     * 
     * @since 1.0.0
     */
    public function load_shipping_menu() {
        $this->enqueue_assets(
            $this->shipping_slug,
            'js/sg-ship-and-weigh-shipping-menu.js',
            'css/sg-ship-and-weigh-shipping-menu.css',
            'SHIP_AND_WEIGH',
            array(
                'strings' => array(
                    'saved' => __( 'Settings Saved', 'text-domain' ),
                    'error' => __( 'Error', 'text-domain' ),
                ),
            ),
        );
        include( $this->assets_root_path . 'pages/sg-ship-and-weigh-shipping-menu.php' );
    }

    /**
     * Create plugin shipping menu
     * 
     * @since 1.0.0
     */
    public function add_shipping_menu() {
        add_menu_page(
            'Generate Label - Ship and Weigh',
            'Generate Label',
            'manage_options',
            $this->shipping_slug,
            array( $this, 'load_shipping_menu' ),
        );
    }

    /**
     * Load and enqueue assets for settings_menu
     * 
     * @since 1.0.0
     */
    public function load_settings_menu() {
        $this->enqueue_assets(
            $this->settings_slug,
            'js/sg-ship-and-weigh-settings-menu.js',
            'css/sg-ship-and-weigh-settings-menu.css',
            'SHIP_AND_WEIGH',
            array(
                'strings' => array(
                    'saved' => __( 'Settings Saved', 'text-domain' ),
                    'error' => __( 'Error', 'text-domain' ),
                ),
                'api'     => array(
                    'url'   => esc_url_raw( rest_url( 'sg-ship-and-weigh-api/v1/settings' ) ),
                    'nonce' => wp_create_nonce( 'wp_rest' ),
                ),
            ),
        );
        include( $this->assets_root_path . 'pages/sg-ship-and-weigh-settings-menu.php' );
    }

    /**
     * Create plugin settings menu
     * 
     * @since 1.0.0
     */
    public function add_settings_menu() {
        add_submenu_page(
            $this->shipping_slug,
            'Settings - Ship and Weigh',
            'Settings',
            'manage_options',
            $this->settings_slug,
            array( $this, 'load_settings_menu' ),
        );
    }


}