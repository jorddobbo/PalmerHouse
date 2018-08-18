<?php

birch_ns( 'appointer.view.settings', function( $ns ) {

        $_ns_data = new stdClass();

        birch_defn( $ns, 'init', function() use ( $ns, $_ns_data ) {
        
                $_ns_data->active_tab = '';
                
                $_ns_data->tabs = array();

                add_action( 'admin_init', array( $ns, 'wp_admin_init' ) );
                
                $ns->init_capabilities();
            } );

        birch_defn( $ns, 'wp_admin_init', function() use ( $ns, $_ns_data ) {
                if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 'appointer_settings' ) {
                    if ( isset( $_GET['tab'] ) ) {
                        $_ns_data->active_tab = $_GET['tab'];
                    } else {
                        $_ns_data->active_tab = 'general';
                    }
                    $_ns_data->tabs = $ns->get_tabs();
                    $ns->init_tab( array(
                            'tab' => $_ns_data->active_tab
                        ) );
                    add_action( 'appointer_view_render_settings_page', array( $ns, 'render_admin_page' ) );
                    add_action( 'admin_enqueue_scripts', array( $ns, 'enqueue_scripts' ) );
                }
            } );

        birch_defn( $ns, 'enqueue_scripts', function( $hook ) use ( $ns ) {
                global $appointer;

                if ( $appointer->view->get_page_hook( 'settings' ) !== $hook ) {
                    return;
                }
                $appointer->view->register_3rd_scripts();
                $appointer->view->register_3rd_styles();
                $appointer->view->enqueue_scripts( array( 'appointer_view_admincommon' ) );
            } );

        birch_defn( $ns, 'get_tabs', function() {
                return array();
            } );

        birch_defn( $ns, 'get_tab_lookup_config', function() {
                return array(
                    'key' => 'tab',
                    'lookup_table' => array()
                );
            } );

        birch_defmulti( $ns, 'init_tab', $ns->get_tab_lookup_config, function( $arg ) {} );

        birch_defn( $ns, 'compare_tab_order', function( $a, $b ) {
                if ( $a['order'] == $b['order'] ) {
                    return 0;
                }
                return ( $a['order'] < $b['order'] ) ? -1 : 1;
            } );

        birch_defn( $ns, 'render_admin_page', function() use ( $ns, $_ns_data ) {
                global $appointer;

                $setting_page_url = admin_url( "admin.php" ) . "?page=appointer_settings";
                uasort( $_ns_data->tabs, array( $ns, 'compare_tab_order' ) );
                $appointer->view->show_notice();
?>
        <div class="wrap">
            <h2 class="nav-tab-wrapper">
<?php
                if ( is_array( $_ns_data->tabs ) ):
                foreach ( $_ns_data->tabs as $tab_name => $tab ):
                $active_class = "";
                if ( $_ns_data->active_tab == $tab_name ) {
                    $active_class = "nav-tab-active";
                }
?>
                        <a href='<?php echo $setting_page_url . "&tab=$tab_name"; ?>' class="nav-tab <?php echo $active_class; ?>"><?php echo $tab['title']; ?></a>
<?php
                endforeach;
                endif;
?>
            </h2>
<?php
                if ( isset( $_ns_data->tabs[$_ns_data->active_tab] ) ) {
                    $_ns_data->active_tab = $_ns_data->tabs[$_ns_data->active_tab];
                    if ( $_ns_data->active_tab ) {
                        call_user_func( $_ns_data->active_tab['action'] );
                    }
                }
?>
        </div>
<?php
            } );

        birch_defn( $ns, 'get_tab_metabox_category', function( $tab_name ) {
                return $tab_name . '_main';
            } );

        birch_defn( $ns, 'get_tab_page_hook', function( $tab_name ) {
                return 'appointer_page_settings_tab_' . $tab_name;
            } );

        birch_defn( $ns, 'get_tab_save_action_name', function( $tab_name ) {
                return 'appointer_save_options_' . $tab_name;
            } );

        birch_defn( $ns, 'get_tab_options_name', function( $tab_name ) {
                return 'appointer_options_' . $tab_name;
            } );

        birch_defn( $ns, 'get_tab_transient_message_name', function( $tab_name ) {
                return "appointer_" . $tab_name . "_info";
            } );

        birch_defn( $ns, 'save_tab_options', function( $tab_name, $message ) use ( $ns ) {
                $save_action_name = $ns->get_tab_save_action_name( $tab_name );
                check_admin_referer( $save_action_name );
                $options_name = $ns->get_tab_options_name( $tab_name );
                if ( isset( $_POST[$options_name] ) ) {
                    $options = stripslashes_deep( $_POST[$options_name] );
                    update_option( $options_name, $options );
                }
                $transient_name = $ns->get_tab_transient_message_name( $tab_name );
                set_transient( $transient_name, $message, 60 );
                $orig_url = $_POST['_wp_http_referer'];
                wp_redirect( $orig_url );
                exit;
            } );

        birch_defn( $ns, 'render_tab_page', function( $tab_name ) use ( $ns ) {
                global $appointer;

                $page_hook = $ns->get_tab_page_hook( $tab_name );
                $screen = $appointer->view->get_screen( $page_hook );
                $save_action_name = $ns->get_tab_save_action_name( $tab_name );
                $options_name = $ns->get_tab_options_name( $tab_name );
                $options = get_option( $options_name );
                if ( $options && isset( $options['version'] ) ) {
                    $version = $options['version'];
                } else {
                    $version = false;
                }
                $block_id = "appointer_" . $tab_name;
?>
        <style type="text/css">
            #notification_main-sortables .hndle {
                cursor: pointer;
            }
            #notification_main-sortables .wp-tab-panel {
                max-height: 500px;
            }
        </style>
        <div id="<?php echo $block_id; ?>" class="wrap">
            <form method="post" action="<?php echo admin_url( 'admin-post.php' ) ?>">
                <?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
                <?php wp_nonce_field( $save_action_name ); ?>
                <input type="hidden" name="action" value="<?php echo $save_action_name; ?>" />
                <?php if ( $version ) { ?>
                    <input type="hidden" name="<?php echo $options_name . '[version]'; ?>" value="<?php echo $version; ?>" />
                <?php } ?>
                <div id="poststuff">
                    <div id="post-body" class="metabox-holder columns-1">
                        <div id="postbox-container-1" class="postbox-container">
                            <?php do_meta_boxes( $screen, $ns->get_tab_metabox_category( $tab_name ), array() ) ?>
                        </div>
                    </div>
                    <br class="clear" />
                </div>
                <input type="submit" name="submit"
                    value="<?php _e( 'Save changes', 'appointer' ); ?>"
                    class="button-primary" />
            </form>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                postboxes.init = function() {};
                postboxes.add_postbox_toggles('<?php echo $ns->get_tab_page_hook( $tab_name ); ?>');
<?php
                $info_key = $ns->get_tab_transient_message_name( $tab_name );
                $info = get_transient( $info_key );
                if ( false !== $info ) {
?>
                $.jGrowl('<?php echo esc_js( $info ); ?>', {
                        life: 1000,
                        position: 'center',
                        header: '<?php _e( '&nbsp', 'appointer' ); ?>'
                    });
<?php
                    delete_transient( $info_key );
                }
?>
            });
            //]]>
        </script>
<?php
            } );

        birch_defn( $ns, 'get_post_types', function() {
                return array(
                    'birs_appointment', 'birs_client',
                    'birs_location', 'birs_staff',
                    'birs_service', 'birs_payment'
                );
            } );

        birch_defn( $ns, 'get_core_capabilities', function() use ( $ns ) {

                $capabilities = array();

                $capabilities['birs_core'] = array(
                    "manage_birs_settings"
                );

                $capability_types = $ns->get_post_types();

                foreach ( $capability_types as $capability_type ) {
                    $capabilities[ $capability_type ] = array(
                        "edit_{$capability_type}",
                        "read_{$capability_type}",
                        "delete_{$capability_type}",
                        "edit_{$capability_type}s",
                        "edit_others_{$capability_type}s",
                        "publish_{$capability_type}s",
                        "read_private_{$capability_type}s",
                        "delete_{$capability_type}s",
                        "delete_private_{$capability_type}s",
                        "delete_published_{$capability_type}s",
                        "delete_others_{$capability_type}s",
                        "edit_private_{$capability_type}s",
                        "edit_published_{$capability_type}s"
                    );
                }

                return $capabilities;
            } );

        birch_defn( $ns, 'init_capabilities', function() use ( $ns ) {
                global $wp_roles, $appointer;

                if ( class_exists( 'WP_Roles' ) )
                if ( ! isset( $wp_roles ) )
                $wp_roles = new WP_Roles();

                if ( is_object( $wp_roles ) ) {

                    $capabilities = $ns->get_core_capabilities();

                    foreach ( $capabilities as $cap_group ) {
                        foreach ( $cap_group as $cap ) {
                            $wp_roles->add_cap( 'administrator', $cap );
                        }
                    }
                }
            } );
    } );
