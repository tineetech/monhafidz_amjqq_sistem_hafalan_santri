 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      {{-- menu admin  --}}
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="{{ route('santri.index') }}"><i class="fa fa-circle-o"></i> Santri</a></li>
            <li class=""><a href="{{ route('ustadzah.index') }}"><i class="fa fa-circle-o"></i> Ustad</a></li>
            <li class=""><a href="{{ route('wali.index') }}"><i class="fa fa-circle-o"></i> Wali Santri</a></li>
            <li class=""><a href="{{ route('semester.index') }}"><i class="fa fa-circle-o"></i> Semester</a></li>
          </ul>
        </li>
        <li class="">
          <a href="{{ route('absensi.index') }}">
            <i class="fa fa-id-badge"></i> <span>Absensi</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
        <li class="">
          <a href="{{ route('jadwal-ujian.index') }}">
            <i class="fa fa-calendar"></i> <span>Jadwal Ujian</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
        <li class="">
          <a href="{{ route('pencatatan-ujian.index') }}">
            <i class="fa fa-book"></i> <span>Pencatatan Ujian</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
        <li class="">
          <a href="{{ route('jadwal-hafalan.index') }}">
            <i class="fa fa-calendar"></i> <span>Jadwal Hafalan</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
        <li class="">
          <a href="{{ route('pencatatan-hafalan.index') }}">
            <i class="fa fa-book"></i> <span>Pencatatan Hafalan</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
        <li class="">
          <a href="{{ route('rekap-hafalan.index') }}">
            <i class="fa fa-archive"></i> <span>Rekap Hafalan</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
        <li class="">
          <a href="{{ route('laporan.index') }}">
            <i class="fa fa-file"></i> <span>Laporan</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
        <li class="">
          <a href="{{ route('manage-akun.index') }}">
            <i class="fa fa-users"></i> <span>Manajemen Akun</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
        <li class="">
          <a href="{{ route('pengaturan.index') }}">
            <i class="fa fa-cog"></i> <span>Pengaturan</span>
            {{-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> --}}
          </a>
        </li>
      </ul>
      {{-- menu admin  --}}

    </section>
    <!-- /.sidebar -->
  </aside>