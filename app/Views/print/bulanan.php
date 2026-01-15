
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
                                                <h5>Tabel Data Absensi Bulan <?=bulan($getBulan);?></h5>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nomor Finger</th>
                                                           
                                                            <th>Nama Pegawai</th>
                                                            <th>Jenis Kerja</th>
                                                            <th>Masuk</th>
                                                            <th>Terlambat</th>
                                                            <th>Sakit</th>
                                                            <th>Izin</th>
                                                            <th>Alpha</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $no=0;
                                                        foreach ($getPegawai as $data) {  
                                                        $no++;
                                                        $induk =$data['nomor_absensi'];
                                                        $id =$data['id_ptk'];
                                                        ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $data['nomor_absensi'] ?></td>
                                                           
                                                            <td><?= $data['nama_ptk'] ?></td>
                                                            <td><?= $data['nama_jenis_ptk'] ?></td>
                                                            <td><?= jummasukbln($id,$getBulan) ?></td>
                                                            <td><?= jumterlambatbln($id,$getBulan) ?></td>
                                                            <td><?= jumsakitbln($id,$getBulan) ?></td>
                                                            <td><?= jumizinbln($id,$getBulan) ?></td>
                                                            <td><?= jumalphabln($id,$getBulan) ?></td>
                                                        </tr>    
                                                       <?php } ?>
                                                    </tbody>
                                                </table>
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