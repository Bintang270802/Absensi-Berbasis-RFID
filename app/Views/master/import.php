 <!-- [ Main Content ] start -->
 <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ breadcrumb ] start -->
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="page-header-title">
                                                <h5 class="m-b-10"><?=$title;?></h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="<?= base_url('Home'); ?>"><i class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="<?= base_url($nav); ?>"><?=$nav;?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ breadcrumb ] end -->
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <!-- [ static-layout ] start -->
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-10">
                                                <h5>Download Format Import</h5>
                                                </div>
                                                
                                            </div>

                                        </div>
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Format Import</th>
                                                            <th>File</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Format Import Siswa</td>
                                                            <td><img src="<?=base_url()?>/image/excel.png" width="30" height="30"> <a href="<?=base_url()?>/file/format_import_siswa.xls">Downlaod</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="card">
                                       
                                        <hr>
                                        <form class="was-validated" method="post" action="<?= base_url('Import/addsiswa'); ?>" enctype="multipart/form-data">
                                        <div class="card-body table-border-style">
                                            <div class="form-group">
                                                <label>Jenis Upload</label>
                                                <select class="form-control" name="jenis" required>
                                                    <option>Pilih</option>
                                                    <option value="1">Replace</option>
                                                    <option value="2">No Replace</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="formFile" class="form-label">Pilih File Import Siswa</label>
                                                <input class="form-control" name="file" type="file" id="formFile" required>
                                            </div>
                                            <button type="submit" class="btn btn-info">Import</button>
                                        </div>
                                        
                                        </form>
                                    </div>
                                </div>
                                <!-- [ static-layout ] end -->

                            </div>
                            <!-- [ Main Content ] end -->
                           
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
