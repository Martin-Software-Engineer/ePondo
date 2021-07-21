$(function() {
    'use strict';

    var dtTableBacker = $('.backer-list-table'),
        dtTableJobseeker = $('.jobseeker-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/ratings';

    // datatable
    if (dtTableBacker.length) {
        var dtBacker = dtTableBacker.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL,
                data: {
                    from: 'backer'
                }
            },
            autoWidth: true,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'rating_id' },
                { data: 'order_id' },
                { data: 'service_title' },
                { data: 'backer_name' },
                { data: 'backer_id' },
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
                    targets: 3,
                    render: function(data, type, row) {
                        if (row.service_title.length > 20) {
                            return row.service_title.substring(0, 20) + '...';
                        } else {
                            return row.service_title;
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
                                <a class="mr-1 btn-edit" href="/admin/ratings/${full.id}" data-toggle="tooltip" data-placement="top" title="View">${feather.icons['eye'].toSvg({ class: 'font-medium-2' })}</a>
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
                searchPlaceholder: 'Search for Backer',
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
                            return 'Details of ' + data.service_title;
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

        $('#backer-tab').on('click', function() {
            dtBacker.ajax.reload();
        });
    }
    if (dtTableJobseeker.length) {
        var dtJobseeker = dtTableJobseeker.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL,
                data: {
                    from: 'jobseeker'
                }
            },
            autoWidth: true,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'rating_id' },
                { data: 'order_id' },
                { data: 'service_title' },
                { data: 'jobseeker_name' },
                { data: 'jobseeker_id' },
                { data: 'rating' },
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
                    targets: 3,
                    render: function(data, type, row) {
                        if (row.service_title.length > 20) {
                            return row.service_title.substring(0, 20) + '...';
                        } else {
                            return row.service_title;
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
                              <a class="mr-1 btn-edit" href="/admin/ratings/${full.id}" data-toggle="tooltip" data-placement="top" title="View">${feather.icons['eye'].toSvg({ class: 'font-medium-2' })}</a>
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
                            return 'Details of ' + data.service_title;
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

        $('#jobseeker-tab').on('click', function() {
            dtJobseeker.ajax.reload();
        });
    }
});