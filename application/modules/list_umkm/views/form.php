<style type="text/css">
	.icon-foto{
		font-size: 64px;
		font-weight: 700;
		color: #fff;
	}
	.latest-text {
		text-align: center;
	}
</style>
<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
			<li><a href="<?php echo base_url('list-umkm'); ?>">UMKM</a></li>
			<li>Registration Customer</li>
			<li class="active"><?php echo text($umkm->namausaha); ?></li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- aside widget -->
				<div class="aside">
					<h3 class="aside-title">Pencarian Toko:</h3>
					<div class="row">
						<form action="<?php echo base_url('list-umkm') ?>" method="get">
							<div class="col-sm-12">
								<div class="input-group" style="display: flex;">
									<input type="text" name="cari" class="form-control" placeholder="Search..." value="<?php echo $this->input->get('cari') ?>">
									<div class="input-group-append">
										<button type="submit" class="btn primary-btn" style="border-radius: 0px; padding: 7px 15px;">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="aside">
					<h3 class="aside-title">Detail UMKM</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="position-relative row form-group">
								<label class="col-sm-3 col-form-label" style="font-weight:600">Nama Usaha</label>
								<div class="col-lg-9" style="text-align: right;">
									<?php echo text($umkm->namausaha); ?>
								</div>
							</div>
							<div class="position-relative row form-group">
								<label class="col-sm-3 col-form-label" style="font-weight:600">Kategori</label>
								<div class="col-lg-9" style="text-align: right;">
									<?php
									echo $umkm->nama_usaha;
									?>
								</div>
							</div>
							<div class="position-relative row form-group">
								<label class="col-sm-3 col-form-label" style="font-weight:600">Kelurahan</label>
								<div class="col-lg-9" style="text-align: right;">
									<?php
									echo text($umkm->nama_kel);
									?>
								</div>
							</div>
							<div class="position-relative row form-group">
								<label class="col-sm-3 col-form-label" style="font-weight:600">Kecamatan</label>
								<div class="col-lg-9" style="text-align: right;">
									<?php
									echo text($umkm->nama_kec);
									?>
								</div>
							</div>
							<div class="position-relative row form-group">
								<label class="col-sm-3 col-form-label" style="font-weight:600">Alamat</label>
								<div class="col-lg-9" style="text-align: right;">
									<?php
									echo text($umkm->alamat);
									?>
								</div>
							</div>
							<div class="position-relative row form-group">
								<label class="col-sm-3 col-form-label" style="font-weight:600">Ratting</label>
								<div class="col-lg-9" style="text-align: right;">
									<div class="product-rating">
										<?php
										$ratting = get_ratting_umkm($umkm->id_umkm);
										$jumlah = 5 - $ratting; 
										for($i=0; $i<$ratting; $i++)
										{
											echo '<i class="fa fa-star"></i>';
										}

										for($i=0; $i<$jumlah; $i++)
										{
											echo '<i class="fa fa-star-o"></i>';
										}
										?>
									</div>
									<p>(<?php echo get_jumlah_ulasan($umkm->id_umkm); ?> Ulasan & <?php echo get_jumlah_diskusi($umkm->id_umkm); ?> Diskusi)</p>
								</div>
							</div>
						</div>


					</div>
				</div>

				<!-- /aside widget -->
			</div>
			<!-- /ASIDE -->

			<!-- MAIN -->
			<div id="main" class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<form method="POST" id="form-aman" name="form-ibd">
							<span class="text-danger">* Required</span>
							<div class="form-group">
								<input type="hidden" name="kode" value="<?php echo $umkm->kode_verifikasi; ?>">
								<label for="b">Nama / Name <span class="text-danger">*</span></label>
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
								<input type="text" name="nama" class="form-control" id="b" required="required" placeholder="Masukan nama">
							</div>
							<div class="form-group">
								<label for="c">Nomor Kontak / Mobile Number <span class="text-danger">*</span></label>
								<input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==15) return false;" name="nomor_kontak" class="form-control" id="c" required="required" placeholder="Masukan nomor telepon">
							</div>
							<div class="form-group">
								<label for="e">Alamat Email / Email Address</label>
								<input type="email" name="alamat_email" class="form-control" id="alamat_email" placeholder="Masukan alamat email">
							</div>
							<div class="form-row">
								<div class="form-group col-6">
									<label for="yesKK">Apakah Anda Bersama Keluarga atau Rombongan / Are you with your family or group?</label>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="radio" name="iskk" id="yesKK" value="y">
										<label class="custom-control-label" for="yesKK">
											Ya&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input class="custom-control-input" type="radio" name="iskk" id="notKK" value="n" checked>
										<label class="custom-control-label" for="notKK">
											Tidak&nbsp;&nbsp;&nbsp;
										</label>
									</div>
									<input id="inputKK" name="kk" type="hidden" value="n">
								</div>
								<div id="showtanggungan" class="form-group col-6 d-none">
									<label for="inputJumlahTanggungan">Jumlah Orang</label>
									<input class="form-control" id="inputJumlahTanggungan" name="jumlahtanggungan" type="number" min="1" value="1">
								</div>
							</div>

							<div id="showtanggunganform" class="form-row d-none">
								<div class="form-group col-6">
									<label for="inputTNama">Nama <span class="text-danger" title="Wajib diisi">*</span></label>
									<input type="text" class="form-control" id="inputTNama" name="tanggungan[]">
								</div>
							</div>
							<div class="form-group">
								<label for="x">&nbsp;</label>
								&nbsp;&nbsp;&nbsp;<input type="checkbox" class="form-check-input checkbox_check" id="x"> Saya menyetejui pernyataan bahwa / i agree with that statement :
								<ul>
									<li>Saya tidak pernah berkontak langsung dengan pasien pengidap COVID-19 dalam 14 hari kebelakang / I have not had close contact with confirmed COVID-19 case in the past 14 days.</li>
									<li>Saya tidak dalam anjuran Karantina Mandiri / I am not serving a Self Quarantine Notice.</li>
									<li>Saya tidak memiliki gejala sakit flu dan/atau demam / I do not have any flu-like symptoms and/or fever.</li>
									<li>Saya menyetujui persyaratan dan menyutujui pengumpulan dna penggunanaan informasi saya untuk tujuan pelacakan kontak COVID-19 / I agree to the terms and consent to the collection and use of my infromation for the purpose of COVID-19 contact tracing.</li>
								</ul>
							</div>
							<button type="buttton" id="btn" class="btn btn-primary">SIMPAN</button>
							<br /><br /><br /><br />
						</form>
					</div>
				</div>

				<!-- store bottom filter -->
				<div class="store-filter clearfix">
					
				</div>
				<!-- /store bottom filter -->
			</div>
			<!-- /MAIN -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
	<!-- /section -->
<script>

	$( document ).ready(function() {
		$('#btn').prop('disabled',true);

		$('input[type=radio][name=iskk]').change(function() {
			if (this.value == 'y') {
				$('#showtanggungan,#showtanggunganform').removeClass('d-none').show();
				$('input#inputTNama').attr('required', true);
			} else if (this.value == 'n') {
				$('#showtanggungan,#showtanggunganform').hide();
				$('input#inputTNama').attr('required', false);
			}
			$('input#inputKK').val(this.value);
		});
		$('input[type=radio][name=isrb]').change(function() {
			if (this.value == 'y') {
				$('#showrb,#showrbform').removeClass('d-none').show();
				$('input#inputNorek,input#inputAnrek,select#selectBank').attr('required', true);
			} else if (this.value == 'n') {
				$('#showrb,#showrbform').hide();
				$('input#inputNorek,input#inputAnrek,select#selectBank').attr('required', false);
			}
			$('input#inputKK').val(this.value);
		});
		$('#inputJumlahTanggungan').change(function() {
			var jmltanggung = $(this).val();
			if (jmltanggung > 0) {
				$('#showtanggunganform').empty();
				var i;
				for (i = 0; i < jmltanggung; i++) {
					$('#showtanggunganform').append(
						'<div class="form-group col-6">'+
						'<label for="inputTNama">Nama <span class="text-danger" title="Wajib diisi">*</span></label>'+
						'<input type="text" class="form-control" id="inputTNama" name="tanggungan[nama][]" required>'+
						'</div>'
						);
				}
			}
		});
	});

	$("[name=form-ibd]").on('submit', function(e){
		e.preventDefault();

		$('#btnSave').text('sedang menyimpan...');
        $('#btnSave').attr('disabled',true);
        $('.form-group').removeClass('has-error');
        $('.help').empty();
                
        var form = $('#form-aman')[0];
        var data = new FormData(form);
        var url = '<?php echo base_url("toko/ajax_save"); ?>';

        Swal.fire({
            text: "Apakah Data ini Ingin Di Simpan?",
            title: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2196F3",
            confirmButtonText: "Simpan",
            cancelButtonText: "Tidak",
            closeOnConfirm: false,
            closeOnCancel: true
        }).then((result) => {
  			if (result.value) {
                $('.confirm').text('sedang menyimpan...');
                $('.confirm').attr('disabled',true);

                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    processData:false,
                    contentType:false,
                    cache:false,
                    success: function (res) {
                        var obj = JSON.parse(res);
                        if(obj.status)
                        {
                            if (obj.success !== true) {
                                Swal.fire({
                                    text: obj.message,
                                    title: "",
                                    type: "error",
                                    button: true,
                                    timer: 1000
                                });
                            }
                            else {
                                Swal.fire({
                                    text: obj.message,
                                    title: "",
                                    type: "success",
                                    button: true,
                                }).then((result) => {
  									if (result.value) {
                                       window.location.href = "<?php echo base_url('toko/'.$this->uri->segment(2).'/'.$this->uri->segment(3)); ?>"; 
                                    }
                                });
                            }
                            $('#btnSave').text('Simpan');
                            $('#btnSave').attr('disabled',false);
                        }
                        else {
                            for (var i = 0; i < obj.inputerror.length; i++) 
                            {
                                $('[name="'+obj.inputerror[i]+'"]').parent().parent().addClass('has-error');
                                $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                            }
                            Swal.fire({
                                type: 'error',
                                text: 'Proses Simpan Gagal, Silahkan Melengkapi Data Yang Harus Diisi',
                                title : '',
                                button: true,
                                timer: 3000
                            });
                            $('#btnSave').text('Simpan');
                            $('#btnSave').attr('disabled',false);
                        }
                    }
                });
            }else{
                $('.confirm').text('Simpan');
                $('.confirm').attr('disabled',false);

                $('#btnSave').text('Simpan');
                $('#btnSave').attr('disabled',false);
            }

        });
    })

	$(".checkbox_check").change(function(){
		if ($(this).is(':checked')) {
			$('#btn').prop('disabled',false);
		}
		else {
			$('#btn').prop('disabled',true);
		}
	});

	function inpNum(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}

</script>