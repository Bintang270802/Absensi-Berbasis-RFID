
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Aplikasi Absensi</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body  onload="window.print();">
<?php 
//data ijin
$db = \Config\Database::connect();
$query = $db->query("SELECT TANGGAL_ABSEN,nama_ptk,nuptk,nama_jenis_ptk,STATUS,KETERANGAN,FILE FROM tweb_pegawai_absen
JOIN t_ptk ON t_ptk.id_ptk = tweb_pegawai_absen.ID_PEGAWAI
JOIN r_jenis_ptk ON r_jenis_ptk.id_jenis_ptk = t_ptk.id_jenis_ptk
where TANGGAL_ABSEN='$getTanggal' AND ID_PEGAWAI='$getId'");
$row = $query->getRow();

?>
<div class="card-body table-border-style">
    <div class="container">

    <div class="container">
        <div class="row">
            <div class="col-12 text-right">
            Demak, <?=  tgl_indo($row->TANGGAL_ABSEN) ?>
            </div> 
        </div>
        <div class="row">
            <div class="col-12">
                Yang terhormat,
            </div> 
            <div class="col-12">
                1.	Bapak Kepala Madrasah
            </div> 
            <div class="col-12">
                2.	Bapak/Ibu Guru Piket 
            </div> 
            <div class="col-12">
                MA Sholahuddin Kerangkulon
            </div> 
            <div class="col-12">
                Di tempat
            </div> 
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                Assalamu'alaikum Warahmatullahi Wabarokatuh
            </div> 
            <div class="col-12">
                Dengan hormat,
            </div> 
            <div class="col-12">
                Saya yang bertanda tangan di bawah ini :
            </div> 
        </div>
        <div class="row">
            <div class="col-2">
                Nama 
            </div> 
            <div class="col-10">
                : <?= $row->nama_ptk ?>
            </div> 
            <div class="col-2">
                NPK/NUPTK
            </div> 
            <div class="col-10">
                : <?= $row->nuptk ?>
            </div> 
            <div class="col-2">
                Jabatan 
            </div> 
            <div class="col-10">
                : <?= $row->nama_jenis_ptk ?>
            </div> 
            <div class="col-2">
                Unit Kerja
            </div> 
            <div class="col-10">
                : MA Sholahuddin Kerangkulon
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                Dengan ini menyampaikan permohonan izin tidak masuk kerja pada :
            </div> 
            <div class="col-2">
                Hari, tanggal 
            </div> 
            <div class="col-10">
                : <?=  tgl_indo($row->TANGGAL_ABSEN) ?>
            </div> 
            <div class="col-2">
                Klasifikasi Izin
            </div> 
            <div class="col-10">
                : <?= stsizin($row->STATUS) ?>
            </div> 
            <div class="col-2">
                Ket. Tambahan
            </div> 
            <div class="col-10">
                : <?= $row->KETERANGAN ?>
            </div> 
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                Sehubungan dengan hal tersebut saya memohon kepada Bapak/Ibu untuk berkenan memberikan izin. Sebagai bukti saya sertakan pula surat keterangan / dokumentasi.
            </div> 
        </div>
        
        <div class="row">
            <div class="col-12">
                Demikian permohonan izin ini saya sampaikan. Atas kebijaksanaan dan izin yang diberikan, kami ucapkan terima kasih.
            </div> 
        </div>
        
        <div class="row">
            <div class="col-12">
                Assalamu'alaikum Warahmatullahi Wabarokatuh
            </div> 
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-12">
                Hormat Saya,
            </div> 
            <div class="col-12">
                <?= $row->nama_ptk ?>
            </div> 
        </div>
        <br>
        <div class="row">
            <div class="col-12 text-center">
                Bukti Dokumen :
            </div> 
            <div class="col-12 text-center">
                <img class="img-thumbnail" src="<?=base_url()?>/ijin/<?=$row->FILE;?>" width="500">
            </div> 
           
        </div>
    </div>                
        
    </div>
</div>

</body>
</html>