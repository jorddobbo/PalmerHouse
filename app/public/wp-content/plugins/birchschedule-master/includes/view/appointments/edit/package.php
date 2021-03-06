<?php

birch_ns( 'appointer.view.appointments.edit', function( $ns ) {

        global $appointer;

        birch_defn( $ns, 'init', function() use ( $ns, $appointer ) {

                add_action( 'admin_init', array( $ns, 'wp_admin_init' ) );

                add_action( 'init', array( $ns, 'wp_init' ) );

                add_action( 'appointer_view_register_common_scripts_after',
                    array( $ns, 'register_scripts' ) );

                birch_defmethod( $appointer->view, 'load_post_edit',
                    'birs_appointment', $ns->load_post_edit );

                birch_defmethod( $appointer->view, 'enqueue_scripts_post_edit',
                    'birs_appointment', $ns->enqueue_scripts_post_edit );

            } );

        birch_defn( $ns, 'wp_init', function() use ( $ns ) {
                global $appointer;

                $appointer->view->register_script_data_fn(
                    'appointer_view_appointments_edit', 'appointer_view_appointments_edit',
                    array( $ns, 'get_script_data_fn_view_appointments_edit' ) );
            } );

        birch_defn( $ns, 'wp_admin_init', function() use ( $ns ) {

            } );

        birch_defn( $ns, 'get_script_data_fn_view_appointments_edit', function() use ( $ns ) {
                return array(
                    'services_staff_map' => $ns->get_services_staff_map(),
                    'locations_map' => $ns->get_locations_map(),
                    'services_map' => $ns->get_services_map(),
                    'locations_staff_map' => $ns->get_locations_staff_map(),
                    'locations_services_map' => $ns->get_locations_services_map(),
                    'locations_order' => $ns->get_locations_listing_order(),
                    'staff_order' => $ns->get_staff_listing_order(),
                    'services_order' => $ns->get_services_listing_order(),
                );
            } );

        birch_defn( $ns, 'register_scripts', function() use ( $ns ) {
                global $appointer;

                $version = $appointer->get_product_version();

                wp_register_script( 'appointer_view_appointments_edit',
                    $appointer->plugin_url() . '/assets/js/view/appointments/edit/base.js',
                    array( 'appointer_view_admincommon', 'appointer_view', 'jquery-ui-datepicker' ), "$version" );
            } );

        birch_defn( $ns, 'get_locations_map', function() {
                global $appointer;

                return $appointer->model->get_locations_map();
            } );

        birch_defn( $ns, 'get_services_map', function() {
                global $appointer;

                return $appointer->model->get_services_map();
            } );

        birch_defn( $ns, 'get_locations_staff_map', function() {
                global $appointer;

                return $appointer->model->get_locations_staff_map();
            } );

        birch_defn( $ns, 'get_locations_services_map', function() {
                global $appointer;

                return $appointer->model->get_locations_services_map();
            } );

        birch_defn( $ns, 'get_services_staff_map', function() {
                global $appointer;

                return $appointer->model->get_services_staff_map();
            } );

        birch_defn( $ns, 'get_services_locations_map', function() {
                global $appointer;

                return $appointer->model->get_services_locations_map();
            } );

        birch_defn( $ns, 'get_locations_listing_order', function() {
                global $appointer;

                return $appointer->model->get_locations_listing_order();
            } );

        birch_defn( $ns, 'get_staff_listing_order', function() {
                global $appointer;

                return $appointer->model->get_staff_listing_order();
            } );

        birch_defn( $ns, 'get_services_listing_order', function() {
                global $appointer;

                return $appointer->model->get_services_listing_order();
            } );

        birch_defn( $ns, 'load_post_edit', function( $arg ) use ( $ns ) {

                add_action( 'add_meta_boxes',
                    array( $ns, 'add_meta_boxes' ) );
            } );

        birch_defn( $ns, 'enqueue_scripts_post_edit', function( $arg ) {

                global $appointer;

                $appointer->view->register_3rd_scripts();
                $appointer->view->register_3rd_styles();
                $appointer->view->enqueue_scripts(
                    array(
                        'appointer_view_appointments_edit'
                    )
                );
                $appointer->view->enqueue_styles( array( 'appointer_appointments_edit' ) );
            } );

        birch_defn( $ns, 'add_meta_boxes', function() use ( $ns ) {
                add_meta_box( 'meta_box_birs_appointment_edit_info', __( 'Appointment Info', 'appointer' ),
                    array( $ns, 'render_appointment_info' ), 'birs_appointment', 'normal', 'high' );
                add_meta_box( 'meta_box_birs_appointment_edit_actions', __( 'Actions', 'appointer' ),
                    array( $ns, 'render_actions' ), 'birs_appointment', 'side', 'high' );
            } );

        birch_defn( $ns, 'get_back_to_calendar_url', function() use ( $ns ) {
                global $appointer;

                $back_url = admin_url( 'admin.php?page=appointer_calendar' );
                $hash_string = $appointer->view->get_query_string( $_GET,
                    array(
                        'calview', 'locationid', 'staffid', 'currentdate'
                    )
                );
                if ( $hash_string ) {
                    $back_url = $back_url . '#' . $hash_string;
                }
                return $back_url;
            } );

        birch_defn( $ns, 'render_actions', function( $post ) use ( $ns ) {
                $back_url = $ns->get_back_to_calendar_url();
?>
                <div class="submitbox">
                    <div style="float:left;">
                        <a href="<?php echo $back_url; ?>">
                            <?php _e( 'Back to Calendar', 'appointer' ); ?>
                        </a>
                    </div>
                    <div class="clear"></div>
                </div>
<?php

            } );

        birch_defn( $ns, 'render_appointment_info', function( $post ) use ( $ns ) {
                global $appointer;

                $location_id = 0;
                $staff_id = 0;
                $appointment_id = 0;
                $client_id = 0;
                $appointment_id = $post->ID;
                $back_url = $ns->get_back_to_calendar_url();
?>
                <div>
<?php
                echo $ns->get_appointment_info_html( $appointment_id );
?>
                    <ul>
                        <li>
                            <label>
                                &nbsp;
                            </label>
                            <div>
                            </div>
                        </li>
                    </ul>
                </div>
<?php
            } );

        birch_defn( $ns, 'get_appointment_info_html', function( $appointment_id ) use ( $ns ) {
                global $birchpress, $appointer;

                $appointment = $appointer->model->get( $appointment_id, array(
                        'base_keys' => array(),
                        'meta_keys' => $appointer->model->get_appointment_fields()
                    ) );

                $options = $birchpress->util->get_time_options( 5 );
                if ( $appointment ) {
                    $location_id = $appointment['_birs_appointment_location'];
                    $location = $appointer->model->get($location_id, array('keys' => array('post_title')));
                    $location_name = $location ? $location['post_title'] : '';

                    $service_id = $appointment['_birs_appointment_service'];
                    $service = $appointer->model->get($service_id, array('keys' => array('post_title')));
                    $service_name = $service ? $service['post_title'] : '';

                    $staff_id = $appointment['_birs_appointment_staff'];
                    $staff = $appointer->model->get($staff_id, array('keys' => array('post_title')));
                    $staff_name = $staff ? $staff['post_title'] : '';

                    $timestamp = $birchpress->util->get_wp_datetime( $appointment['_birs_appointment_timestamp'] );
                    $date4picker = $timestamp->format( get_option( 'date_format' ) );
                    $date = $timestamp->format( 'm/d/Y' );
                    $time = $timestamp->format( get_option( 'time_format' ) );
                }
                ob_start();
?>
                <input type="hidden" name="birs_appointment_id" id="birs_appointment_id" value="<?php echo $appointment_id; ?>">
                <ul>
                    <li class="birs_form_field">
                        <label>
                            <?php _e( 'Location', 'appointer' ); ?>
                        </label>
                        <div class="birs_field_content">
                            <label><?php echo $location_name; ?></label> 
                        </div>
                    </li>
                    <li class="birs_form_field">
                        <label>
                            <?php _e( 'Service', 'appointer' ); ?>
                        </label>
                        <div class="birs_field_content">
                            <label><?php echo $service_name; ?></label>
                        </div>
                    </li>
                    <li class="birs_form_field">
                        <label>
                            <?php _e( 'Provider', 'appointer' ); ?>
                        </label>
                        <div class="birs_field_content">
                            <label><?php echo $staff_name; ?></label>
                        </div>
                    </li>
                    <li class="birs_form_field">
                        <label>
                            <?php _e( 'Date', 'appointer' ); ?>
                        </label>
                        <div class="birs_field_content">
                            <div id="birs_appointment_view_datepicker"
                                style="pointer-events: none;"
                                data-date-value="<?php echo $date; ?>"></div>
                        </div>
                    </li>
                    <li class="birs_form_field">
                        <label>
                            <?php _e( 'Time', 'appointer' ); ?>
                        </label>
                        <div class="birs_field_content">
                            <label>
                                <?php echo $time; ?>
                            </label>
                        </div>
                    </li>
                </ul>
<?php
                return ob_get_clean();
            } );

    } );
