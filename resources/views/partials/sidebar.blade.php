<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-2" href="/">
        <div class="sidebar-brand-icon" style="width: 40px; overflow: hidden; height: 40px; min-width: 40px;">
            <img style="width: 100%; height: 100%; object-fit: contain; object-position: center;"
                src="/img/{{ getSetting('app_icon') }}" alt="">
        </div>
        <div class="sidebar-brand-text mx-3" style="text-align: start;">{{ getSetting('app_name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Menu Beranda -->
    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fa fa-fw fa-home"></i>
            <span>Beranda</span>
        </a>
    </li>

    <!-- Group Data -->
    @role('staff|developer')
        <div class="sidebar-heading">Data</div>
        <li class="nav-item {{ Request::is('books') ? 'active' : '' }}">
            <a class="nav-link" href="/books">
                <i class="fa fa-fw fa-book" aria-hidden="true"></i>
                <span>Buku</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('book-categories') ? 'active' : '' }}">
            <a class="nav-link" href="/book-categories">
                <i class="fa fa-fw fa-list" aria-hidden="true"></i>
                <span>Kategori Buku</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('members') ? 'active' : '' }}">
            <a class="nav-link" href="/members">
                <i class="fa fa-fw fa-user" aria-hidden="true"></i>
                <span>Anggota</span>
            </a>
        </li>
    @endrole

    @role('staff|developer')
        <!-- Group Transaksi -->
        <div class="sidebar-heading">Transaksi</div>
        <li class="nav-item {{ Request::is('visits/create') ? 'active' : '' }}">
            <a class="nav-link" href="/visits/create">
                <i class="fa fa-check" aria-hidden="true"></i>
                <span>Kunjungan</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('loans/create') ? 'active' : '' }}">
            <a class="nav-link" href="/loans/create">
                <i class="fa fa-fw fa-arrow-right" aria-hidden="true"></i>
                <span>Tambah Peminjaman</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('returns/create') ? 'active' : '' }}">
            <a class="nav-link" href="/returns/create">
                <i class="fa fa-fw fa-arrow-left" aria-hidden="true"></i>
                <span>Tambah Pengembalian</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('loans') ? 'active' : '' }}">
            <a class="nav-link" href="/loans">
                <i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
                <span>Daftar Peminjaman</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('visits') ? 'active' : '' }}">
            <a class="nav-link" href="/visits">
                <i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
                <span>Daftar Kunjungan</span>
            </a>
        </li>
    @endrole

    @role('developer|admin')
        <!-- Group Admin -->
        <div class="sidebar-heading">Admin</div>
        <li class="nav-item {{ Request::is('staffs') ? 'active' : '' }}">
            <a class="nav-link" href="/staffs">
                <i class="fa fa-fw fa-users"></i>
                <span>Staff</span>
            </a>
        </li>
        <li class="nav-item {{ Request::query('type') === 'library' ? 'active' : '' }}">
            <a class="nav-link" href="/settings?type=library">
                <i class="fa fa-fw fa-cog"></i>
                <span>Pengaturan Perpustakaan</span>
            </a>
        </li>
        <li class="nav-item {{ Request::query('type') === 'system' ? 'active' : '' }}">
            <a class="nav-link" href="/settings?type=system">
                <i class="fa fa-fw fa-cog"></i>
                <span>Pengaturan Sistem</span>
            </a>
        </li>
    @endrole

    <!-- Group Personalisasi -->
    <div class="sidebar-heading">Personalisasi</div>
    <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
        <a class="nav-link" href="/profile">
            <i class="fa fa-fw fa-cog"></i>
            <span>Pengaturan Akun</span>
        </a>
    </li>

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

{{-- <!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li> --}}

<!-- Divider -->
{{-- <hr class="sidebar-divider"> --}}

<!-- Heading -->
{{-- <div class="sidebar-heading">
    Menu
</div> --}}

<!-- Nav Item - Pages Collapse Menu -->
{{-- <li class="nav-item">
    <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Single</span></a>
</li> --}}

{{-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Multi Level</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Halaman</a>
        </div>
    </div>
</li> --}}

<!-- Divider -->
{{-- <hr class="sidebar-divider d-none d-md-block"> --}}

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline mt-5">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
