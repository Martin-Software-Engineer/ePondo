$(function() {
    'use strict';

    var dtTable = $('.orders-list-table'),
        feedback_modal = $('#feedback-modal'),
        API_URL = '/jobseeker/order-list';

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
                { data: 'order_id' },
                { data: 'service_title' },
                { data: 'service_date' },
                { data: 'service_categories' },
                { data: 'service_price' },
                { data: 'service_duration' },
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
                    targets: 1,
                    width: '100px',
                    render: function(data, type, row) {
                        return row.order_id;
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        var $elArray = [];
                        $.each(row.service_categories, function(index, category) {
                            $elArray.push(`<span class="badge badge-info">${category.name}</span>`);
                        });

                        return $elArray.join();
                    }
                },
                {
                    targets: 5,
                    width: '100px',
                    render: function(data, type, row) {
                        return `<span>Php ${row.service_price}</span>`;
                    }
                },
                {
                    targets: 6,
                    width: '100px',
                    render: function(data, type, row) {
                        return `<span>${row.service_duration} Hrs</span>`;
                    }
                },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        let actions = [];
                        actions.push(`<a class="mr-1 btn-view" href="/jobseeker/orders/${full.id}/show" data-toggle="tooltip" data-placement="top" title="View">${feather.icons['eye'].toSvg({ class: 'font-medium-2' })}</a>`);
                        if (!full.has_jobseeker_feedback && full.status == 7) {
                            actions.push(`<a class="mr-1 btn-feedback text-success" href="javascript:void(0)" data-id="${full.service_id}" data-order-id="${full.order_id}" data-toggle="tooltip" data-placement="top" title="Add Feedback">${feather.icons['message-circle'].toSvg({ class: 'font-medium-2' })}</a>`);
                        }
                        return (
                            `<div class="d-flex align-items-center col-actions">
                            ${actions}
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

        $(document).on('click', '.btn-feedback', function() {
            $('.dtr-bs-modal').modal('hide');
            var order_id = $(this).data('orderId');
            var id = $(this).data('id');
            feedback_modal.find('.modal-title').text('SERVICE ORDER NO. ' + order_id);
            feedback_modal.find('input[name=service_id]').val(id);
            feedback_modal.modal('show');
        });

        feedback_modal.on('submit', 'form', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                beforeSend: function() {
                    $(this).find('button[type=submit]').prop('disabled', true);
                },
                success: function(resp) {
                    $(this).find('button[type=submit]').prop('disabled', false);
                    if (resp.success) {
                        feedback_modal.modal('hide');
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