<?php

birch_ns( 'appointer.gsettings.upgrader', function( $ns ) {

        global $appointer;

        $default_options_1_0 = array(
            'currency' => 'USD',
            'default_calendar_view' => 'agendaWeek'
        );

        $default_options_1_1 = $default_options_1_0;
        $default_options_1_1['version'] = '1.1';

        $default_options = $default_options_1_1;

        birch_defn( $ns, 'init', function() use ( &$default_options, $ns, $appointer ) {
                $options = get_option( 'appointer_options' );
                if ( $options === false ) {
                    add_option( 'appointer_options', $default_options );
                }
                birch_defmethod( $appointer, 'upgrade_module', 'gsettings', $ns->upgrade_module );
            } );

        birch_defn( $ns, 'upgrade_module', function() use( $ns ) {
                $ns->init();
                $ns->upgrade_1_0_to_1_1();
            } );

        birch_defn( $ns, 'get_db_version_options', function() {
                $options = get_option( 'appointer_options' );
                if ( isset( $options['version'] ) ) {
                    return $options['version'];
                } else {
                    return '1.0';
                }
            } );

        birch_defn( $ns, 'upgrade_1_0_to_1_1', function() use ( $ns ) {
                $version = $ns->get_db_version_options();
                if ( $version !== '1.0' ) {
                    return;
                }
                $options = get_option( 'appointer_options' );
                $options['version'] = '1.1';
                update_option( 'appointer_options', $options );
            } );

    } );
