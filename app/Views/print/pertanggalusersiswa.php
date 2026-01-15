
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Absensi Online</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body onload="window.print();">

<div class="card-body table-border-style">
    <div class="container">

                            <div class="row">
                                <!-- [ static-layout ] start -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col">
                                                <h5>Tabel Data Absensi Dari <?=formatTanggal($getTanggal1);?> s/d <?=formatTanggal($getTanggal2);?>, Nama : <?= $nama ?></h5>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                            <table id="example" class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Tanggal</th>
                                                            <th>Jam Masuk</th>
                                                            <th>Status</th>
                                                            <th>Jam Pulang</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        if($idSiswa>0){
                                                            $no=0;
                                                            foreach ($getAbsensisiswa as $data) {  
                                                            $no++;
                                                            $id =$data['id_siswa'];
                                                            $tgl = $data['tgl_hadir'];
                                                            $jammasuk = jammasuk($idSiswa,$tgl);
                                                            $jampulang = jampulang($idSiswa,$tgl);
    
                                                            
                                                        ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $data['tgl_hadir'] ?></td>
                                                            <td><?= $jammasuk ?></td>
                                                            <td><?= sts_absen($id,$tgl) ?></td>
                                                            <td><?= $jampulang ?></td>
                                                            
                                                        </tr>    
                                                       <?php 
                                                        } 
                                                       }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ static-layout ] end -->
                            </div>
                            <!-- [ Main Content ] end -->
        
    </div>
</div>

</body>
</html>