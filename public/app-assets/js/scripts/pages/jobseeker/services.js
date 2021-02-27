$(function() {
    'use strict';

    $(".tagsinput").tagsInput();

    // variables
    var createModal = $('#create-modal'),
        target_date = $('#target-date'),
        accountUploadImg = $('#account-upload-img'),
        accountUploadBtn = $('#account-upload'),
        accountUploadReset = $('#upload-btn-reset');

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

    if (accountUploadReset) {
        accountUploadReset.on('click', function(e) {
            accountUploadImg.attr('src', '../../../app-assets/images/portrait/small/no-image.png');
        });
    }

    if (target_date.length) {
        target_date.flatpickr({
            onReady: function(selectedDates, dateStr, instance) {
                if (instance.isMobile) {
                    $(instance.mobileInput).attr('step', null);
                }
            }
        });
    }

    createModal.on('submit', 'form', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $(this).find('button[type=submit]').prop('disabled', true);
            },
            success: function(resp) {
                $(this).find('button[type=submit]').prop('disabled', false);
                if (resp.success) {
                    createModal.modal('hide');
                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false
                    });

                    location.reload();
                }
            }
        });
    });
});