<?php
/**
 * Homepage
 * @package     Helper
 * @since       December 1, 2012
 * @author      Derek Marcinyshyn <derek@marcinyshyn.com>
 * @version     1.0
 */
if ( ! class_exists( 'Homepage_CPT' ) ) :

    class Homepage_CPT {
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
         * Default constructor
         */
        private function __construct() { }

        /**
         * Register the Custom Post Type
         */
        function register_cpt_mmm_homepage() {

            $labels = array(
                'name'                  => _x( 'Elements', 'mmm_homepage' ),
                'singular_name'         => _x( 'Element', 'mmm_homepage' ),
                'add_new'               => _x( 'Add New Element', 'mmm_homepage' ),
                'add_new_item'          => _x( 'Add New Element', 'mmm_homepage' ),
                'edit_item'             => _x( 'Edit Element', 'mmm_homepage' ),
                'new_item'              => _x( 'New Element', 'mmm_homepage' ),
                'view_item'             => _x( 'View Element', 'mmm_homepage' ),
                'search_items'          => _x( 'Search Elements', 'mmm_homepage' ),
                'not_found'             => _x( 'No Elements found', 'mmm_homepage' ),
                'not_found_in_trash'    => _x( 'No Elements found in Trash', 'mmm_homepage' ),
                'parent_item_colon'     => _x( 'Parent Element:', 'mmm_homepage' ),
                'menu_name'             => _x( 'Homepage', 'mmm_homepage' ),
            );

            $args = array(
                'labels'                => $labels,
                'hierarchical'          => false,
                'description'           => 'Homepage elements.',
                'supports'              => array( 'title', 'editor', 'page-attributes' ),
                'public'                => false,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 21,

                'show_in_nav_menus'     => false,
                'publicly_queryable'    => false,
                'exclude_from_search'   => true,
                'has_archive'           => false,
                'query_var'             => false,
                'can_export'            => true,
                'rewrite'               => false,
                'capability_type'       => 'post'
            );

            register_post_type( 'mmm_homepage', $args );
        }
    }
endif; // end if class_exists