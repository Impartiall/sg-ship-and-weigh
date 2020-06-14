<?php
/**
 * Add menus to the Admin Control Panel
 * 
 * @since 1.0.0
 */
defined( 'ABSPATH' ) or die( 'Direct access blocked.' );

class SG_Ship_And_Weigh_Admin_Menu {
    /**
     * Settings menu slug
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected $settings_slug = 'sg-ship-and-weigh-settings-menu';
    /**
     * Shipping menu slug
     * 
     * @since 1.0.0
     * 
     * @var string
     */
    protected $shipping_slug = 'sg-ship-and-weigh-shipping-menu';
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
        add_action( 'admin_menu', array( $this, 'add_shipping_menu' ) );
    }

    /**
     * Create a menu page with all associated scripts and styles
     * 
     * @since 1.0.0
     */
    public function create_new_admin_page(
        string $slug, array $menu, string $page_url,
        string $script_url, string $style_url,
        string $object_name, array $object
    ) {
        $page = add_menu_page(
            $menu['page_title'],
            $menu['menu_title'],
            $menu['capability'],
            $slug,
            function() use ( $slug, $page_url, $script_url, 
                             $style_url, $object_name, $object ) {
                enqueue_assets( $slug, $script_url, $style_url, $object_name, $object );
                include( $this->assets_root_url . $page_url );
            }
        );
    }
    /**
     * Register CSS and JS for page
     * 
     * @uses "admin_enqueue_scripts" action
     */
    public function enqueue_assets( string $slug, $script_url, $style_url ) {
        wp_enqueue_script( $slug, $this->assets_root_url . $script_url, array( 'jquery' ) );
        wp_enqueue_style( $slug, $this->assets_root_url . $style_url );
        wp_localize_script( $slug, $object_name, $object );
    }

    /**
     * Render plugin settings menu
     */
    public function add_settings_menu() {
        $this->create_new_admin_page(
            'sg-ship-and-weigh-settings',
            array(
                'page_title' => 'Settings - Ship and Weigh',
                'menu_title' => 'Ship and Weigh Settings',
                'capability' => 'manage_options'
            ),
            'pages/sg-ship-and-weigh-settings-menu.php',
            'js/script.js',
            'css/style.css',
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
            )
        );
    }
}