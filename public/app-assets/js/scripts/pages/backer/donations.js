$(function() {
    'use strict';

    var dtTable = $('.donations-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/backer/donations/data';

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
                // { data: 'id' },
                // { data: 'campaign_id' },
                // { data: 'title' },
                // { data: 'description' },
                // { data: 'thumbnail_url' },
                // { data: 'categories' },
                // { data: 'date' },
                // { data: 'amount' },
                // { data: '' }

                { data: 'id' },
                { data: 'title' },
                { data: 'categories' },
                { data: 'jobseeker_name' },
                { data: 'date' },
                { data: 'amount' },
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
                //     targets: 4,
                //     render: function(data, type, row) {
                //         return `<img src="${row.thumbnail_url}" class="mr-75 rounded" height="50" width="50">`
                //     }
                // },
                {
                    targets: 2,
                    render: function(data, type, row) {
                        let categories = [];
                        $.each(row.categories, function(i, category) {
                            categories.push(`<span class="badge badge-primary">${category.name}</span>`);
                        });

                        return categories.join('');
                    }
                },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, full, meta) {

                        if(full.status == 1){
                            return (
                                `<div class="d-flex align-items-center col-actions">
                                    <a class="mr-1 btn btn-sm btn-primary" href="/campaign/${full.id}">View Campaign</a>
                                </div>
                                `
                            );
                        }
                        else
                        {
                            return (
                                `<div class="d-flex align-items-center col-actions">
                                    <a class="mr-1 btn btn-sm btn-light">Campaign Unactive</a>
                                </div>
                                `
                            );
                        }

                        // return (
                        //     `<div class="d-flex align-items-center col-actions">
                        //         <a class="mr-1 btn btn-sm btn-primary" href="/campaign/${full.id}">View Campaign</a>
                        //     </div>
                        //     `
                        // );
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
                searchPlaceholder: 'Search for Campaigns',
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