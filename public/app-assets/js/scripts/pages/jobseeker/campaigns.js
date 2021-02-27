$(function() {
    'use strict';

    $(".tagsinput").tagsInput();

    // variables
    var createModal = $('#create-modal'),
        editModal = $('#edit-modal'),
        target_date = $('#target-date'),
        accountUploadImg = $('#account-upload-img'),
        accountUploadBtn = $('#account-upload'),
        accountUploadReset = $('#upload-btn-reset'),
        edit_target_date = $('#edit-target-date'),
        edit_accountUploadImg = $('#edit-account-upload-img'),
        edit_accountUploadBtn = $('#edit-account-upload'),
        edit_accountUploadReset = $('#edit-upload-btn-reset');

    var btnDelete = $('.btn-delete'),
        btnEdit = $('.btn-edit');
    // Update user photo on click of button
    if (accountUploadBtn || edit_accountUploadBtn) {
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

        edit_accountUploadBtn.on('change', function(e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function() {
                if (edit_accountUploadImg) {
                    edit_accountUploadImg.attr('src', reader.result);
                }
            };
            reader.readAsDataURL(files[0]);
        });
    }

    if (accountUploadReset || edit_accountUploadReset) {
        accountUploadReset.on('click', function(e) {
            accountUploadImg.attr('src', '../../../app-assets/images/portrait/small/no-image.png');
        });
        edit_accountUploadReset.on('click', function(e) {
            edit_accountUploadImg.attr('src', '../../../app-assets/images/portrait/small/no-image.png');
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
    editModal.on('submit', 'form', function(e) {
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
    btnEdit.on('click', async function(){
        var form = editModal.find('form');
        var id = $(this).data('id');
        form[0].reset();
        editModal.modal('show');
        const campaign = await $.get(`/jobseeker/campaigns/${id}/edit`);

        if(campaign.thumbnail_url != ''){
            edit_accountUploadImg.attr('src', campaign.thumbnail_url);
        }

        if(campaign.categories){
            let categories = [];
            $.each(campaign.categories, function(index, category){
                categories.push(category.id);
            });
            $.each(form.find('.custom-control-input'), function(i, categoryCheckBox){
                if($.inArray(parseInt($(categoryCheckBox).val()), categories) != -1){
                    $(categoryCheckBox).prop('checked', true);
                }
            });
        }

        form.find('input[name=id]').val(campaign.id);
        form.find('input[name=title]').val(campaign.title);
        form.find('textarea[name=description]').val(campaign.description);
        form.find('input[name=target_amount]').val(campaign.target_amount);

        if(campaign.tags){
            let tags = [];
            $.each(campaign.tags, function(i, tag){
                tags.push(tag.name);
            });
            form.find('.tagsinput').remove();
            form.find('input[name=tags]').val(tags.join(','));
            $(".edit-tagsinput").tagsInput("refresh");
        }
        form.find('input[name=tags]').val()

        if(edit_target_date.length){
            edit_target_date.flatpickr({
                defaultDate: dayjs(campaign.target_date).toDate(),
                onReady: function(selectedDates, dateStr, instance) {
                    if (instance.isMobile) {
                        $(instance.mobileInput).attr('step', null);
                    }
                }
            });
        }
    });
    btnDelete.on('click', function(){
        var id = $(this).data('id');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-outline-danger ml-1",
            },
            buttonsStyling: false,
        }).then(async function(result) {
            if (result.isConfirmed) {
                const deleteData = await $.get(`/jobseeker/campaigns/${id}/delete`);
                if (deleteData.success) {
                    toastr["success"](deleteData.msg, "Deleted!", {
                        closeButton: true,
                        tapToDismiss: false,
                    });
                    location.reload();
                }
            }
        });
    })
});