<div class="bestseller" style="margin-bottom: 0px; margin-top: 10px;">
    <div class="ecome-heading style5v3 spc5v3" style="margin-bottom: 0px;">
        <h1>Terakhir Dilihat</h1>
    </div>
    <div class="owl-carousel owl-theme owl-cate v2 js-owl-cate">
        <?php
        if ($dilihat) {
            foreach ($dilihat as $value) { 
                echo card_produk($value,'product-grid product-grid-v2');
            }
        }else{
            echo '';
        } ?>
    </div>
</div>