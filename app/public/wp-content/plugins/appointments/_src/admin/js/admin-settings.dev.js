jQuery( document ).ready( function( $ ) {
    // COLOR SCHEMES (Display)
    var customColorRow = $(".custom_color_row");
    var presetSamples = $(".preset_samples");
    var _class, k, i;

    $('select[name="color_set"]').change(function () {
        var n = $(this).val();
        if (n == 0) {
            customColorRow.show();
            presetSamples.hide();
        }
        else {
            customColorRow.hide();
            presetSamples.show();
            for ( i in app_i10n.classes ) {
                if ( app_i10n.classes.hasOwnProperty( i ) ) {
                    _class = [];
                    for ( k = 1; k <= 3; k++ ) {
                        _class[ k ] = app_i10n.presets[i][k];
                    }
                    presetSamples.find("a." + i).css("background-color", "#" + _class[n]);
                }
            }
        }
    });

    var colorpicker = $('.colorpicker_input');
    colorpicker.each(function () {
        var id = this.id;
        $('#' + id).ColorPicker({
                onSubmit: function (hsb, hex, rgb, el) {
                    $(el).val(hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                },
                onChange: function (hsb, hex, rgb) {
                    var element = $('#' + id);
                    element.val(hex);
                    element.parent().find('a.pickcolor').css('background-color', '#' + hex);
                }
            })
            .bind('keyup', function () {
                $(this).ColorPickerSetColor(this.value);
            });
    });
    colorpicker.keyup(function () {
        var a = $(this).val();
        a = a.replace(/[^a-fA-F0-9]/, '');
        if (a.length === 3 || a.length === 6)
            $(this).parent().find('a.pickcolor').css('background-color', '#' + a);
    });

    /**
     * Check Services Provided on Appointments Settings page
     */
    $('#app-settings-section-new-worker form.add-new-service-provider').on( "submit", function() {
        var form = $(this);
        if( null == $("#services_provided", form).val()) {
            alert( app_i10n.messages.select_service_provider);
            return false;
        }
    });
    /**
     * Create a page
     */
    $('.appointment-create-page a.button').on( 'click', function() {
        var value = $('select', $(this).closest('td') ).val();
        var data = {
            action: $(this).data('action'),
            _wpnonce: $(this).data('nonce'),
            app_page_type: value
        };
        $.post(ajaxurl, data, function(response) {
            var html = '<div class="notice '+(response.success? 'updated':'error')+'"><p>'+response.data.message+'</p></div>';
            $('.appointments-settings h1').after(html);
        });
        return false;
    });

    /**
     * Delete helper
     *
     * @since 2.3.0
     */
    function appointments_delete_helper( data, parent ) {
        $.post( ajaxurl, data, function( response ) {
            if ( response.success ) {
                parent.detach();
            }
            var html = '<div class="notice notice-'+(response.success? 'success':'error')+' is-dismissible"><p>'+response.data.message+'</p></div>';
            $('.appointments-settings h1').after(html);
        });
    }
    /**
     * handle delete services
     *
     * @since 2.2.6
     */
    $(document).on('click', '.wp-list-table.services .delete a', function() {
        if ( window.confirm( app_i10n.messages.service.delete_confirmation ) ) {
            var parent = $(this).closest('tr');
            var data = {
                'action': 'delete_service',
                'nonce': $(this).data('nonce'),
                'id': $(this).data('id')
            };
            appointments_delete_helper( data, parent );
        }
    });

    /**
     * handle bulk action Services
     *
     * @since 2.3.0
     */
    $(document).on('click', '#app-settings-section-services input.action', function() {
        var parent = $(this).closest('form');
        var list = $('.check-column input:checked');
        var action = $('select', $(this).parent() ).val();
        if ( 0 === list.length ) {
            window.alert( app_i10n.messages.bulk_actions.no_items );
            return false;
        }
        if ( '-1' === action ) {
            window.alert( app_i10n.messages.bulk_actions.no_action );
            return false;
        }
        if ( !window.confirm( app_i10n.messages.services.delete_confirmation ) ) {
            return false;
        }
    });

    /**
     * handle delete service provider
     *
     * @since 2.2.6
     */
    $(document).on('click', '.wp-list-table.workers .delete a', function() {
        if ( window.confirm( app_i10n.messages.workers.delete_confirmation ) ) {
            var parent = $(this).closest('tr');
            var data = {
                'action': 'delete_worker',
                'nonce': $(this).data('nonce'),
                'id': $(this).data('id')
            };
            appointments_delete_helper( data, parent );
        }
    });

    /**
     * handle bulk action workers
     *
     * @since 2.3.0
     */
    $(document).on('click', '#app-settings-section-workers input.action', function() {
        var parent = $(this).closest('form');
        var list = $('.check-column input:checked');
        var action = $('select', $(this).parent() ).val();
        if ( 0 === list.length ) {
            window.alert( app_i10n.messages.bulk_actions.no_items );
            return false;
        }
        if ( '-1' === action ) {
            window.alert( app_i10n.messages.bulk_actions.no_action );
            return false;
        }
        if ( !window.confirm( app_i10n.messages.workers.delete_confirmation ) ) {
            return false;
        }
    });

    /**
     * Slider widget
     *
     * @since 2.3.2
     */
    if ( $.fn.slider ) {
        $('div.app-ui-slider').each( function() {
            var id = $(this).data('target-id');
            if ( id ) {
                var target = $('#'+id);
                var value = target.val();
                var max = $(this).data('max') || 100;
                var min = $(this).data('min') || 0;
                $(this).slider({
                    value: value,
                    min: min,
                    max: max,
                    slide: function( event, ui ) {
                        target.val( ui.value );
                    }
                });
            }
        });
    }

    /**
     * add tab to request "hidden-columns".
     *
     * @since 2.4.0
     */
    columns.saveManageColumnsState = function() {
        var hidden = this.hidden();
        $.post(ajaxurl, {
            action: 'hidden-columns',
            hidden: hidden,
            screenoptionnonce: $('#screenoptionnonce').val(),
            page: pagenow,
            tab: $('input[name=app-current-tab]').val()
        });
    };

});
