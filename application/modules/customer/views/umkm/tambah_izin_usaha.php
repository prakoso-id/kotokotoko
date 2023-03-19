<?php
if($data != ''):
    foreach ($data as $key => $value) {
?>
        <div class="row izin_usaha_<?php echo $no; ?>">
            <hr>
            <div class="col-md-6">
                <div class="position-relative row form-group">
                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Izin Usaha</label>
                    <div class="col-lg-12">
                        <select class="form-control nama_izin_usaha<?php echo $no; ?> select2" data-step="step-1" name="nama_izin_usaha[]" id="nama_izin_usaha_<?= $no ?>" style="width: 100%;">
                            <option value="0">Pilih Salah Satu</option>
                            <?php 
                            $nama_izin_usaha = get_nama_izin_usaha();
                            foreach ($nama_izin_usaha as $row) {
                                echo '<option value="'.$row.'" '.($value['nama_izin_usaha'] == $row ? 'selected':'').'>'.$row.'</option>';
                            }
                            ?>
                        </select>
                        <input type="hidden" name="nm_izin_usaha[]" class="form-control" data-step="step-1">
                        <span class="help"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative row form-group">
                    <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor</label>
                    <div class="col-lg-12">
                        <input maxlength="30" type="text" name="no_surat[]" id="no_surat_<?= $no ?>" class="form-control" data-step="step-1" placeholder="Contoh : 01.004/UMKM-SM/V/2020" value="<?php echo $value['nomor_izin_usaha']; ?>">
                        <span class="help"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="position-relative row form-group check_lainnya<?php echo $no; ?>" style="<?php echo ($value['nama_izin_usaha'] != 'LAINNYA'?'display: none;':'') ?>">
                    <label class="col-sm-12 col-form-label" style="font-weight:600">Lainnya</label>
                    <div class="col-lg-12">
                        <input type="text" name="nama_izin_usaha_lain[]" id="nama_izin_usaha_lain_<?= $no ?>" class="form-control" data-step="step-1" placeholder="Contoh : IUMK" value="<?php echo $value['nama_izin_lainnya']; ?>">
                        <span class="help"></span>
                    </div>
                </div>
            </div>
            
            <script type="text/javascript">
                $('.select2').select2();
                $(".nama_izin_usaha<?php echo $no; ?>").change(function(){
                    if($(this).val() == 'LAINNYA')
                    {
                        $('.check_lainnya<?php echo $no; ?>').removeAttr('style');
                    }else{
                        $('.check_lainnya<?php echo $no; ?>').attr('style','display:none');
                    }
                });

            </script>    
        </div>

<?php
    $no++;
    }
?>
    <script type="text/javascript">
        var count = <?php echo $no; ?>;
        $('.hapus_izin_usaha').click(function (e) {
            if(count != 0)
            {
                $('.izin_usaha_'+count).remove();
                count = count - 1;    
            }

        });
    </script>
<?php
else:
?>
<div class="row izin_usaha_<?php echo $no; ?>">
    <hr>
    <div class="col-md-6">
        <div class="position-relative row form-group">
            <label class="col-sm-12 col-form-label" style="font-weight:600">Nama Izin Usaha</label>
            <div class="col-lg-12">
                <select class="form-control nama_izin_usaha<?php echo $no; ?> select2" data-step="step-1" name="nama_izin_usaha[]" id="nama_izin_usaha_<?= $no ?>" style="width: 100%;">
                    <option value="0">Pilih Salah Satu</option>
                    <?php 
                    $nama_izin_usaha = get_nama_izin_usaha();
                    foreach ($nama_izin_usaha as $row) {
                        echo '<option value="'.$row.'">'.$row.'</option>';
                    }
                    ?>
                </select>
                <input type="hidden" name="nm_izin_usaha[]" class="form-control" data-step="step-1">
                <span class="help"></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="position-relative row form-group">
            <label class="col-sm-12 col-form-label" style="font-weight:600">Nomor</label>
            <div class="col-lg-12">
                <input maxlength="30" type="text" name="no_surat[]" id="no_surat_<?= $no ?>" class="form-control" data-step="step-1" placeholder="Contoh : 01.004/UMKM-SM/V/2020">
                <span class="help"></span>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="position-relative row form-group check_lainnya<?php echo $no; ?>" style="display: none;">
            <label class="col-sm-12 col-form-label" style="font-weight:600">Lainnya</label>
            <div class="col-lg-12">
                <input type="text" name="nama_izin_usaha_lain[]" id="nama_izin_usaha_lain_<?= $no ?>" class="form-control" data-step="step-1" placeholder="Contoh : IUMK">
                <span class="help"></span>
            </div>
        </div>
    </div>
    
    
    <script type="text/javascript">
        $('.select2').select2();
        $(".nama_izin_usaha<?php echo $no; ?>").change(function(){
            if($(this).val() == 'LAINNYA')
            {
                $('.check_lainnya<?php echo $no; ?>').removeAttr('style');
            }else{
                $('.check_lainnya<?php echo $no; ?>').attr('style','display:none');
            }
        });
    </script>    
</div>
<?php
endif;
?>

