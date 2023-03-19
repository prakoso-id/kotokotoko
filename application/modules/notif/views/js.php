<script type="text/javascript">
    var table;
    var table_update;
    $(document).ready(function(){
        $('.select2').select2();

        table = $('#tabel-notif-transaksi').DataTable( {
            paginationType:'full_numbers',
            processing: true,
            serverSide: true,
            filter: false,
            autoWidth:false,
            scrollX: true,
            width:'100%',
            aLengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '<?php echo base_url('notif/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    data.filter = {
                        'is_read'   : $('#filter_is_read').val(),    
                        'jenis_transaksi' : $('#filter_jenis_transaksi').val(), 
                    };
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'transaksi';
                    data.view = '<?php echo $this->uri->segment(2); ?>';
                },
            },
            language: {
                sProcessing: 'Sedang memproses...',
                sLengthMenu: 'Tampilkan _MENU_ entri',
                sZeroRecords: 'Tidak ada notifikasi',
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
            order: [0, 'desc'],
            "createdRow": function( row, data, dataIndex ) {
              if ( data['is_read'] == "1" ) {        
                // $(row).addClass('info bg-info');
                $(row).css({
                    'background-color': '#f2f2f2'
                });
              }
            }, 
            columns: [
                {'data':'dt','orderable':false,className: "text-left"},
            ],
        });

        table_update = $('#tabel-notif-update').DataTable( {
            paginationType:'full_numbers',
            processing: true,
            serverSide: true,
            filter: false,
            autoWidth:false,
            scrollX: true,
            width:'100%',
            aLengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '<?php echo base_url('notif/ajax_list')?>',
                type: 'POST',
                data: function (data) {
                    data.filter = {
                        'is_read'   : $('#filter_is_read_update').val(),
                    };
                    data.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    data.type = 'update';
                },
            },
            language: {
                sProcessing: 'Sedang memproses...',
                sLengthMenu: 'Tampilkan _MENU_ entri',
                sZeroRecords: 'Tidak ada notifikasi',
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
            order: [0, 'desc'],
            "createdRow": function( row, data, dataIndex ) {
              if ( data['is_read'] == "1" ) {        
                $(row).css({
                    'background-color': '#f2f2f2'
                });
              }
            }, 
            columns: [
                {'data':'dt','orderable':false,className: "text-left"},
            ],
        });
    });

    function table_data(){
        table.ajax.reload(null,true);
    }

    function table_data2(){
        table_update.ajax.reload(null,true);
    }
</script>