$(function() {
    'use strict';
    var btnDelete = $('.btn-delete'),
        btnEdit = $('.btn-edit');

    btnEdit.on('click', async function() {
        var form = editModal.find('form');
        var id = $(this).data('id');
        form[0].reset();
        editModal.modal('show');
        const service = await $.get(`/jobseeker/services/${id}/edit`);

        if (service.thumbnail_url != '') {
            edit_accountUploadImg.attr('src', service.thumbnail_url);
        }

        if (service.categories) {
            let services = [];
            $.each(service.categories, function(index, category) {
                services.push(category.id);
            });
            $.each(form.find('.custom-control-input'), function(i, categoryCheckBox) {
                if ($.inArray(parseInt($(categoryCheckBox).val()), services) != -1) {
                    $(categoryCheckBox).prop('checked', true);
                }
            });
        }

        form.find('input[name=id]').val(service.id);
        form.find('input[name=title]').val(service.title);
        form.find('textarea[name=description]').val(service.description);
        form.find('input[name=price]').val(service.price);
        form.find('input[name=duration]').val(service.duration);
        form.find('input[name=location]').val(service.location);

        if (service.tags) {
            let tags = [];
            $.each(service.tags, function(i, tag) {
                tags.push(tag.name);
            });
            form.find('.tagsinput').remove();
            form.find('input[name=tags]').val(tags.join(','));
            $(".edit-tagsinput").tagsInput("refresh");
        }
        form.find('input[name=tags]').val()
    });
    btnDelete.on('click', function() {
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
                const deleteData = await $.get(`/jobseeker/services/${id}/delete`);
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