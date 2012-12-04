<?php
/**
 * Homepage
 * @package     Block
 * @since       December 1, 2012
 * @author      Derek Marcinyshyn <derek@marcinyshyn.com>
 * @version     1.0
 */

if ( ! class_exists( 'Homepage_Shortcode' ) ) :

    class Homepage_Shortcode {
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
         * __construct function
         *
         * Default constructor for shortcode
         *
         */
        private function __construct() { }

        /**
         * display_homepage function
         *
         * Display the homepage app via shortcode
         *
         * @param $atts
         * @param null $content
         * @return string
         */
        function display_homepage( $atts, $content = null ) {

            // add filter to see if there is executable php
            add_filter( 'the_content', array( $this, 'execute_php' ), 100 );


            $html = '';

            $html .= '<div class="homepage-loader" id="homepage-loader"><img src="' . MMM_HOMEPAGE_URL . '/assets/img/homepage-loader.gif" width="50" height="50" /></div>';

            // get the homepage elements
            $elements_args = array(
                'post_type'             => 'mmm_homepage',
                'posts_per_page'        => '-1',
                'orderby'               => 'menu_order',
                'order'                 => 'ASC',
                'post_status'           => 'publish'
            );

            $elements = get_posts( $elements_args );

            $html .= '<div id="mmm-homepage-wrapper" class="mmm-homepage-wrapper">';

            // cycle through the elements
            foreach ( $elements as $element ) {
                $html .= '<div class="mmm-homepage-element">';
                $html .= '<h3>' . $element->post_title . '</h3>';
                $html .= $element->post_content;
                $html .= '</div>';
            }

            $html .= '</div>';

            return $html;
        }

        function execute_php( $content ) {
            if ( strpos( $content, "<" . "?php" ) !==false ) {
                ob_start();
                eval( "?" . ">" . $content );
                $content = ob_get_contents();
                ob_end_clean();
            }

            return $content;
        }

    }
endif; // end if class_exists
