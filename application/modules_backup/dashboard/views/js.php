<script type="text/javascript">

	var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout(timer);
        timer = setTimeout(callback,ms);
      };
    })();  

	var table;

	dataTable = $('#tabel').DataTable( {
		paginationType:'full_numbers',
		processing: true,
		serverSide: true,
		filter: false,
		autoWidth:false,
		aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		ajax: {
			url: '<?php echo base_url('reservasi/proses/ajax_list')?>',
			type: 'POST',
			data: function (data) {
				data.filter = {
					'nama'		: $('.filter_nama').val(),	
					'kelamin'	: $('.filter_kelamin').val(),	
					'domisili'	: $('.filter_domisili').val(),
				};
				data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
				data.type = 'data_pengguna';
			}
		},
		language: {
			sProcessing: 'Sedang memproses...',
			sLengthMenu: 'Tampilkan _MENU_ entri',
			sZeroRecords: 'Tidak ditemukan data yang sesuai',
			sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
			sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
			sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
			sInfoPostFix: '',
			sSearch: 'Cari:',
			sUrl: '',
			oPaginate: {
				sFirst: '<<',
				sPrevious: '<',
				sNext: '>',
				sLast: '>>'
			}
		},
		order: [1, 'desc'],
		columns: [
			{'data':'no'},
			{'data':'nama'},
			{'data':'domisili'},
			{'data':'jenis_kelamin'},
			{'data':'email'},
			{'data':'last_login'},
			{'data':'aktif'},
			{'data':'aksi','orderable':false},
		],
		"scrollX": true,
		"scrollCollapse": true,
		"fixedColumns": {
			"leftColumns": 0,
			"rightColumns": 1
		},
	});

	function table_data(){
		dataTable.ajax.reload(null,true);
	}

	$(".filter_nama").keyup(function(){
		delay(function(){
        	table_data();
      	}, 800);
	});

    $(".load_table").click(function(){
        table_data();
    });
</script>