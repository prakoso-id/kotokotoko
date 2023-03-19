<script type="text/javascript">
	$(document).ready(function() {
          
    });

    $('#btn_cari_produk').click(function() {
      	var cari = $('#cari_produk').val();
      	var cari_old = $('#cari_produk_old').val();
      	set_url('cari',cari,cari_old);
    });

    $('#cari_produk').keyup(function(e){
        if(e.keyCode == 13){
            var cari = $('#cari_produk').val();
            var cari_old = $('#cari_produk_old').val();
            set_url('cari',cari,cari_old);
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