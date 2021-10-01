$(function() {
    'use strict';

    var formAccount = $('#form-account'),
        formPassword = $('#form-password'),
        accountUploadImg = $('#account-upload-img'),
        accountUploadBtn = $('#account-upload');

    // Update user photo on click of button
    if (accountUploadBtn) {
        accountUploadBtn.on('change', function(e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function() {
                if (accountUploadImg) {
                    accountUploadImg.attr('src', reader.result);
                }
            };
            reader.readAsDataURL(files[0]);
        });
    }

    formAccount.on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                formAccount.find('button[type=submit]').prop('disabled', true);
                formAccount.find('.invalid-feedback').remove();
                formAccount.find('.valid-feedback').remove();
                formAccount.find('.invalid-feedback.valid-feedback').remove();
                formAccount.find('input').removeClass('is-invalid');
            },
            success: function(resp) {
                if (resp.success) {
                    formAccount.find('button[type=submit]').prop('disabled', false);

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            },
            error: function(resp) {
                $.each(resp.responseJSON.errors, function(name, error) {
                    formAccount.find('button[type=submit]').prop('disabled', false);
                    formAccount.find('#' + name).siblings('.invalid-feedback').remove();
                    formAccount.find('#' + name).siblings('.valid-feedback').remove();
                    formAccount.find('#' + name).siblings('.invalid-feedback.valid-feedback').remove();
                    formAccount.find('#' + name).addClass('is-invalid');
                    formAccount.find('#' + name).after(`
                        <div class="invalid-feedback">
                        ${error}
                    </div>
                    `);
                });

            }
        })
    });

    formPassword.on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
                formPassword.find('button[type=submit]').prop('disabled', true);
            },
            success: function(resp) {
                if (resp.success) {
                    formPassword.find('button[type=submit]').prop('disabled', false);

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
                formPassword.find('button[type=submit]').prop('disabled', false);

                $.each(xhr.responseJSON.errors, function(key, text) {
                    toastr['error'](text[0], 'Error!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                });

            }
        })
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