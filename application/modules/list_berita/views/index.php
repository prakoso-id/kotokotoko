<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Berita</h4>
                    <div class="breadcrumb__links">
                        <a href="<?= base_url()?>">Home</a>
                        <span>Berita</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="container container-240 mt-5">
    <div class="blog spc1">
        <div class="blog-grid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-9 col-sm-8 col-xs-12" style="float: left;margin-bottom: 20px;">
                        <span><?= 'Menampilkan '.$count_s.'-'.$count_e.' dari '.$count_all.' data'; ?></span>
                    </div>
                    <div class="input-group col-md-3 col-sm-4 col-xs-12" style="float: right;margin-bottom: 20px;">
                        <input type="hidden" class="form-control" id="cari_berita_old" value="<?php echo htmlentities($this->input->get('cari_berita',true), ENT_QUOTES, 'UTF-8') ?>">
                        <input type="text" class="form-control" id="cari_berita" placeholder="Cari berita" value="<?php echo htmlentities($this->input->get('cari_berita',true), ENT_QUOTES, 'UTF-8') ?>">
                        <div class="input-group-btn">
                          <button class="btn btn-blue" id="btn_cari_berita" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                          </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
                if ($berita) {
                    foreach ($berita as $value) { 
                        echo card_berita($value,'col-md-4 col-sm-6');
                    }
                }else{ ?>
                    <div class="shopping-cart v2 bd-7">
                        <div class="cmt-title text-center abs">
                            <h1 class="page-title v4">Oppss..</h1>
                            <div class="w-empty">
                                <p>Berita tidak ditemukan !</p>
                            </div>
                        </div>
                    </div>
                <?php } ?> 
            </div>
        </div>
        <?php echo $pagination; ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
          
    });

    $('#btn_cari_berita').click(function() {
        var cari = $('#cari_berita').val();
        var cari_old = $('#cari_berita_old').val();
        set_url('cari_berita',cari,cari_old);
    });

    $('#cari_berita').keyup(function(e){
        if(e.keyCode == 13){
            var cari = $('#cari_berita').val();
            var cari_old = $('#cari_berita_old').val();
            set_url('cari_berita',cari,cari_old);
        }
    });

    function set_url(param,new_value=null,old_value=null) {
        if(document.location.href.includes('?')) {
            var separator = '&';
        }else{
            var separator = '?';
        }

        if (document.location.href.includes(param)) {
            if (new_value) {
                var url = document.location.href.replace(param+"="+encodeURIComponent(old_value), param+"="+encodeURIComponent(new_value));
            }else{
                var url = document.location.href.replace(param+"="+encodeURIComponent(old_value), param+"=");
            }
        }else{
            if (new_value) {
                var url = document.location.href+""+separator+""+param+"="+encodeURIComponent(new_value);
            }else{
                var url = document.location.href;
            }
        }

        document.location = url;
    }
</script>