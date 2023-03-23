<style type="text/css">
	button[disabled]{
	color: #eee;
    background-color: #ffffff;
    border:1px solid #eee;
	}

	.btn_del_all {
		color: #bfbfbf;
		font-size:20px;
		float:right;
		cursor: pointer;
	}

	.div-img-produk {
		width: 70px; 
		display: inline-block;
		margin: 0px 10px 0px 10px;
	}

	.image-produk {
		width: 70px;
		height: 70px;
		object-fit: cover;
		display: block;
		margin-left: auto;
		margin-right: auto;
		border: 1px solid #f0f0f0;
		border-radius: 5px;
	}

	.info-produk {
		display: inline-block;
		position: absolute;
		margin-left: 10px;
	}

	.btn_del, .btn_love {
		color: #bfbfbf;
		font-size:20px;
		cursor: pointer;
		cursor: pointer;
		margin: 0px 10px 0px 10px;
	}

	.input_quantity {
		width: 170px;
		text-align: center;
	}
	.data_keranjang{
		display: block;
		margin-top: 20px;
	}
</style>
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Keranjang Saya</h4>
                    <div class="breadcrumb__links">
						<a href="<?php echo base_url(); ?>">Beranda</a>
                        <span>Keranjang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container container-240">
    <div class="row shop-colect">
    	<div class="col-md-12 col-sm-12 col-xs-12 collection-list">
            <div class="e-product">
                <div class="row data_keranjang ">
                	
				</div>
			</div>
        </div>
    </div>

    <?php $this->load->view('terakhir_dilihat'); ?>
</div>
<?php $this->load->view('js');?>