
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
$query = $db->query("SELECT tgl_absen,nm_rombel,nm_siswa,no_induk,sts_absen,ket_absen,t_siswa_absen.file as file FROM t_siswa_absen 
JOIN t_siswa ON t_siswa.id_siswa = t_siswa_absen.id_siswa
JOIN t_siswa_rombel ON t_siswa_rombel.id_siswa = t_siswa_absen.id_siswa
JOIN t_rombel ON t_rombel.id_rombel = t_siswa_rombel.id_rombel
where t_siswa_absen.id_siswa_absen ='$getId'");
$row = $query->getRow();

?>
<div class="card-body table-border-style">
    <div class="container">

    <div class="container">
        <div class="row">
            <div class="col-12 text-right">
            Demak, <?=  tgl_indo($row->tgl_absen) ?>
            </div> 
        </div>
        <div class="row">
            <div class="col-12">
                Yang terhormat,
            </div> 
            <div class="col-12">
                1.	Bapak/Ibu Guru Wali Kelas <?= $row->nm_rombel ?>
            </div> 
            <div class="col-12">
                2.	Bapak/Ibu Guru Piket 
            </div> 
            <div class="col-12">
                3.	Bapak/Ibu Guru BP/BK
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
                Saya yang bertanda tangan di bawah ini adalah orang tua / wali murid dari :
            </div> 
        </div>
        <div class="row">
            <div class="col-2">
                Nama 
            </div> 
            <div class="col-10">
                : <?= $row->nm_siswa ?>
            </div> 
            <div class="col-2">
                Kelas
            </div> 
            <div class="col-10">
                : <?= $row->nm_rombel ?>
            </div> 
            <div class="col-2">
                No. Absen 
            </div> 
            <div class="col-10">
                : <?= $row->no_induk ?>
            </div> 
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                Dengan ini memberitahukan bahwa anak saya tidak dapat mengikuti proses belajar mengajar pada	: 
            </div> 
            <div class="col-2">
                Hari, tanggal 
            </div> 
            <div class="col-10">
                : <?=  tgl_indo($row->tgl_absen) ?>
            </div> 
            <div class="col-2">
                Klasifikasi Izin
            </div> 
            <div class="col-10">
                : <?= stsizin($row->sts_absen) ?>
            </div> 
            <div class="col-2">
                Ket. Tambahan
            </div> 
            <div class="col-10">
                : <?= $row->ket_absen ?>
            </div> 
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                Sehubungan dengan hal tersebut saya selaku wali murid memohon kepada Bapak/Ibu untuk berkenan memberikan izin. Sebagai bukti saya sertakan pula surat keterangan / dokumentasi.
            </div> 
        </div>
        
        <div class="row">
            <div class="col-12">
                Demikian permohonan izin ini kami sampaikan. Atas kebijaksanaan dan izin yang diberikan, kami ucapkan terima kasih.
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
                <?= $row->nm_siswa ?>
            </div> 
        </div>
        <br>
        <div class="row">
            <div class="col-12 text-center">
                Bukti Dokumen :
            </div> 
            <div class="col-12 text-center">
                <img class="img-thumbnail" src="<?=base_url()?>/ijin/<?=$row->file;?>" width="500">
            </div> 
           
        </div>
    </div>                
        
    </div>
</div>

</body>
</html>