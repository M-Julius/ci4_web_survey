<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('/dashboard'); ?>">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                    <span class="badge badge-primary">NEW</span>
                </a>
            </li>
            <li class="nav-title">Master</li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('/barang'); ?>">
                    <i class="nav-icon icon-drop"></i> Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('/lokasi'); ?>">
                    <i class="nav-icon icon-drop"></i> Lokasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('/marketing'); ?>">
                    <i class="nav-icon icon-drop"></i> Marketing
                </a>
            </li>
            <li class="nav-title">Transaksi</li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('/survey'); ?>">
                    <i class="nav-icon icon-drop"></i> Surveyor Marketing
                </a>
            </li>
            <li class="nav-title"></li>
            <li class="nav-item">
                <a class="nav-link nav-link-danger" href="<?= site_url('/logout'); ?>" target="_top">
                    <i class="nav-icon icon-layers"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>