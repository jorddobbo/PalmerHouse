<?php

birch_ns( 'appointer.view.calendar', function( $ns ) {

        birch_defn( $ns, 'init', function() use ( $ns ) {
                global $appointer;

                add_action( 'admin_init', array( $ns, 'wp_admin_init' ) );

                $appointer->view->register_script_data_fn(
                    'appointer_view_calendar', 'appointer_view_calendar',
                    array( $ns, 'get_script_data_fn_view_calendar' ) );
            } );

        birch_defn( $ns, 'wp_admin_init', function() use ( $ns ) {
                global $appointer;

                add_action( 'admin_enqueue_scripts', function( $hook ) {
                        global $appointer;

                        if ( $appointer->view->get_page_hook( 'calendar' ) !== $hook ) {
                            return;
                        }

                        $appointer->view->calendar->enqueue_scripts();
                    } );

                add_action( 'wp_ajax_appointer_view_calendar_query_appointments',
                    array( $ns, 'ajax_query_appointments' ) );

                add_action( 'appointer_view_render_calendar_page_after', array( $ns, 'render_admin_page' ) );

            } );

        birch_defn( $ns, 'get_script_data_fn_view_calendar', function() use ( $ns ) {
                return array(
                    'default_calendar_view' => $ns->get_default_view(),
                    'location_map' => $ns->get_locations_map(),
                    'location_staff_map' => $ns->get_locations_staff_map(),
                    'location_order' => $ns->get_locations_listing_order(),
                    'staff_order' => $ns->get_staff_listing_order(),
                    'slot_minutes' => 15,
                    'first_hour' => 9
                );
            } );

        birch_defn( $ns, 'enqueue_scripts', function() use ( $ns ) {
                global $appointer;

                $appointer->view->register_3rd_scripts();
                $appointer->view->register_3rd_styles();
                $appointer->view->enqueue_scripts(
                    array(
                        'appointer_view_calendar', 'appointer_view',
                        'appointer_view_admincommon', 'appointer_model',
                        'bootstrap'
                    )
                );
                $appointer->view->enqueue_styles(
                    array(
                        'fullcalendar_birchpress', 'bootstrap-theme',
                        'appointer_admincommon', 'appointer_calendar',
                        'select2', 'jgrowl'
                    )
                );
            } );

        birch_defn( $ns, 'get_default_view', function() {
                return 'agendaWeek';
            } );

        birch_defn( $ns, 'query_appointments', function( $start, $end, $location_id, $staff_id ) use ( $ns ) {
                global $appointer, $birchpress;

                $criteria = array(
                    'start' => $start,
                    'end' => $end,
                    'location_id' => $location_id,
                    'staff_id' => $staff_id
                );
                $appointments =
                $appointer->model->booking->query_appointments( $criteria,
                    array(
                        'appointment_keys' => array(
                            '_birs_appointment_duration', '_birs_appointment_price',
                            '_birs_appointment_timestamp', '_birs_appointment_service'
                        ),
                        'client_keys' => array( 'post_title' )
                    )
                );
                $apmts = array();
                foreach ( $appointments as $appointment ) {
                    $title = $appointer->model->booking->get_appointment_title( $appointment );
                    $appointment['post_title'] = $title;
                    $duration = intval( $appointment['_birs_appointment_duration'] );
                    $price = $appointment['_birs_appointment_price'];
                    $time_start = $appointment['_birs_appointment_timestamp'];
                    $time_end = $time_start + $duration * 60;
                    $time_start = $birchpress->util->get_wp_datetime( $time_start )->format( 'c' );
                    $time_end = $birchpress->util->get_wp_datetime( $time_end )->format( 'c' );
                    $apmt = array(
                        'id' => $appointment['ID'],
                        'title' => $appointment['post_title'],
                        'start' => $time_start,
                        'end' => $time_end,
                        'allDay' => false,
                        'editable' => true
                    );
                    $apmts[] = $apmt;
                }

                return $apmts;
            } );

        birch_defn( $ns, 'get_locations_map', function() use ( $ns ) {
                global $appointer;

                $i18n_msgs = $appointer->view->get_frontend_i18n_messages();
                $locations_map = $appointer->model->get_locations_map();
                $locations_map[-1] = array(
                    'post_title' => $i18n_msgs['All Locations']
                );
                return $locations_map;
            } );

        birch_defn( $ns, 'get_locations_staff_map', function() use ( $ns ) {
                global $appointer;

                $i18n_msgs = $appointer->view->get_frontend_i18n_messages();
                $map = $appointer->model->get_locations_staff_map();
                $allstaff = $appointer->model->query(
                    array(
                        'post_type' => 'birs_staff'
                    ),
                    array(
                        'meta_keys' => array(),
                        'base_keys' => array( 'post_title' )
                    )
                );
                $new_allstaff = array(
                    '-1' => $i18n_msgs['All Providers']
                );
                foreach ( $allstaff as $staff_id => $staff ) {
                    $new_allstaff[$staff_id] = $staff['post_title'];
                }
                $map[-1] = $new_allstaff;
                return $map;
            } );

        birch_defn( $ns, 'get_locations_services_map', function() {
                global $appointer;

                return $appointer->model->get_locations_services_map();
            } );

        birch_defn( $ns, 'get_services_staff_map', function() {
                global $appointer;

                return $appointer->model->get_services_staff_map();
            } );

        birch_defn( $ns, 'get_locations_listing_order', function() {
                global $appointer;

                $locations = $appointer->model->get_locations_listing_order();
                $locations = array_merge( array( -1 ), $locations );
                return $locations;
            } );

        birch_defn( $ns, 'get_staff_listing_order', function() {
                global $appointer;

                return $appointer->model->get_staff_listing_order();
            } );

        birch_defn( $ns, 'get_services_listing_order', function() {
                global $appointer;

                return $appointer->model->get_services_listing_order();
            } );

        birch_defn( $ns, 'get_services_prices_map', function() {
                global $appointer;

                return $appointer->model->get_services_prices_map();
            } );

        birch_defn( $ns, 'get_services_duration_map', function() {
                global $appointer;

                return $appointer->model->get_services_duration_map();
            } );

        birch_defn( $ns, 'ajax_query_appointments', function() use ( $ns ) {
                global $appointer, $birchpress;

                $start = $_GET['birs_time_start'];
                $start = $birchpress->util->get_wp_datetime( $start )->format( 'U' );
                $end = $_GET['birs_time_end'];
                $end = $birchpress->util->get_wp_datetime( $end )->format( 'U' );
                $location_id = $_GET['birs_location_id'];
                $staff_id = $_GET['birs_staff_id'];

                $apmts = $appointer->view->calendar->query_appointments( $start, $end, $location_id, $staff_id );
?>
        <div id="birs_response">
            <?php
                echo json_encode( $apmts );
?>
        </div>
        <?php
                exit;
            } );

        birch_defn( $ns, 'render_admin_page', function() use ( $ns ) {
                global $appointer;

                $appointer->view->show_notice();
                $ns->render_calendar_scene();
            } );

        birch_defn( $ns, 'render_calendar_scene', function() {
?>
                <div class="birs_scene" id="birs_calendar_scene">
                    <h2 style="display:none;"></h2>
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#birs_calendar_menu">
                              <span class="sr-only">Toggle navigation</span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="birs_calendar_menu">
                            <div class="btn-group navbar-btn">
                                <button type="button" class="btn btn-default"
                                    id="birs_add_appointment">
                                    <?php _e( 'New Appointment', 'appointer' ); ?>
                                </button>
                                <button type="button" class="btn btn-default"
                                    id="birs_calendar_refresh">
                                       <span class="glyphicon glyphicon-refresh"></span>
                                </button>
                            </div>
                            <div class="btn-group navbar-btn">
                                <button type="button" class="btn btn-default"
                                    id="birs_calendar_today">
                                    <?php _e( 'Today', 'appointer' ); ?>
                                </button>
                            </div>
                            <div class="btn-group navbar-btn" data-toggle="buttons">
                                <label class="btn btn-default">
                                    <input type="radio" name="birs_calendar_view_choice" value="month">
                                    <?php _e( 'Month', 'appointer' ); ?>
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="birs_calendar_view_choice" value="agendaWeek">
                                    <?php _e( 'Week', 'appointer' ); ?>
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="birs_calendar_view_choice" value="agendaDay">
                                    <?php _e( 'Day', 'appointer' ); ?>
                                </label>
                                <input type="hidden" name="birs_calendar_view" />
                                <input type="hidden" name="birs_calendar_current_date" />
                            </div>
                            <div class="input-group">
                                <select id="birs_calendar_location">
                                </select>
                                <select id="birs_calendar_staff">
                                </select>
                            </div>
                        </div>
                    </nav>
                    <div id="birs_calendar_header">
                        <table class="fc-header" style="width:100%">
                            <tbody>
                                <tr>
                                    <td class="fc-header-left">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </button>
                                    </td>
                                    <td class="fc-header-center">
                                        <span class="fc-header-title">
                                            <h2></h2>
                                        </span>
                                    </td>
                                    <td class="fc-header-right">
                                        <button type="button" class="btn btn-default btn-sm">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="birs_calendar">
                    </div>
                </div>
<?php
            } );

    } );
