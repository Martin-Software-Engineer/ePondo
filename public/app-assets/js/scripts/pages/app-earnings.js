$(function() {
    'use strict';

    var dtTable = $('.earnings-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/earnings';

    // datatable
    if (dtTable.length) {
        var dt = dtTable.DataTable({
            ajax: API_URL, // JSON file to add data
            autoWidth: true,
            processing: true,
            serverSide: true,
            columns: [
                // columns according to JSON
                // { data: 'id' },
                // { data: 'name' },
                // { data: 'email' },
                // { data: 'roles' },
                // { data: '' }
                { data: 'id' },
                { data: 'user_id' },
                { data: 'first_name' },
                { data: 'last_name' },
                { data: 'email' },
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
                // {
                //     targets: 3,
                //     render: function(data, type, row) {
                //         var group = [];
                //         $.each(row.roles, function(index, role) {
                //             group.push(`<span class="badge badge-info">${role.name}</span>`);
                //         });

                //         return group.join();
                //     }
                // },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return (
                            `<div class="d-flex align-items-center col-actions">
                              <a class="mr-1 btn-edit" href="/admin/users/${full.id}/edit" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons['edit-2'].toSvg({ class: 'font-medium-2' })}</a>
                              <a class="mr-1 btn-delete" href="javascript:void(0);" data-toggle="tooltip" data-id="${full.id}" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>
                            </div>
                            `
                        );
                    }
                }
            ],
            buttons: [],
            order: [
                [0, 'desc']
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
                searchPlaceholder: 'Search for Jobseeker',
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
                            return 'Details of ' + data.jobseeker_name;
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

    // $(document).on('click', '.btn-delete', function() {
    //     let id = $(this).data('id');
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Yes, delete it!',
    //         customClass: {
    //             confirmButton: 'btn btn-primary',
    //             cancelButton: 'btn btn-outline-danger ml-1'
    //         },
    //         buttonsStyling: false
    //     }).then(async function(result) {
    //         if (result.isConfirmed) {
    //             const deleteData = await $.get(`users/${id}/delete`);
    //             if (deleteData.success) {
    //                 toastr['success'](deleteData.msg, 'Deleted!', {
    //                     closeButton: true,
    //                     tapToDismiss: false,
    //                     rtl: isRtl
    //                 });
    //                 dt.ajax.reload();
    //             }
    //         }
    //     });
    // });
});