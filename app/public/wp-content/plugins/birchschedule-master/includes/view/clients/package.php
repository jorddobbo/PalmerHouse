<?php

birch_ns('appointer.view.clients', function($ns){

        global $appointer;

        birch_defn($ns, 'init', function() use ($ns, $appointer) {

                add_action('admin_init', array($ns, 'wp_admin_init'));

                add_action('init', array($ns, 'wp_init'));

                birch_defmethod( $appointer->view, 'load_page_edit', 
                    'birs_client', $ns->load_page_edit );

                birch_defmethod( $appointer->view, 'enqueue_scripts_edit', 
                    'birs_client', $ns->enqueue_scripts_edit );

                birch_defmethod( $appointer->view, 'enqueue_scripts_list', 
                    'birs_client', $ns->enqueue_scripts_list );

                birch_defmethod( $appointer->view, 'save_post', 
                    'birs_client', $ns->save_post );

                birch_defmethod( $appointer->view, 'pre_save_post', 
                    'birs_client', $ns->pre_save_post );

            });

        birch_defn($ns, 'wp_init', function() use ($ns) {
                $ns->register_post_type();
            });

        birch_defn($ns, 'wp_admin_init', function() use ($ns) {
                add_filter('manage_edit-birs_client_columns', array($ns, 'get_edit_columns'));
                add_action('manage_birs_client_posts_custom_column', array($ns, 'render_custom_columns'), 2);
            });

        birch_defn($ns, 'register_post_type', function() {
                register_post_type('birs_client', array(
                        'labels' => array(
                            'name' => __('Clients', 'appointer'),
                            'singular_name' => __('Client', 'appointer'),
                            'add_new' => __('Add Client', 'appointer'),
                            'add_new_item' => __('Add New Client', 'appointer'),
                            'edit' => __('Edit', 'appointer'),
                            'edit_item' => __('Edit Client', 'appointer'),
                            'new_item' => __('New Client', 'appointer'),
                            'view' => __('View Client', 'appointer'),
                            'view_item' => __('View Client', 'appointer'),
                            'search_items' => __('Search Clients', 'appointer'),
                            'not_found' => __('No Clients found', 'appointer'),
                            'not_found_in_trash' => __('No Clients found in trash', 'appointer'),
                            'parent' => __('Parent Client', 'appointer')
                        ),
                        'description' => __('This is where clients are stored.', 'appointer'),
                        'public' => false,
                        'show_ui' => true,
                        'menu_icon' => 'dashicons-id',
                        'capability_type' => 'birs_client',
                        'map_meta_cap' => true,
                        'publicly_queryable' => false,
                        'exclude_from_search' => true,
                        'show_in_menu' => true,
                        'hierarchical' => false,
                        'show_in_nav_menus' => false,
                        'rewrite' => false,
                        'query_var' => true,
                        'supports' => array('custom-fields'),
                        'has_archive' => false
                    )
                );
            });

        birch_defn($ns, 'load_page_edit', function($arg) use ($ns) {

                add_action('add_meta_boxes', array($ns, 'add_meta_boxes'));
                add_filter('post_updated_messages', array($ns, 'get_updated_messages'));
            });

        birch_defn($ns, 'enqueue_scripts_edit', function($arg) {

                global $appointer;

                $appointer->view->register_3rd_scripts();
                $appointer->view->register_3rd_styles();
                $appointer->view->enqueue_scripts(
                    array(
                        'appointer_view_clients_edit', 'appointer_model',
                        'appointer_view_admincommon', 'appointer_view'
                    )
                );
                $appointer->view->enqueue_styles(array('appointer_admincommon'));
            });

        birch_defn($ns, 'enqueue_scripts_list', function($arg) {

                global $appointer;

                $appointer->view->register_3rd_scripts();
                $appointer->view->register_3rd_styles();
            });

        birch_defn($ns, 'add_meta_boxes', function() use($ns) {
                remove_meta_box('slugdiv', 'birs_client', 'normal');
                remove_meta_box('postcustom', 'birs_client', 'normal');
                add_meta_box('appointer-client-info', __('Client Info', 'appointer'),
                    array($ns, 'render_client_info'), 'birs_client', 'normal', 'high');
            });

        birch_defn($ns, 'get_edit_columns', function($columns) {
                $columns = array();

                $columns["cb"] = "<input type=\"checkbox\" />";
                $columns["title"] = __("Client Name", 'appointer');
                $columns["birs_client_phone"] = __("Phone", 'appointer');
                $columns["birs_client_email"] = __("Email", 'appointer');
                $columns["birs_client_address"] = __("Address", 'appointer');
                return $columns;
            });

        birch_defn($ns, 'render_custom_columns', function($column) {
                global $post;

                if ($column === "birs_client_address") {
                    $address1 = get_post_meta($post->ID, '_birs_client_address1', true);
                    $address2 = get_post_meta($post->ID, '_birs_client_address2', true);
                    $value = $address1 . '<br>' . $address2;
                } else {
                    $value = get_post_meta($post->ID, '_' . $column, true);
                }

                echo $value;
            });

        birch_defn($ns, 'get_updated_messages', function($messages) {
                global $post, $post_ID, $appointer;

                if($appointer->view->has_errors()) {
                    $messages['birs_client'] = array(
                    );
                } else {
                    $messages['birs_client'] = array(
                        0 => '', // Unused. Messages start at index 1.
                        1 => __('Client updated.', 'appointer'),
                        2 => __('Custom field updated.', 'appointer'),
                        3 => __('Custom field deleted.', 'appointer'),
                        4 => __('Client updated.', 'appointer'),
                        5 => isset($_GET['revision']) ? sprintf(__('Client restored to revision from %s', 'appointer'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
                        6 => __('Client updated.', 'appointer'),
                        7 => __('Client saved.', 'appointer'),
                        8 => __('Client submitted.', 'appointer'),
                        9 => sprintf(__('Client scheduled for: <strong>%1$s</strong>.', 'appointer'), date_i18n('M j, Y @ G:i', strtotime($post->post_date))),
                        10 => __('Client draft updated.', 'appointer')
                    );
                }

                return $messages;
            });

        birch_defn($ns, 'save_post', function($post) {

                global $appointer;

                if (isset($_POST['birs_client_fields'])) {
                    $fields = $_POST['birs_client_fields'];
                } else {
                    $fields = array();
                }
                $config = array(
                    'meta_keys' => $fields,
                    'base_keys' => array()
                );
                $client_data =
                $appointer->view->merge_request($post, $config, $_POST);
                $appointer->model->save($client_data, $config);
            });

        birch_defn($ns, 'pre_save_post', function($post_data, $post_attr) {

                global $appointer;

                $errors = $appointer->view->clients->validate_data($post_attr['ID']);
                if($errors) {
                    $appointer->view->save_errors($errors);
                    return false;
                }

                if (isset($_POST['birs_client_name_first'])) {
                    $first_name = $_POST['birs_client_name_first'];
                } else {
                    $first_name = '';
                }
                if (isset($_POST['birs_client_name_last'])) {
                    $last_name = $_POST['birs_client_name_last'];
                } else {
                    $last_name = '';
                }
                $post_data['post_title'] = $first_name . ' ' . $last_name;
                return $post_data;
            });

        birch_defn($ns, 'validate_data', function($client_id) {
                global $appointer;

                $errors = array();
                if(!is_email($_POST['birs_client_email'])) {
                    $errors[] = __('The email address isn’t correct.', 'appointer');
                } else {
                    if($appointer->model->booking->if_email_duplicated($client_id, $_POST['birs_client_email'])) {
                        $errors[] = __('Email already exists.', 'appointer').
                        ' (' . $_POST['birs_client_email']. ')';
                    }
                }

                return $errors;
            });

        birch_defn($ns, 'get_client_details_html', function($client_id) {
                global $birchpress, $appointer;

                $post_id = $client_id;
                $client_titles = $birchpress->util->get_client_title_options();
                $client_title = get_post_meta($post_id, '_birs_client_title', true);
                $first_name = get_post_meta($post_id, '_birs_client_name_first', true);
                $last_name = get_post_meta($post_id, '_birs_client_name_last', true);
                $addresss1 = get_post_meta($post_id, '_birs_client_address1', true);
                $addresss2 = get_post_meta($post_id, '_birs_client_address2', true);
                $email = get_post_meta($post_id, '_birs_client_email', true);
                $phone = get_post_meta($post_id, '_birs_client_phone', true);
                $city = get_post_meta($post_id, '_birs_client_city', true);
                $zip = get_post_meta($post_id, '_birs_client_zip', true);
                $state = get_post_meta($post_id, '_birs_client_state', true);
                $country = get_post_meta($post_id, '_birs_client_country', true);
                if(!$country) {
                    $country = $appointer->model->get_default_country();
                }
                $states = $birchpress->util->get_states();
                $countries = $birchpress->util->get_countries();
                if(isset($states[$country])) {
                    $select_display = "";
                    $text_display = "display:none;";
                } else {
                    $select_display = "display:none;";
                    $text_display = "";
                }
                ob_start();
?>
        <style type="text/css">
            .appointer .form-field input[type="text"],
            .appointer .form-field select {
                width: 25em;
            }
        </style>
        <div class="panel-wrap appointer">
            <table class="form-table">
                <tr class="form-field">
                    <th><label><?php _e('Title', 'appointer'); ?> </label>
                    </th>
                    <td>
                        <select id="birs_client_title" name="birs_client_title">
                            <?php $birchpress->util->render_html_options($client_titles, $client_title); ?>
                        </select>
                        <input type="hidden" name="birs_client_fields[]" value="_birs_client_title" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label><?php _e('First Name', 'appointer'); ?> </label>
                    </th>
                    <td><input type="text" name="birs_client_name_first" id="birs_client_name_first" value="<?php echo esc_attr($first_name); ?>">
                    <input type="hidden" name="birs_client_fields[]" value="_birs_client_name_first" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label><?php _e('Last Name', 'appointer'); ?> </label>
                    </th>
                    <td><input type="text" name="birs_client_name_last" id="birs_client_name_last" value="<?php echo esc_attr($last_name); ?>">
                    <input type="hidden" name="birs_client_fields[]" value="_birs_client_name_last" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label><?php _e('Phone Number', 'appointer'); ?> </label>
                    </th>
                    <td>
                        <input type="text" name="birs_client_phone"
                               id="birs_client_phone" value="<?php echo esc_attr($phone); ?>">
                        <input type="hidden" name="birs_client_fields[]" value="_birs_client_phone" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label><?php _e('Email', 'appointer'); ?> </label>
                    </th>
                    <td><input type="text" name="birs_client_email"
                               id="birs_client_email" value="<?php echo esc_attr($email); ?>">
                    <input type="hidden" name="birs_client_fields[]" value="_birs_client_email" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label><?php _e('Address', 'appointer'); ?> </label>
                    </th>
                    <td><input type="text" name="birs_client_address1"
                               id="birs_client_address1"
                               value="<?php echo esc_attr($addresss1); ?>"> <br> <input type="text"
                               name="birs_client_address2" id="birs_client_address2"
                               value="<?php echo esc_attr($addresss2); ?>">
                    <input type="hidden" name="birs_client_fields[]" value="_birs_client_address1" />
                    <input type="hidden" name="birs_client_fields[]" value="_birs_client_address2" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label><?php _e('City', 'appointer'); ?> </label>
                    </th>
                    <td><input type="text" name="birs_client_city"
                               id="birs_client_city" value="<?php echo esc_attr($city); ?>">
                    <input type="hidden" name="birs_client_fields[]" value="_birs_client_city" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label><?php _e('State/Province', 'appointer'); ?> </label>
                    </th>
                    <td>
                        <select name="birs_client_state_select" id ="birs_client_state_select" style="<?php echo $select_display; ?>">
<?php
                if(isset($states[$country])) {
                    $birchpress->util->render_html_options($states[$country], $state);
                }
?>
                        </select>
                        <input type="text" name="birs_client_state" id="birs_client_state" value="<?php echo esc_attr($state); ?>" style="<?php echo $text_display; ?>" />
                    <input type="hidden" name="birs_client_fields[]" value="_birs_client_state" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label><?php _e('Country', 'appointer'); ?></label></th>
                    <td>
                        <select name="birs_client_country" id="birs_client_country">
                            <?php $birchpress->util->render_html_options($countries, $country); ?>
                        </select>
                    <input type="hidden" name="birs_client_fields[]" value="_birs_client_country" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label><?php _e('Zip Code', 'appointer'); ?> </label>
                    </th>
                    <td><input type="text" name="birs_client_zip"
                               id="birs_client_zip" value="<?php echo esc_attr($zip); ?>">
                    <input type="hidden" name="birs_client_fields[]" value="_birs_client_zip" />
                    </td>
                </tr>
            </table>
        </div>
<?php
                return ob_get_clean();
            });

        birch_defn($ns, 'render_client_info', function($post) {
                global $appointer;

                $appointer->view->render_errors();
                echo $appointer->view->clients->get_client_details_html($post->ID);
            });

    });
