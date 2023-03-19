<div id="modal_lacak_resi" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Detail Status Pengiriman - <span class="ket_title_lacak"></span></h5>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="detail_tracking" style="margin-bottom: 10px;"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function copy_text(){
        $('#no_resi').show();
        /* Get the text field */
        var copyText = document.getElementById("no_resi");

        /* Select the text field */
        copyText.select();
        // copyText.setSelectionRange(0, 99999); /*For mobile devices*/

        /* Copy the text inside the text field */
        document.execCommand("copy");
        $('#no_resi').hide();
    }
    
	function lacak_resi(no_resi,kode_kurir,nama_kurir){
        $.ajax({
            url : "<?php echo base_url('ajax/ajax_data')?>",
            type: "POST",
            data : {
                no_resi : no_resi,
                kode_kurir : kode_kurir,
                nama_kurir : nama_kurir,
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                type : 'lacak_resi',
            },
            dataType: "JSON",
            success: function(data){
                if (data.status) {
                    $('.detail_tracking').html(DOMPurify.sanitize( data.data, { SAFE_FOR_JQUERY: true } ));
                    $('.ket_title_lacak').text(nama_kurir+' : '+no_resi);
                    $('#modal_lacak_resi').modal('show');
                }else{
                    Swal.fire({type: 'error',title: 'Gagal Mendapatkan Data',text: data.message});
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }
</script>