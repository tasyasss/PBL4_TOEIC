<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">TOEIC</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Profil -->
    <li class="nav-item">
        <a class="nav-link" href=""> <!-- { route('admin.profil') }} -->
            <i class="fas fa-fw fa-user"></i>
            <span>Profil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Data Mahasiswa -->
    <li class="nav-item">
        <a class="nav-link" href=""> <!-- { route('admin.mahasiswa') }} -->
            <i class="fas fa-fw fa-table"></i>
            <span>Data Mahasiswa</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Data Pendaftaran -->
    <li class="nav-item">
        <a class="nav-link" href=""> <!-- { route('admin.pendaftaran') }} -->
            <i class="fas fa-fw fa-folder-plus"></i>
            <span>Data Pendaftaran</span></a>
    </li>

    <!-- Nav Item - Jadwal & Kuota -->
    <li class="nav-item">
        <a class="nav-link" href=""> <!-- { route('admin.jadwal') }} -->
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Jadwal & Kuota</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Bantuan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.help') }}"> <!-- { route('admin.bantuan') }} -->
            <i class="fas fa-fw fa-question-circle"></i>
            <span>Bantuan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
