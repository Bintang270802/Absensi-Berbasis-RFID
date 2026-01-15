
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
                                                            <th>Total Jam</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        if($idPtk>0){
                                                            $no=0;
                                                            $tgl = date('Y-m-d');
                                                            foreach ($getAbsensi as $data) {  
                                                            $no++;
                                                            $id =$data['ID_PEGAWAI'];
                                                            $tgl = $data['TANGGAL'];
                                                            $jammasuk = jammasuk($idPtk,$tgl);
                                                            $jampulang = jampulang($idPtk,$tgl);
    
                                                            $diff    =strtotime($jampulang) - strtotime($jammasuk);
                                                            $jam    =floor($diff / (60 * 60));
                                                            $menit    =$diff - $jam * (60 * 60);
                                                        ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $data['TANGGAL'] ?></td>
                                                            <td><?= $jammasuk ?></td>
                                                            <td><?= sts_absen($id,$tgl) ?></td>
                                                            <td><?= $jampulang ?></td>
                                                            <td>
                                                                <?php 
                                                                if(empty($jampulang)){
                                                                    echo "";
                                                                }elseif(empty($jammasuk)){
                                                                    echo "";
                                                                }else{
                                                                ?>
                                                                <?= $jam ?> jam, <?= floor( $menit / 60 )  ?> menit
                                                                <?php } ?>
                                                            </td>
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