<script src="{{ secure_asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ secure_asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ secure_asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ secure_asset('vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ secure_asset('js/pages/dataTables.bootstrap.js') }}"></script>
<script type="text/javascript">
$(function () {
    let dataTableIndex = $('#dataTableIndex');
    let table = dataTableIndex.DataTable({
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n        <'table-responsive'tr>\n        <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-center justify-content-lg-end'p>>",
        language: {
            paginate: {
                previous: '<i class="fa fa-lg fa-angle-left"></i>',
                next: '<i class="fa fa-lg fa-angle-right"></i>'
            }
        },
        columns: window.dataTableSet,
        autoWidth: true,
        deferRender: true,
        order: [],
				columnDefs: [
					{ targets: 0,
						width: '50px'
					},
					{
						targets: '_all',
						width: '150px',
          }
        ],
        ajax: dataTableIndex.data('ajaxurl'),
        "initComplete": function (settings, json) {
            window.setReadmore();
        }
    });

    let selectedStatus;
    let filter;

    $('.js-status-option').change(function () {
        selectedStatus = this.value;
        if (selectedStatus != 'status-all') {
            filter = function (settings, searchData, index, rowData) {
                let tr = table.row(index).nodes().to$();
                return tr.find('select.' + selectedStatus).length;
            }
            $.fn.dataTable.ext.search.push(filter);
            table.draw();
            $.fn.dataTable.ext.search.pop(filter);
        } else {
            $.fn.dataTable.ext.search.pop(filter);
            dataTableIndex.DataTable().search("").draw();
        }
		});

		$('.js-status-option-text').change(function () {
			table.columns(dataTableIndex.data('status')).search(this.value).draw();
    });
});
</script>
