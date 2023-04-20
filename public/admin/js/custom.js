// List Filter Code Start

function generateDatatable(options) {
    optionDefs = options.columnDefs ? options.columnDefs : [];
    list_dt_tbl = $('#' + options.table_id).DataTable({
        "searching": true,
        "deferRender": true,
        "processing": true,
        "serverSide": true,
        "order": [[0, "desc"]],
        'pageLength': 20,
            'dom': 'Bflrtip',
            'buttons': [
                'copy', 'csv', 'excel', 'pdf'
            ],
            'pages': 5,
                'lengthMenu': [20, 50, 100, 200, 500, 1000],
                "scrollY": "1000px",
                "scrollX": true,
                "scrollCollapse": true,
        ajax: {
            url: options.url, // json datasource
            type: "get",
            data: function (data) {
                data.custom_filter = {};
                if ($('#list_filter_form').length) {
                    $('#list_filter_form input[type="text"]').each(function () {
                        if ($(this).val() != '') {
                            data.custom_filter[$(this).attr('name')] = $(this).val();
                        }
                    });
                    $('#list_filter_form input[type="date"]').each(function () {
                        if ($(this).val() != '') {
                            data.custom_filter[$(this).attr('name')] = $(this).val();
                        }
                    });
                    $('#list_filter_form input[type="hidden"]').each(function () {
                        if ($(this).val() != '') {
                            data.custom_filter[$(this).attr('name')] = $(this).val();
                        }
                    });
                    $('#list_filter_form select').each(function () {
                        if ($(this).find('option:selected').val() != '') {
                            data.custom_filter[$(this).attr('name')] = $(this).find('option:selected').val();
                        }
                    });
                }
            },
            error: function () {  // error handling
                $("#" + options.table_id + "-body").html('<tr class="empty_row"><td colspan="' + options.number_of_columns + '" class="text-center"><span class="text-danger"><b>No Record Found</b></span></td></tr>');
                $('#' + options.table_id + '_processing').remove();
            }
        },
        columnDefs: optionDefs
    }).on('draw.dt', function () {
        if (typeof dtRowCreatedCallback != 'undefined') {
            dtRowCreatedCallback();
        }
    });
    return list_dt_tbl;
}

function filterList(element) {
    if (typeof list_dt_tbl != 'undefined') {
        if (!$('table.dataTable').length) {
            $(element).closest('form').submit();
        } else if ($('table.dataTable').length) {
            list_dt_tbl.draw();
        }
    } else {
        $(element).closest('form').submit();
    }
}

function resetFilters(element) {
    $(element).closest('form').find('input[type="text"]').val('');
    $(element).closest('form').find('select').each(function () {
        $(this).find('option').removeAttr('selected');
    });

    $(element).closest('form').find('.searchbtn').trigger('click');
}


$('#show-filter').click(function () {
    if ($('#list_filter').hasClass('hide')) {
        $(".show-filter").removeClass("fa-chevron-down").addClass("fa-chevron-up");
        $('#list_filter').removeClass('hide');
    } else {
        $(".show-filter").removeClass("fa-chevron-up").addClass("fa-chevron-down");
        $('#list_filter').addClass('hide');
    }

});


// List Filter Code End