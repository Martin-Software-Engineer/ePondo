$(function() {
    'use strict';

    var dtTable = $('.invoices-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/jobseeker/invoice-list';

    // datatable
    if (dtTable.length) {
        var dt = dtTable.DataTable({
            ajax: {
                url: API_URL,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                }
            }, // JSON file to add data
            autoWidth: true,
            searching: false,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'invoice_id' },
                { data: 'jobseeker_name' },
                { data: 'jobseeker_id' },
                { data: 'backer_name' },
                { data: 'backer_id' },
                { data: 'service_title' },
                { data: 'order_id' },
                { data: 'categories' },
                { data: 'due_date' },
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
                    targets: 6,
                    render: function(data, type, row) {
                        if (row.service_title.length > 20) {
                            return row.service_title.substring(0, 20) + '...';
                        } else {
                            return row.service_title;
                        }

                    }
                },
                {
                    targets: 8,
                    render: function(data, type, row) {
                        var $elArray = [];
                        $.each(row.service_categories, function(index, category) {
                            $elArray.push(`<span class="badge badge-info">${category.name}</span>`);
                        });

                        return $elArray.join();
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
                            return 'Details of Invoice #' + data.invoice_id;
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
});