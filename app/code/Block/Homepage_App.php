<?php
/**
 * Homepage
 * @package     Block
 * @since       December 1, 2012
 * @author      Derek Marcinyshyn <derek@marcinyshyn.com>
 * @version     1.0
 */

if ( ! class_exists( 'Homepage_App' ) ) :

    class Homepage_App {
        /**
         * _instance class variable
         *
         * Class instance
         *
         * @var null | object
         */
        private static $_instance = NULL;

        static function get_instance() {
            if( self::$_instance === NULL ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        /**
         * Constructor
         *
         * Default constructor -- application initialization
         */
        private function __construct() {
            global  $mmm_homepage_shortcode,
                    $mmm_homepage_admin,
                    $mmm_homepage_cpt;

            // add the custom post type
            add_action( 'init', array( $mmm_homepage_cpt, 'register_cpt_mmm_homepage' ) );

            // add css and js
            add_action( 'init', array( $this, 'homepage_css_js' ) );

            // register widgets
            add_action( 'init', array( $this, 'register_homepage_widgets' ) );

            // add shortcode action
            add_shortcode( 'mmm-homepage', array( $mmm_homepage_shortcode, 'display_homepage' ), 10, 2 );

            // add order admin page
            add_action( 'admin_menu', array( $mmm_homepage_admin, 'register_order_menu' ) );

            // add the admin jquery saving script
            add_action( 'admin_enqueue_scripts', array( $mmm_homepage_admin, 'homepage_order_admin_script' ) );

            // register the admin sort order ajax script
            add_action( 'wp_ajax_homepage_update_post_order', array( $mmm_homepage_admin, 'homepage_update_post_order' ) );

            // add updater action
            add_action( 'admin_init', array( $mmm_homepage_admin, 'github_plugin_updater' ), 10, 0 );

            // add admin menu icon
            add_action( 'admin_head', array( $mmm_homepage_admin, 'homepage_admin_icon' ), 10, 0 );
        }

        /**
         * register_homepage_widgets function
         *
         * Add widget capability to the homepage
         */
        function register_homepage_widgets() {
            register_sidebar(array(
                'name'          => __('Homepage Weather', 'homepage'),
                'id'            => 'homepage-weather',
                'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></section>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>',
            ));

            register_sidebar(array(
                'name'          => __('Homepage Events', 'homepage'),
                'id'            => 'homepage-events',
                'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></section>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>',
            ));

            register_sidebar(array(
                'name'          => __('Homepage Ad Slider', 'homepage'),
                'id'            => 'homepage-ad-slider',
                'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></section>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>',
            ));

            register_sidebar(array(
                'name'          => __('Homepage Featured Business', 'homepage'),
                'id'            => 'homepage-featured-business',
                'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></section>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>',
            ));

            register_sidebar(array(
                'name'          => __('Homepage Business Search', 'homepage'),
                'id'            => 'homepage-search-business',
                'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></section>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>',
            ));

            register_sidebar(array(
                'name'          => __('Homepage RMR Snow', 'homepage'),
                'id'            => 'homepage-rmr-snow',
                'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></section>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>',
            ));
        }

        /**
         * homepage_css_js function
         *
         * Add CSS and JS
         */
        function homepage_css_js() {
            wp_register_script( 'isotope-js', MMM_HOMEPAGE_URL . '/assets/js/jquery.isotope.min.js', array( 'jquery' ), '1.5.21', false );
            wp_enqueue_script( 'isotope-js' );

            wp_register_script( 'homepage-js', MMM_HOMEPAGE_URL . '/assets/js/homepage.js', array( 'jquery' ), MMM_HOMEPAGE_VERSION, false );
            wp_enqueue_script( 'homepage-js' );

            wp_register_style( 'homepage-css', MMM_HOMEPAGE_URL . '/assets/css/homepage.css', true, MMM_HOMEPAGE_VERSION );
            wp_enqueue_style( 'homepage-css' );
        }


    }
endif; // end if class exists