<?php

/*
 * create by: eko setyawan | eGov Kota Tangerang 2019
 *
 */

defined('BASEPATH') or exit('No direct script access allowed');

class M_arsip_testing extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->dbkampungsiaga = $this->load->database('kampungsiaga',true);
        $this->dbumkm = $this->load->database('db_live_umkm',true);
        $this->dbtlive = $this->load->database('db_testing_tlive',true);
        
    }

    // start integrasi umkm
    function cekakunTlive($nik) {
        $sql = "select * from tlive_user where nik='".$nik."'";

        $query = $this->dbtlive->query($sql);
        return  $query->result(); 
    }

    function cektokenTlive($token) {
        $sql = "select * from access_token where token='".$token."'";

        $query = $this->dbtlive->query($sql);
        return  $query->result(); 
    }

    function updatedataumkm_pengguna($id_umkm, $id_pengguna) {
        
        $sql =" update m_umkm set 
        id_pengguna = '$id_pengguna'
        where id_umkm='$id_umkm'";
        
        $query = $this->dbumkm->query($sql);
        return $this->dbumkm->insert_id();
    }

    public function insert_umkm_pengguna($data)
    {
        $this->dbumkm->insert('m_pengguna', $data);
        return $this->dbumkm->insert_id();
    }

    function getUmkmSidata() {
        $sql = "select * from m_umkm where sumber='sidata' and akun_tlive is null or akun_tlive = 'belum'";
        // $sql = "select * from m_umkm where id_umkm=18";

        $query = $this->dbumkm->query($sql);
        return  $query->result(); 
    }

    function getUmkmAlamt($id_umkm) {
        $sql = "select * from m_umkm_alamat where id_umkm = '$id_umkm'";

        $query = $this->dbumkm->query($sql);
        return  $query->result(); 
    }

    function updatedataumkm_sidata($id_umkm) {
        
        $sql =" update m_umkm set 
        akun_tlive = 'sudah'
        where id_umkm='$id_umkm'";
        
        $query = $this->dbumkm->query($sql);
        return $this->dbumkm->insert_id();
    }

    public function insert_user_tlive($data)
    {
        $this->dbtlive->insert('tlive_user', $data);
        return $this->dbtlive->insert_id();
    }

    public function insert_user_verification($data)
    {
        $this->dbtlive->insert('user_verification', $data);
        return $this->dbtlive->insert_id();
    }

    function getLastidumkm() {
        $sql = "select max(id_data) from m_umkm";

        $query = $this->dbumkm->query($sql);
        return  $query->result(); 
    }

     public function deleteUMKM($id_data){
        $this->dbumkm->where('id_data', $id_data);
        $this->dbumkm->delete('m_umkm');
    }

    public function deleteUMKMAlamat($id_umkm){
        $this->dbumkm->where('id_umkm', $id_umkm);
        $this->dbumkm->delete('m_umkm_alamat');
    }

    public function deleteUMKMIzinUsaha($id_umkm){
        $this->dbumkm->where('id_umkm', $id_umkm);
        $this->dbumkm->delete('m_umkm_izin_usaha');
    }

    function checkUmkmalamat($id_umkm) {
        $sql = "select * from m_umkm_alamat where id_umkm = ".$id_umkm;

        $query = $this->dbumkm->query($sql);
        return  $query->result(); 
    }

    function checkUmkmIzinUsaha($id_umkm) {
        $sql = "select * from m_umkm_izin_usaha where id_umkm = ".$id_umkm;

        $query = $this->dbumkm->query($sql);
        return  $query->result(); 
    }

    function getIddataumkm($id_umkm) {
        $sql = "select * from m_umkm where id_umkm = ".$id_umkm;

        $query = $this->dbumkm->query($sql);
        return  $query->result(); 
    }

    function insertumkm_izinusaha($namaizinusaha, $nosuratizinusaha, $id_last_umkm) {
        $sql = "INSERT INTO m_umkm_izin_usaha(id_umkm, nama_izin_usaha, nomor_izin_usaha)
        VALUES ('$id_last_umkm', '$nama_izin_usaha', '$nomor_izin_usaha')";

        // var_dump($sql)
        // exit();
        $query = $this->dbumkm->query($sql);
        return $this->dbumkm->insert_id();
    }

    function updatedataumkm_izinusaha($namaizinusaha, $nosuratizinusaha, $id_umkm) {
        
        $sql =" update m_umkm_izin_usaha set 
        nama_izin_usaha = '$namaizinusaha', nomor_izin_usaha = '$nosuratizinusaha'
        where id_umkm='$id_umkm'";
        
        $query = $this->dbumkm->query($sql);
        return $this->dbumkm->insert_id();
    }

    function insertumkm_alamat($alamatworkshop,$kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop, $id_last_umkm) {

        $sql = "INSERT INTO m_umkm_alamat(id_umkm, nama_kec, nama_kel, alamat, kode_pos, no_prop, no_kab, tmpt_tinggal)
        VALUES ('$id_last_umkm', '$kecamatanworkshop', '$kelurahanworkshop', '$alamatworkshop', '$kodeposworkshop', '36', '71', '0')";

        // var_dump($sql)
        // exit();
        $query = $this->dbumkm->query($sql);
        return $this->dbumkm->insert_id();
    }

    function updatedataumkm_alamat($alamatworkshop,$kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop, $id_last_umkm) {
        
        $sql =" update m_umkm_alamat set 
        nama_kec = '$kecamatanworkshop', nama_kel = '$kelurahanworkshop', alamat = '$alamatworkshop', kode_pos = '$kodeposworkshop' 
        where id_umkm='$id_last_umkm'";
        
        $query = $this->dbumkm->query($sql);
        return $this->dbumkm->insert_id();
    }

    function insertumkm($alamatsosialmedia, $alamatworkshop,$longitud,$latitud,$fotoktp,$nama_usaha,$nama_pemilik,$nik,$alamat,$no_rt,$no_rw,$kelurahan,$kecamatan,$kota,$no_hp,$omset,$assets,$modal_sendiri,
                            $created_at,$created_by,$edited_at,$edited_by,$status,$status_verifikasi,$provinsitematik,$kotatematik,
                            $kecamataaantematik,$kelurahaantematik,$lokasikampungtematik,$tempatlahir,$domisiliktp,$tanggallahir,$jeniskelamin,
                            $namaibukandung,$namaizinusaha,$nosuratizinusaha,$npwp,$tanggalmulai,$provinsiworkshop,$kotaworkshop,
                            $kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop,$rtworkshop,$rwworkshop,$kodepos,$telpon,$fax,$email,$website,$bentukusaha,$jenisusaha,$kegiatanutama,
                            $produkutama,$tahundata,$totalkariawanlakilaki,$totaltenagakerjalakilaki,$omzetawal,$asset,$modalluar,$totalmodalluar,
                            $jenistempatusaha,$saranausaha,$statussarana,$bahanbakar,$negaraexpor,$volumeexpor,$nominalexpor,$totaltenagakerjaperempuan,$totalkariawanperempuan, $json_kontak, $id_data) {

        // $sql = "INSERT INTO t_data_umkm(alamatsosialmedia, alamatworkshop,statusdidata, longitude, latitude, namafilektp, nama_usaha,nama_pemilik,nik,alamat,no_rt,no_rw,kelurahan,kecamatan,kota,no_hp,omset,assets,modal_sendiri,created_at,created_by,edited_at,edited_by,provinsitematik,
        // kotatematik,kecamataaantematik,kelurahaantematik,lokasikampungtematik,tempatlahir,domisiliktp,tanggallahir,jeniskelamin,namaibukandung,namaizinusaha,nosuratizinusaha,npwp,tanggalmulai,provinsiworkshop,kotaworkshop,kecamatanworkshop,
        // kelurahanworkshop,kodeposworkshop,rtworkshop,rwworkshop,kodepos,telpon,fax,email,website,bentukusaha,jenisusaha,kegiatanutama,produkutama,tahundata,totalkariawanlakilaki,
        // totaltenagakerjalakilaki,omzetawal,asset,modalluar,totalmodalluar,jenistempatusaha,saranausaha,statussarana,bahanbakar,negaraexpor,volumeexpor,nominalexpor,totaltenagakerjaperempuan,totalkariawanperempuan,json_kontak)
        // VALUES ('$alamatsosialmedia','$alamatworkshop','0','$longitud','$latitud','$fotoktp','$nama_usaha','$nama_pemilik','$nik','$alamat','$no_rt','$no_rw','$kelurahan','$kecamatan','$kota','$no_hp','$omset','$assets','$modal_sendiri','$created_at','$created_by','$edited_at','$edited_by','$provinsitematik',
        // '$kotatematik','$kecamataaantematik','$kelurahaantematik','$lokasikampungtematik','$tempatlahir','$domisiliktp','$tanggallahir','$jeniskelamin','$namaibukandung',
        // '$namaizinusaha','$nosuratizinusaha','$npwp','$tanggalmulai','$provinsiworkshop','$kotaworkshop','$kecamatanworkshop','$kelurahanworkshop','$kodeposworkshop','$rtworkshop','$rwworkshop','$kodepos','$telpon','$fax',
        // '$email','$website','$bentukusaha','$jenisusaha','$kegiatanutama','$produkutama','$tahundata','$totalkariawanlakilaki','$totaltenagakerjalakilaki','$omzetawal','$asset','$modalluar','$totalmodalluar','$jenistempatusaha','$saranausaha','$statussarana',
        // '$bahanbakar','$negaraexpor','$volumeexpor','$nominalexpor','$totaltenagakerjaperempuan','$totalkariawanperempuan','$json_kontak')";

        // izin usaha
        if ($namaizinusaha == 'IUMK') 
            $namaizinusaha = 1;
        else
            $namaizinusaha = 0;

        // bentuk usaha
        if ($bentukusaha == 'PT.')
            $bentukusaha = 2;
        else if ($bentukusaha == 'CV.')
            $bentukusaha = 3;
        else if ($bentukusaha == 'Firma')
            $bentukusaha = 4;
        else if ($bentukusaha == 'Perorangan')
            $bentukusaha = 8;
        else if ($bentukusaha == 'Koperasi')
            $bentukusaha = 5;
        else if ($bentukusaha == 'Yayasan')
            $bentukusaha = 6;
        else
            $bentukusaha = 7;

        // jenis usaha
        if ($jenisusaha == 'Kuliner')
            $jenisusaha = 1;
        else if ($jenisusaha == 'Fashion')
            $jenisusaha = 2;
        else if ($jenisusaha == 'Aksesoris')
            $jenisusaha = 3;
        else if ($jenisusaha == 'Kerajinan Alas Kaki')
            $jenisusaha = 4;
        else if ($jenisusaha == 'Gadget dan Elektronik')
            $jenisusaha = 5;
        else if ($jenisusaha == 'Handricaft')
            $jenisusaha = 6;
        else if ($jenisusaha == 'Otomotif')
            $jenisusaha = 7;
        else if ($jenisusaha == 'Pendidikan')
            $jenisusaha = 8;
        else if ($jenisusaha == 'Jasa')
            $jenisusaha = 9;
        else if ($jenisusaha == 'Internet')
            $jenisusaha = 10;
        else if ($jenisusaha == 'Otomotif')
            $jenisusaha = 11;
        else if ($jenisusaha == 'Agrobisnis')
            $jenisusaha = 12;
        else
            $jenisusaha = 13;

        $sql = "INSERT INTO m_umkm(username, sumber, namausaha, nama_perusahaan, kegiatan_usaha_utama, nominal_modal_luar, jml_asset, npwp, id_status, memiliki_surat_iumkm, tahun_data, id_data, no_hp, fax, email, situs_web, pegawai_perempuan, pegawai_laki, id_bentuk_usaha, id_jenis_usaha, sosmed)
        VALUES ('$nik', 'sidata', '$nama_usaha', '$nama_pemilik', '$kegiatanutama', '$totalmodalluar', '$asset', '$npwp', 2, '$namaizinusaha', 2020, $id_data, '$no_hp', '$fax', '$email', '$website', '$totalkariawanperempuan', '$totalkariawanlakilaki', '$bentukusaha', '$jenisusaha', '$alamatsosialmedia')";


        // var_dump($sql)
        // exit();
        $query = $this->dbumkm->query($sql);
        return $this->dbumkm->insert_id();
    }

    function updatedataumkm($alamatsosialmedia, $alamatworkshop, $id_umkm, $statusdidata, $longitud,$latitud,$fotoktp,$nama_usaha,$nama_pemilik,$nik,$alamat,$no_rt,$no_rw,$kelurahan,$kecamatan,$kota,$no_hp,$omset,$assets,$modal_sendiri,
                            $created_at,$created_by,$edited_at,$edited_by,$status,$status_verifikasi,$provinsitematik,$kotatematik,
                            $kecamataaantematik,$kelurahaantematik,$lokasikampungtematik,$tempatlahir,$domisiliktp,$tanggallahir,$jeniskelamin,
                            $namaibukandung,$namaizinusaha,$nosuratizinusaha,$npwp,$tanggalmulai,$provinsiworkshop,$kotaworkshop,
                            $kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop,$rtworkshop,$rwworkshop,$kodepos,$telpon,$fax,$email,$website,$bentukusaha,$jenisusaha,$kegiatanutama,
                            $produkutama,$tahundata,$totalkariawanlakilaki,$totaltenagakerjalakilaki,$omzetawal,$asset,$modalluar,$totalmodalluar,
                            $jenistempatusaha,$saranausaha,$statussarana,$bahanbakar,$negaraexpor,$volumeexpor,$nominalexpor,$totaltenagakerjaperempuan,$totalkariawanperempuan,$profesi_pemilik, $tempat_pemasaran,$pemasaran_online, $json_kontak, $id_data) {

        // izin usaha
        if ($namaizinusaha == 'IUMK') 
            $namaizinusaha = 1;
        else
            $namaizinusaha = 0;

        // bentuk usaha
        if ($bentukusaha == 'PT.')
            $bentukusaha = 2;
        else if ($bentukusaha == 'CV.')
            $bentukusaha = 3;
        else if ($bentukusaha == 'Firma')
            $bentukusaha = 4;
        else if ($bentukusaha == 'Perorangan')
            $bentukusaha = 8;
        else if ($bentukusaha == 'Koperasi')
            $bentukusaha = 5;
        else if ($bentukusaha == 'Yayasan')
            $bentukusaha = 6;
        else
            $bentukusaha = 7;

        // jenis usaha
        if ($jenisusaha == 'Kuliner')
            $jenisusaha = 1;
        else if ($jenisusaha == 'Fashion')
            $jenisusaha = 2;
        else if ($jenisusaha == 'Aksesoris')
            $jenisusaha = 3;
        else if ($jenisusaha == 'Kerajinan Alas Kaki')
            $jenisusaha = 4;
        else if ($jenisusaha == 'Gadget dan Elektronik')
            $jenisusaha = 5;
        else if ($jenisusaha == 'Handricaft')
            $jenisusaha = 6;
        else if ($jenisusaha == 'Otomotif')
            $jenisusaha = 7;
        else if ($jenisusaha == 'Pendidikan')
            $jenisusaha = 8;
        else if ($jenisusaha == 'Jasa')
            $jenisusaha = 9;
        else if ($jenisusaha == 'Internet')
            $jenisusaha = 10;
        else if ($jenisusaha == 'Otomotif')
            $jenisusaha = 11;
        else if ($jenisusaha == 'Agrobisnis')
            $jenisusaha = 12;
        else
            $jenisusaha = 13;

        $sql =" update m_umkm set 
        username = '$nik', namausaha = '$namausaha', nama_perusahaan = '$nama_pemilik', kegiatan_usaha_utama = '$kegiatanutama', nominal_modal_luar = '$totalmodalluar', jml_asset = '$asset', npwp = '$npwp', memiliki_surat_iumkm = '$namaizinusaha', no_hp = '$no_hp', fax = '$fax', email = '$email', situs_web = '$website', pegawai_perempuan = '$totalkariawanperempuan', pegawai_laki = '$totalkariawanlakilaki', id_bentuk_usaha = '$bentukusaha',
        id_jenis_usaha = '$jenisusaha', sosmed = '$alamatsosialmedia', id_status = 1
        where id_data=$id_data";
        
        $query = $this->dbumkm->query($sql);
        return $this->dbumkm->insert_id();
    }


    // end integrasi umkm
    
    //fungsisimpan
    function getDataCount() {
        $sql = " select count(a.id_umkm)totalseemua from t_data_umkm a";
        $query = $this->dbkampungsiaga->query($sql);
        return $query->row();
    }
    function getDataCountall($where, $page) {
    // function getDataCountall($where) {
        // $sql = " select *, '' as statusdatas from t_data_umkm g where 1=1 $where limit 100";
        $sql = " select *, '' as statusdatas from t_data_umkm g where 1=1 $where ".$page;
        $query = $this->dbkampungsiaga->query($sql);
        return  $query->result(); 
    }
    function getDatadataumkm($where) {
        $sql = " select *, statusdidata as Statusdatas,'1'as bisaedit, a.id_umkm as kode_umkm, CONCAT('https://pangkas.tangerangkota.go.id/assets/pendataan-covid/ktp/', namafilektp) as namafilektp,namafilektp as filektp,  CONCAT('https://pangkas.tangerangkota.go.id/assets/pendataan-covid/rumah/', foto_rumah) as foto_rumah
        from t_data_umkm a
        left join t_data_gambar_umkm b on a.id_umkm = b.id_umkm 
        where a.id_umkm='".$where."'";

        $query = $this->dbkampungsiaga->query($sql);
        return  $query->result(); 
    }
    
    function getdatasudahdata($where, $page) {
    // function getdatasudahdata($where) {
        // $sql = "select *,statusdidata as statusdatas from t_data_umkm g 
        // where  g.statusdidata in('1', '2') ".$where." order by g.id_umkm asc limit 100";
        $sql = "select *,statusdidata as statusdatas from t_data_umkm g 
        where  g.statusdidata in('1', '2') ".$where." order by g.id_umkm asc ".$page;
        $query = $this->dbkampungsiaga->query($sql);
        return $query->result();
    }
    function getDatasudahterdata() {
        $sql = "select  COUNT(nik) as totalsudahdata from t_data_umkm
        where statusdidata in('1', '2') ";
        $query = $this->dbkampungsiaga->query($sql);
        return $query->row();
    }
    function getdatabelumdidata($where, $page) {
    // function getdatabelumdidata($where) {
        // $sql = "select *,statusdidata as statusdatas from t_data_umkm g  
        // where (g.statusdidata ='0' or g.statusdidata is null) ".$where." order by g.id_umkm asc limit 100";

        $sql = "select *,statusdidata as statusdatas from t_data_umkm g  
        where (g.statusdidata ='0' or g.statusdidata is null) ".$where." order by g.id_umkm asc ".$page;

        // var_dump($sql);
        // exit();
        $query = $this->dbkampungsiaga->query($sql);
        return $query->result();
    }
    function gethistory($where) {
        $sql = "select * from t_bansos_umkm_hasil_verifikasi 
        where id_umkm='".$where."'";
        $query = $this->dbkampungsiaga->query($sql);
        return $query->result();
    }

    function getDatatidakditemukan() {
        $sql = "select  COUNT(g.nik) as tidakditemukan from  t_data_umkm g
                where (g.statusdidata ='2')";
        $query = $this->dbkampungsiaga->query($sql);
        return $query->row();
    }
    function getDataditemukan() {
        $sql = "select COUNT(g.nik) from  t_data_umkm g
        where  g.statusdidata ='1'
        GROUP by a.statusdidata";
        $query = $this->dbkampungsiaga->query($sql);
        return $query->row();
    }
    function getDatafoto($idumkm) {
        $sql = "select *,  CONCAT('https://pangkas.tangerangkota.go.id/assets/pendataan-covid/rumah/', foto_rumah) as foto_rumah, foto_rumah as namafoto  from t_data_gambar_umkm where id_umkm='".$idumkm."'";
        $query = $this->dbkampungsiaga->query($sql);
        return $query->result();
    }
    function getDataditemukandetail($where, $page) {
    // function getDataditemukandetail($where) {
        // $sql = "select *, statusdidata as statusdatas from t_data_umkm g 
        // where   g.statusdidata ='1'  ".$where." order by g.id_umkm asc limit 100";

        $sql = "select *, statusdidata as statusdatas from t_data_umkm g 
        where   g.statusdidata ='1'  ".$where." order by g.id_umkm asc ".$page;
        $query = $this->dbkampungsiaga->query($sql);
        return $query->result();
    }
    function getDatatidakditemukandetail($where, $page) {
    // function getDatatidakditemukandetail($where) {

        // $sql = "select *, statusdidata as statusdatas from t_data_umkm g 
        // where  (g.statusdidata ='2')".$where." order by g.id_umkm asc limit 100";
        $sql = "select *, statusdidata as statusdatas from t_data_umkm g 
        where  (g.statusdidata ='2')".$where." order by g.id_umkm asc ".$page;
        $query = $this->dbkampungsiaga->query($sql);
        return $query->result();
    }

    function simpantdataumkm($alamatsosialmedia, $alamatworkshop,$longitud,$latitud,$fotoktp,$nama_usaha,$nama_pemilik,$nik,$alamat,$no_rt,$no_rw,$kelurahan,$kecamatan,$kota,$no_hp,$omset,$assets,$modal_sendiri,
                            $created_at,$created_by,$edited_at,$edited_by,$status,$status_verifikasi,$provinsitematik,$kotatematik,
                            $kecamataaantematik,$kelurahaantematik,$lokasikampungtematik,$tempatlahir,$domisiliktp,$tanggallahir,$jeniskelamin,
                            $namaibukandung,$namaizinusaha,$nosuratizinusaha,$npwp,$tanggalmulai,$provinsiworkshop,$kotaworkshop,
                            $kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop,$rtworkshop,$rwworkshop,$kodepos,$telpon,$fax,$email,$website,$bentukusaha,$jenisusaha,$kegiatanutama,
                            $produkutama,$tahundata,$totalkariawanlakilaki,$totaltenagakerjalakilaki,$omzetawal,$asset,$modalluar,$totalmodalluar,
                            $jenistempatusaha,$saranausaha,$statussarana,$bahanbakar,$negaraexpor,$volumeexpor,$nominalexpor,$totaltenagakerjaperempuan,$totalkariawanperempuan, $json_kontak) {
        $sql = "INSERT INTO t_data_umkm(alamatsosialmedia, alamatworkshop,statusdidata, longitude, latitude, namafilektp, nama_usaha,nama_pemilik,nik,alamat,no_rt,no_rw,kelurahan,kecamatan,kota,no_hp,omset,assets,modal_sendiri,created_at,created_by,edited_at,edited_by,provinsitematik,
        kotatematik,kecamataaantematik,kelurahaantematik,lokasikampungtematik,tempatlahir,domisiliktp,tanggallahir,jeniskelamin,namaibukandung,namaizinusaha,nosuratizinusaha,npwp,tanggalmulai,provinsiworkshop,kotaworkshop,kecamatanworkshop,
        kelurahanworkshop,kodeposworkshop,rtworkshop,rwworkshop,kodepos,telpon,fax,email,website,bentukusaha,jenisusaha,kegiatanutama,produkutama,tahundata,totalkariawanlakilaki,
        totaltenagakerjalakilaki,omzetawal,asset,modalluar,totalmodalluar,jenistempatusaha,saranausaha,statussarana,bahanbakar,negaraexpor,volumeexpor,nominalexpor,totaltenagakerjaperempuan,totalkariawanperempuan,json_kontak)
        VALUES ('$alamatsosialmedia','$alamatworkshop','0','$longitud','$latitud','$fotoktp','$nama_usaha','$nama_pemilik','$nik','$alamat','$no_rt','$no_rw','$kelurahan','$kecamatan','$kota','$no_hp','$omset','$assets','$modal_sendiri','$created_at','$created_by','$edited_at','$edited_by','$provinsitematik',
        '$kotatematik','$kecamataaantematik','$kelurahaantematik','$lokasikampungtematik','$tempatlahir','$domisiliktp','$tanggallahir','$jeniskelamin','$namaibukandung',
        '$namaizinusaha','$nosuratizinusaha','$npwp','$tanggalmulai','$provinsiworkshop','$kotaworkshop','$kecamatanworkshop','$kelurahanworkshop','$kodeposworkshop','$rtworkshop','$rwworkshop','$kodepos','$telpon','$fax',
        '$email','$website','$bentukusaha','$jenisusaha','$kegiatanutama','$produkutama','$tahundata','$totalkariawanlakilaki','$totaltenagakerjalakilaki','$omzetawal','$asset','$modalluar','$totalmodalluar','$jenistempatusaha','$saranausaha','$statussarana',
        '$bahanbakar','$negaraexpor','$volumeexpor','$nominalexpor','$totaltenagakerjaperempuan','$totalkariawanperempuan','$json_kontak')";
        // var_dump($sql)
        // exit();
        $query = $this->dbkampungsiaga->query($sql);
        return $this->dbkampungsiaga->insert_id();
    }

    function updatedata($alamatsosialmedia, $alamatworkshop, $id_umkm, $statusdidata, $longitud,$latitud,$fotoktp,$nama_usaha,$nama_pemilik,$nik,$alamat,$no_rt,$no_rw,$kelurahan,$kecamatan,$kota,$no_hp,$omset,$assets,$modal_sendiri,
                            $created_at,$created_by,$edited_at,$edited_by,$status,$status_verifikasi,$provinsitematik,$kotatematik,
                            $kecamataaantematik,$kelurahaantematik,$lokasikampungtematik,$tempatlahir,$domisiliktp,$tanggallahir,$jeniskelamin,
                            $namaibukandung,$namaizinusaha,$nosuratizinusaha,$npwp,$tanggalmulai,$provinsiworkshop,$kotaworkshop,
                            $kecamatanworkshop,$kelurahanworkshop,$kodeposworkshop,$rtworkshop,$rwworkshop,$kodepos,$telpon,$fax,$email,$website,$bentukusaha,$jenisusaha,$kegiatanutama,
                            $produkutama,$tahundata,$totalkariawanlakilaki,$totaltenagakerjalakilaki,$omzetawal,$asset,$modalluar,$totalmodalluar,
                            $jenistempatusaha,$saranausaha,$statussarana,$bahanbakar,$negaraexpor,$volumeexpor,$nominalexpor,$totaltenagakerjaperempuan,$totalkariawanperempuan,$profesi_pemilik, $tempat_pemasaran,$pemasaran_online, $json_kontak) {
        $sql =" update t_data_umkm  set  alamatsosialmedia='".$alamatsosialmedia."', alamatworkshop='".$alamatworkshop."', statusdidata='".$statusdidata."', longitude = '$longitud', latitude='$latitud', namafilektp='$fotoktp', nama_usaha='$nama_usaha',nama_pemilik='$nama_pemilik',nik='$nik',alamat='$alamat',no_rt='$no_rt',no_rw='$no_rw',kelurahan='$kelurahan',
        kecamatan='$kecamatan',kota='$kota',no_hp='$no_hp',omset='$omset',assets='$assets',modal_sendiri='$modal_sendiri',edited_at=now(),edited_by='$edited_by',provinsitematik='$provinsitematik',
        kotatematik='$kotatematik',kecamataaantematik='$kecamataaantematik',kelurahaantematik='$kelurahaantematik',lokasikampungtematik='$lokasikampungtematik',tempatlahir='$tempatlahir',domisiliktp='$domisiliktp',tanggallahir='$tanggallahir',jeniskelamin='$jeniskelamin',
        namaibukandung='$namaibukandung',namaizinusaha='$namaizinusaha',nosuratizinusaha='$nosuratizinusaha',npwp='$npwp',tanggalmulai='$tanggalmulai',provinsiworkshop='$provinsiworkshop',kotaworkshop='$kotaworkshop',kecamatanworkshop='$kecamatanworkshop',
        kelurahanworkshop='$kelurahanworkshop',kodeposworkshop='$kodeposworkshop',rtworkshop='$rtworkshop',rwworkshop='$rwworkshop',kodepos='$kodepos',telpon='$telpon',fax='$fax',
        email='$email',website='$website',bentukusaha='$bentukusaha',jenisusaha='$jenisusaha',kegiatanutama='$kegiatanutama',produkutama='$produkutama',tahundata='$tahundata',totalkariawanlakilaki='$totalkariawanlakilaki',
        totaltenagakerjalakilaki='$totaltenagakerjalakilaki',omzetawal='$omzetawal',asset='$asset',modalluar='$modalluar',totalmodalluar='$totalmodalluar',jenistempatusaha='$jenistempatusaha',saranausaha='$saranausaha',
        statussarana='$statussarana',bahanbakar= '$bahanbakar',negaraexpor='$negaraexpor',volumeexpor='$volumeexpor',nominalexpor='$nominalexpor',totaltenagakerjaperempuan='$totaltenagakerjaperempuan',totalkariawanperempuan='$totalkariawanperempuan', profesi_pemilik='$profesi_pemilik', tempat_pemasaran='$tempat_pemasaran',
        pemasaran_online='$pemasaran_online', json_kontak = '$json_kontak' where id_umkm='$id_umkm'";
        
        $query = $this->dbkampungsiaga->query($sql);
        return $this->dbkampungsiaga->insert_id();
    }

    function update($tabel, $data, $where){
        $this->dbkampungsiaga->update($tabel, $data, $where);
        $aff_rows = $this->dbkampungsiaga->affected_rows();
        $arr = array(
            'affected_rows'=>$aff_rows
        );
        // var_dump($this->dbkampungsiaga->last_query());
        // exit();
        return $arr;
    }
    function simpanfotorumah($data) {
        
        $query = $this->dbkampungsiaga->insert_batch('t_data_gambar_umkm', $data);
        return $this->dbkampungsiaga->last_query();
    }
 

    function simpantdatahistory($id_umkm,$nik,$status_didata,$keterangan,$latitude,$longitude,$alamat_perbaikan,$nama_foto_ktp,$created_at,$created_by,$last_edit_at,$last_edit_by,$urut,$cek_alamat,$foto_ktp_name) {
        $sql = "INSERT INTO t_bansos_umkm_hasil_verifikasi(id_umkm, nik,status_didata,keterangan,latitude,longitude,alamat_perbaikan,nama_foto_ktp,created_at,created_by,last_edit_at,last_edit_by,urut,cek_alamat)
        VALUES ('$id_umkm','$nik','$status_didata','$keterangan','$latitude','$longitude','$alamat_perbaikan','$nama_foto_ktp',now(),'$created_by',now(),'$last_edit_by','$urut','$cek_alamat')";
        
        $query = $this->dbkampungsiaga->query($sql);
        return $this->dbkampungsiaga->insert_id();
    }


    

}