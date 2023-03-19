<style type="text/css">
	.tab-pane{
		margin-top: 30px;
		padding: 0 20px;
	}
	.fade {
		opacity: 1;
	}
</style>
<div class="product-body">
	<div class="daftar_umkm">
		<h2 class="product-name">Data Toko</h2>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item active">
				<a class="nav-link active" id="pribadi-tab" data-toggle="tab" href="#pribadi" role="tab" aria-controls="pribadi" aria-selected="true">
					Data Pribadi
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
					Profile Toko
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="alamat-tab" data-toggle="tab" href="#alamat" role="tab" aria-controls="alamat" aria-selected="false">
					Alamat Perusahaan
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="berkas-tab" data-toggle="tab" href="#berkas" role="tab" aria-controls="berkas" aria-selected="false">
					Berkas
				</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="pribadi" role="tabpanel" aria-labelledby="pribadi-tab">
				<div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">NIK</label>
                    <label class="col-sm-9 col-form-label username"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Nama Lengkap</label>
                    <label class="col-sm-9 col-form-label nama"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Nomor Telepon</label>
                    <label class="col-sm-9 col-form-label no_telp"></label>
                </div>
			</div>
			<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				<div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Nama Perusahaan</label>
                    <label class="col-sm-9 col-form-label nama_perusahaan"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Nomor Surat IUMK</label>
                    <label class="col-sm-9 col-form-label no_surat"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Jenis Usaha</label>
                    <label class="col-sm-9 col-form-label id_jenis_usaha"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Sarana Usaha</label>
                    <label class="col-sm-9 col-form-label id_sarana_usaha"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Tanggal Mulai Usaha</label>
                    <label class="col-sm-9 col-form-label tgl_usaha"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Jumlah Modal Awal</label>
                    <label class="col-sm-9 col-form-label modal_awal"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Jumlah Pegawai</label>
                    <label class="col-sm-9 col-form-label jml_pegawai"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Jumlah Omset</label>
                    <label class="col-sm-9 col-form-label jml_omset"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Jumlah Asset</label>
                    <label class="col-sm-9 col-form-label jml_asset"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Skala Usaha</label>
                    <label class="col-sm-9 col-form-label id_skala_usaha"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Nomor NPWP</label>
                    <label class="col-sm-9 col-form-label nomor_npwp"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Alamat Situs Web</label>
                    <label class="col-sm-9 col-form-label alamat_web"></label>
                </div>
			</div>
			<div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
				<div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Kecamatan</label>
                    <label class="col-sm-9 col-form-label id_kec"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Kelurahan</label>
                    <label class="col-sm-9 col-form-label id_kel"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Kode Pos</label>
                    <label class="col-sm-9 col-form-label kode_pos"></label>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Alamat</label>
                    <label class="col-sm-9 col-form-label alamat"></label>
                </div>
			</div>
			<div class="tab-pane fade" id="berkas" role="tabpanel" aria-labelledby="berkas-tab">
				<div class="position-relative row form-group file_umkm">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload Surat IUMK</label>
                    <div class="col-lg-9">
                        <img src="" class="foto_umkm img-responsive">
                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload NPWP</label>
                    <div class="col-lg-9">
                        <img src="" class="file_npwp img-responsive">
                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload KTP</label>
                    <div class="col-lg-9">
                        <img src="" class="file_ktp img-responsive">
                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload KK</label>
                    <div class="col-lg-9">
                        <img src="" class="file_kk img-responsive">
                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label class="col-sm-3 col-form-label" style="font-weight:600">Upload Pas Foto</label>
                    <div class="col-lg-9">
                        <img src="" class="file_foto img-responsive">
                        <hr style="border-bottom:1px solid #000;margin-bottom: 30px ">
                    </div>
                </div>
			</div>
		</div>
		
	</div>
</div>
<script type="text/javascript">
	$.ajax({
        url : "<?php echo base_url('dashboard/ajax_data/')?>",
        type: "POST",
        data : {
            id : '<?php echo $this->session->identity ?>',
            status : true,
            type : 'detail_umkm',
            <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "JSON",
        success: function(data){
            $('.username').html(data.username);
            $('.nama').html(data.nama);
            $('.no_telp').html(data.no_telp);
            $('.nama_perusahaan').html(data.nama_perusahaan);
            $('.no_surat').html(data.no_surat);
            $('.id_jenis_usaha').html(data.nama_usaha);
            $('.id_sarana_usaha').html(data.nama_sarana);
            $('.tgl_usaha').html(data.tgl_usaha);
            $('.modal_awal').html('Rp. '+data.jml_modal_awal);
            $('.jml_pegawai').html(data.jml_pegawai+" Orang");
            $('.jml_omset').html('Rp. '+data.jml_omset);
            $('.jml_asset').html('Rp. '+data.jml_asset);
            $('.id_skala_usaha').html(data.nama_skala);
            $('.nomor_npwp').html(data.npwp);
            $('.alamat_web').html(data.situs_web);
            $('.id_kec').html(data.nama_kec);
            $('.id_kel').html(data.nama_kel);
            $('.kode_pos').html(data.kode_pos);
            $('.alamat').html(data.alamat);
            var url = '<?php echo base_url('assets/media/') ?>'+data.username;

            if(data.surat_iumkm != null){
                $('.foto_umkm').attr('src',url+'/umkm/'+data.surat_iumkm);
            }else{
                $('.foto_umkm').attr('src','');
            }

            if(data.foto_npwp != null){
                $('.file_npwp').attr('src',url+'/npwp/'+data.foto_npwp);    
            }else{
                $('.file_npwp').attr('src','');
            }

            if(data.foto_ktp != null){
                $('.file_ktp').attr('src',url+'/ktp/'+data.foto_ktp);    
            }else{
                $('.file_ktp').attr('src','');
            }

            if(data.foto_kk != null){
                $('.file_kk').attr('src',url+'/kk/'+data.foto_kk);
            }else{
                $('.file_kk').attr('src','');
            }

            if(data.foto_pas != null){
                $('.file_foto').attr('src',url+'/foto/'+data.foto_pas);
            }else{
                $('.file_foto').attr('src','');
            }

        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
</script>