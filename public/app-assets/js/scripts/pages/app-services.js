$(function() {
    'use strict';

    var dtTable = $('.services-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/services';

    // datatable
    if (dtTable.length) {
        var dt = dtTable.DataTable({
            ajax: API_URL, // JSON file to add data
            autoWidth: true,
            processing: true,
            serverSide: true,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'service_id' },
                { data: 'jobseeker_id' },
                { data: 'title' },
                { data: 'category' },
                { data: 'duration' },
                { data: 'status' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    targets: 0,
                    render: function() {
                        return '';
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        if (row.title.length > 20) {
                            return row.title.substring(0, 20) + '...';
                        } else {
                            return row.title;
                        }

                    }
                },
                {
                    targets: 5,
                    render: function(data, type, row) {
                        var $elArray = [];
                        $.each(row.categories, function(index, category) {
                            $elArray.push(`<span class="badge badge-info">${category.name}</span>`);
                        });

                        return $elArray.join();
                    }
                },
                {
                    targets: 6,
                    render: function(data, type, row) {
                        if(row.status == 1){
                            return (
                                `<div class="d-flex align-items-center col-actions">
                                    <span class="badge badge-info" style="background-color:limegreen">Available</span>
                                </div>
                                `
                            );
                        }
                        else if (row.status == 2){
                            return (
                                `<div class="d-flex align-items-center col-actions">
                                    <span class="badge badge-danger">Deleted</span>
                                </div>
                                `
                            );
                        }
                        else{
                            return (
                                `<div class="d-flex align-items-center col-actions">
                                    <span class="badge badge-warning">Error Status</span>
                                </div>
                                `
                            );
                        }
                        
                    }
                },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return (
                            `<div class="d-flex align-items-center col-actions">
                              <a class="mr-1 btn-edit" href="/admin/services/${full.id}" data-toggle="tooltip" data-placement="top" title="Details">${feather.icons['eye'].toSvg({ class: 'font-medium-2' })}</a>  
                              <a class="mr-1 btn-edit" href="/admin/services/${full.id}/edit" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons['edit-2'].toSvg({ class: 'font-medium-2' })}</a>
                              <a class="mr-1 btn-delete" href="javascript:void(0);" data-toggle="tooltip" data-id="${full.id}" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>
                            </div>
                            `
                        );
                    }
                }
            ],
            buttons: [],
            order: [
                [1, 'desc']
            ],
            dom: '<"row d-flex justify-content-between align-items-center m-1"' +
                '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-lg-right text-left "B>>' +
                '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"invoice_status ml-sm-2">>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search for Services',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of Services #' + data.service_id;
                        }
                    }),
                    type: 'column',
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table',
                        columnDefs: [{
                            targets: 1,
                            visible: false
                        }, {
                            targets: 2,
                            visible: false
                        }]
                    })
                }
            },
            initComplete: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
                // Adding role filter once table initialized
            },
            drawCallback: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            }
        });
    }

    $(document).on('click', '.btn-delete', function() {
        $(".dtr-bs-modal").modal("hide");
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false
        }).then(async function(result) {
            if (result.isConfirmed) {
                const deleteData = await $.get(`services/${id}/delete`);
                if (deleteData.success) {
                    toastr['success'](deleteData.msg, 'Deleted!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    dt.ajax.reload();
                }
            }
        });

    });
});