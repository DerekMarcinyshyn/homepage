<?php
    /**
     * Homepage
     * @package     Block
     * @since       December 1, 2012
     * @author      Derek Marcinyshyn <derek@marcinyshyn.com>
     * @version     1.0
     */

if ( ! class_exists( 'Homepage_Admin' ) ) :

    class Homepage_Admin {
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
         * add menu icon to admin section
         */
        function homepage_admin_icon() {
            global $post_type;
            ?>
        <style>
                <?php if (($_GET['post_type'] == 'mmm_homepage') || ($post_type == 'mmm_homepage')) : ?>
                    #icon-edit { background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/icons32.png') no-repeat -251px -5px; }
                <?php endif; ?>

            #adminmenu #menu-posts-mmm_homepage div.wp-menu-image{background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/menu.png') no-repeat scroll -149px -33px;}
            #adminmenu #menu-posts-mmm_homepage div.wp-menu-image{background-position: -149px -33px;}
            #adminmenu #menu-posts-mmm_homepage:hover div.wp-menu-image,#adminmenu #menu-posts-mmm_homepage.wp-has-current-submenu div.wp-menu-image{background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/menu.png') no-repeat scroll -149px -1px;}
        </style>
        <?php
        }

        /**
         * Drag and drop sort order of the elements AJAX callback function
         */
        function homepage_update_post_order() {
            global $wpdb;

            $post_type    = $_POST['postType'];
            $order        = $_POST['order'];

            /**
             *    Expect: $sorted = array(
             *                menu_order => post-XX
             *            );
             */
            foreach( $order as $menu_order => $post_id )
            {
                $post_id        = intval( str_ireplace( 'post-', '', $post_id ) );
                $menu_order     = intval($menu_order);
                wp_update_post( array( 'ID' => $post_id, 'menu_order' => $menu_order ) );
            }

            $data = array( 'success' => 'true', 'order' => $order );
            header( "Content-Type: application/json" );
            echo json_encode( $data );

            exit;
        }
        /**
         * homepage_order_admin_script function
         *
         * Add the scripts to the head
         */
        function homepage_order_admin_script() {
            wp_enqueue_script( 'jquery-ui-sortable' );
            wp_register_script( 'homepage-admin-script', MMM_HOMEPAGE_URL . '/assets/js/homepage.admin.js', array( 'jquery' ), MMM_HOMEPAGE_VERSION, false );
            wp_enqueue_script( 'homepage-admin-script' );
        }

        /**
         * register_order_menu function
         *
         * Add a submenu to the Homepage Menu in the Admin
         */
        function register_order_menu() {
            add_submenu_page(
                'edit.php?post_type=mmm_homepage',
                'Sort Homepage Elements',
                'Set Order',
                'edit_pages', 'element-order',
                array( $this, 'set_order_homepage_elements' )
            );

            add_submenu_page(
                'edit.php?post_type=mmm_homepage',
                'Help',
                'Help',
                'edit_pages', 'homepage-help',
                array( $this, 'homepage_admin_help' )
            );

        }

        function homepage_admin_help() {
            echo '<div class="wrap">';
            echo '<h2>Homepage Help</h2>';
            echo '<h4>Widgets</h4>';
            echo '<p>Add the code below with> in between php opening closing tags</code>';

            echo '<h5>Homepage Weather</h5>';
            echo '<code>dynamic_sidebar("homepage-weather");</code>';

            echo '<h5>Homepage Events</h5>';
            echo '<code>dynamic_sidebar("homepage-events");</code>';

            echo '<h5>Homepage Ad Slider</h5>';
            echo '<code>dynamic_sidebar("homepage-ad-slider");</code>';

            echo '<h5>Homepage Featured Business</h5>';
            echo '<code>dynamic_sidebar("homepage-featured-business");</code>';

            echo '<h5>Homepage Weather</h5>';
            echo '<code>dynamic_sidebar("homepage-weather");</code>';

            echo '<h5>Homepage RMR Snow</h5>';
            echo '<code>dynamic_sidebar("homepage-rmr-snow");</code>';

            echo '</div>';
        }

        /**
         * set_order_homepage_elements function
         *
         * The html of the Sub page Sort Homepage Element
         */
        function set_order_homepage_elements() {
            ?>
        <div class="wrap">
            <h2>Sort Homepage Element</h2>
            <p>Simply drag the homepage element up or down and they will be saved in that order.</p>
            <?php $elements = new WP_Query( array( 'post_type' => 'mmm_homepage', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order' ) ); ?>
            <?php if( $elements->have_posts() ) : ?>

            <div class="homepage-message"></div>

            <table class="wp-list-table widefat fixed posts" id="sortable-table">
                <thead>
                <tr>
                    <th class="column-order">Order</th>
                    <th class="column-title">Title</th>
                </tr>
                </thead>
                <tbody data-post-type="mmm_homepage">
                    <?php while( $elements->have_posts() ) : $elements->the_post(); ?>
                <tr id="post-<?php the_ID(); ?>">
                    <td class="column-order"><img src="<?php echo MMM_HOMEPAGE_URL . '/assets/img/icon-move.png'; ?>" title="" alt="Move Icon" width="30" height="30" class="" /></td>
                    <td class="column-title"><strong><?php the_title(); ?></strong><div class="excerpt"><?php the_excerpt(); ?></div></td>
                </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th class="column-order">Order</th>
                    <th class="column-title">Title</th>
                </tr>
                </tfoot>

            </table>

            <?php else: ?>

            <p>No elements found, why not <a href="post-new.php?post_type=mmm_homepage">create one?</a></p>

            <?php endif; ?>
            <?php wp_reset_postdata(); // Don't forget to reset again! ?>

            <style>
                    /* Dodgy CSS ^_^ */
                #sortable-table td { background: white; }
                #sortable-table .column-order { padding: 3px 10px; width: 50px; }
                #sortable-table .column-order img { cursor: move; }
                #sortable-table td.column-order { vertical-align: middle; text-align: center; }
                #sortable-table .column-thumbnail { width: 160px; }
            </style>

        </div><!-- .wrap -->

        <?php
        }

        /**
         * github_plugin_updater function
         *
         * Github Plugin Updater API
         * @see     /lib/jkudish/updater.php
         * @link    https://github.com/jkudish/WordPress-GitHub-Plugin-Updater
         */

        function github_plugin_updater() {
            define( 'HOMEPAGE_GITHUB_FORCE_UPDATE', true );

            if ( is_admin() ) {
                $config = array(
                    'slug'                  => MMM_HOMEPAGE_DIRECTORY . '/homepage.php',
                    'proper_folder_name'    => 'homepage',
                    'api_url'               => 'https://api.github.com/repos/DerekMarcinyshyn/homepage',
                    'raw_url'               => 'https://raw.github.com/DerekMarcinyshyn/homepage/master',
                    'github_url'            => 'https://github.com/DerekMarcinyshyn/homepage',
                    'zip_url'               => 'https://github.com/DerekMarcinyshyn/homepage/zipball/master',
                    'sslverify'             => false,
                    'requires'              => '3.0',
                    'tested'                => '3.5',
                    'readme'                => 'README.md',
                    'access_token'          => '',
                );

                new HomepageUpdater( $config );
            }
        }

    } // end class
endif; // end if class_exists