$(function() {
    'use strict';

    var dtTable = $('.orders-list-table'),
        cancelModal = $('#cancel-modal'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/backer/orders/data';

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
            processing: true,
            serverSide: true,
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'order_id' },
                { data: 'service.title' },
                { data: 'service.categories' },
                { data: 'service.duration' },
                { data: 'service.price' },
                { data: 'date' },
                { data: 'status.text' },
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
                        let categories = [];
                        $.each(row.service.categories, function(i, category) {
                            categories.push(`<span class="badge badge-primary">${category.name}</span>`);
                        });

                        return categories.join('');
                    }
                },
                {
                    targets: 7,
                    render: function(data, type, row) {
                        return $.parseHTML(row.status.text)[0].data;
                    }
                },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        var btns = [];
                        var statusCode = parseInt(full.status.code);
                        if (statusCode == 1 || statusCode == 2) {
                            btns.push(`<button type="button" class="mr-1 btn btn-danger btn-sm btn-cancel" data-id="${full.id}">Cancel</button>`);
                        }
                        return (
                            `<div class="d-flex align-items-center col-actions">
                                ${btns.join()}
                                <a class="mr-1 btn btn-primary btn-sm" href="/backer/orders/${full.id}/show">Details</a>
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
                searchPlaceholder: 'Search for Orders',
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
                            return 'Details of Service Order #' + data.order_id;
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

        $(document).on('click', '.btn-cancel', async function() {
            $('.dtr-bs-modal').modal('hide');

            const id = $(this).data('id');
            const order = await $.get('/backer/orders/' + id + '/edit');
            let form = cancelModal.find('form');

            form.find('input[name=id]').val(order.data.id);
            form.find('#order-no').val(order.data.order_id);
            form.find('#service-title').val(order.data.service.title);
            cancelModal.modal('show');
        });

        cancelModal.on('submit', 'form', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp.success) {
                        cancelModal.modal('hide');
                        toastr['success'](resp.msg, 'Success!', {
                            closeButton: true,
                            tapToDismiss: false
                        });

                        dt.ajax.reload();
                    }
                }
            });
        });
    }
});