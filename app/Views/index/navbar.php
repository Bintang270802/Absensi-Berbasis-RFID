   <!-- [ Pre-loader ] start -->
   <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div> 
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menu-light brand-blue">
        <div class="navbar-wrapper">
            <div class="navbar-content scroll-div">
                <div class="">
					<div class="main-menu-header">
                        <img class="img-radius" src="<?=base_url()?>/image/<?=session()->get('foto');?>" alt="User-Profile-Image">
						<div class="user-details">
							<div id="more-details"><?=session()->get('nama');?> <i class="fa fa-caret-down"></i></div>
						</div>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
							<li class="list-group-item"><a href="<?= base_url('Cpanel/logout'); ?>"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
						</ul>
					</div>
				</div>
                <br>
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label><?= hari_ini() ?>, <?= date('d F Y') ?></label>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Home'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    
                    <?php if((session()->get('level'))==1) {?>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Setting</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="<?= base_url('Setting'); ?>">Aplikasi</a></li>
                            
                            <li><a href="<?= base_url('User'); ?>">User Management</a></li>
                            <li><a href="<?= base_url('Tapel'); ?>">Tapel</a></li>
                            <li><a href="<?= base_url('Liburbesar'); ?>">Libur Hari Besar</a></li> 
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Master Siswa</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="<?= base_url('Siswa'); ?>">Data Siswa</a></li>
                            <li><a href="<?= base_url('Tingkatkelas'); ?>">Tingkat Kelas</a></li>
                            <li><a href="<?= base_url('Rombel'); ?>">Rombel</a></li>
                            <li><a href="<?= base_url('Siswarombel'); ?>">Setting Kelas</a></li>
                           
                        </ul>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-edit"></i></span><span class="pcoded-mtext">Koreksi Absen</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="<?= base_url('Absensisiswa/koreksi'); ?>">Siswa</a></li>
                            
                        </ul>
                    </li>
                   
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-airplay"></i></span><span class="pcoded-mtext">Info Absensi Siswa</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="<?= base_url('Absensisiswa/persiswa'); ?>">Per Siswa</a></li>
                            <li><a href="<?= base_url('Absensisiswa'); ?>">Harian</a></li>
                            <li><a href="<?= base_url('Absensisiswa/pertanggal'); ?>">Per tanggal</a></li>
                            <li><a href="<?= base_url('Absensisiswa/bulanan'); ?>">Bulanan</a></li>
                            <li><a href="<?= base_url('Pointsiswa'); ?>">Point</a></li>
                            <li><a href="<?= base_url('Absensisiswa/chart'); ?>">Chart Absen</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Import'); ?>" class="nav-link "><span class="pcoded-micon"><i class="feather icon-download"></i></span><span class="pcoded-mtext">Import</span></a>
                    </li>
                    <?php } ?>
                    
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <?php 
                $db = \Config\Database::connect();
                $builder = $db->table('t_setting_aplikasi');
                $query =  $builder->get();
                $aplikasi = $query->getRow();
                echo strtoupper($aplikasi->nm_aplikasi);
                ?>
                <img src="<?=base_url()?>/template/assets/images/logo-icon.png" alt="" class="logo-thumb">
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                    <div class="search-bar">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                
                
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->