
<!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper container">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="page-header">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?=base_url()?>/image/<?= $getLogo ?>" width="100">
                                    </div>
                                    <div class="col-sm">
                                        <h3>ABSENSI DIGITAL</h3> 
                                    </div>
                                </div>
                                        
                            </div>
                           
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>ABSENSI TANGGAL <?=formatTanggal(date('Y-m-d'));?></h5>
                                        </div>
                                        <?php if(session()->get('success')) : ?>
                                            <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <center><h5><i class="icon fas fa-check"></i> Data sukses <strong><?= session()->getFlashdata('success'); ?></strong></h5></center> 
                                            </div>
                                        <?php endif; ?>

                                        <?php if(session()->get('error')) : ?>
                                            <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <center><h5><i class="icon fas fa-check"></i> Data gagal <strong><?= session()->getFlashdata('error'); ?></strong></h5></center> 
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <form class="was-validated" method="post" action="<?= base_url('Dashboard/addabsensi'); ?>">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" name="rfid" autofocus required>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="hidden" name="hari" value="<?=$getHari;?>">
                                                        <input type="hidden" name="id_tapel" value="<?=$getIdtapel;?>">
                                                        <button type="submit" class="btn btn-danger">Absen</button>
                                                    </div>
                                                </div>

                                            </div>
                                            </form>
                                            
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>JAM</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="clock">
                                            <div id="hour"></div>
                                            <span>:</span>
                                            <div id="minute"></div>
                                            <span>:</span>
                                            <div id="seconds"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ horizontal-layout ] end -->
                          
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>HASIL ABSENSI</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                            <?php if($getId>0){
                                                foreach ($getSiswa as $data) {
                                            ?>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <img class="img-thumbnail" src="<?=base_url()?>/image/siswa/<?= $data['file'] ?>" width="200">
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama Induk</th>
                                                                <th>: <?= $data['no_induk'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Nama Siswa</th>
                                                                <th>: <?= $data['nm_siswa'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Kelas</th>
                                                                <th>: <?= $data['nm_rombel'] ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Jam Masuk</th>
                                                                <th>: <?= jammasuk($data['id_siswa'], date('Y-m-d')) ?>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Jam Pulang</th>
                                                                <th>: <?= jampulang($data['id_siswa'], date('Y-m-d')) ?>
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Status</th>
                                                                <th>: <?= sts_absen($data['id_siswa'], date('Y-m-d')) ?></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    
                                                </div>
                                            <?php 
                                                }
                                            }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   