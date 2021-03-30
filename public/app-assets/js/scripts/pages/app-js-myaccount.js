$(function() {
    'use strict';

    var form = $('form');

    form.on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
                form.find('button[type=submit]').prop('disabled', true);
            },
            success: function(resp) {
                if (resp.success) {
                    form.find('button[type=submit]').prop('disabled', false);

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            },
            error: function(xhr, status, error) {
                form.find('button[type=submit]').prop('disabled', false);

                $.each(xhr.responseJSON.errors, function(key, text) {
                    toastr['error'](text[0], 'Error!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                });

            }
        })
    });

    $('.kids-repeater, .dependents-repeater').repeater({
        show: function() {
            $(this).slideDown();
            // Feather Icons
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

    $('.select2').each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent()
        });
    });
});