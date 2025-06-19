@auth
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <a href=""><img src="{{ asset('images/icons/icon-512x512.png') }}" alt="Logo" width="65" height="65"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href=""><img src="{{ asset('images/icons/icon-512x512.png') }}" alt="Logo" width="65" height="65"></a>
    </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('home') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            @can('role-list')
            <li class="menu-header">Hak Akses</li>
            
            <li class="{{ Request::is('hakakses') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route("roles.index") }}"><i class="fas fa-user-shield"></i> <span>Roles</span></a>
            </li>
            @endcan
            @can('user-list')
            <li class="{{ Request::is('hakakses') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route("users.index") }}"><i class="fas fa-user-shield"></i> <span>Pengguna</span></a>
            </li>
            @endcan

            <!-- profile ganti password -->
            <li class="menu-header">Profile</li>
            <li class="{{ Request::is('profile/edit') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile/edit') }}"><i class="far fa-user"></i> <span>Profile</span></a>
            </li>
            <li class="{{ Request::is('profile/change-password') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('profile/change-password') }}"><i class="fas fa-key"></i> <span>Ganti Password</span></a>
            </li>
            <li class="menu-header">Data Kit</li>

            @can('provinsi-list')
            <li class="{{ Request::is('provinsi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('provinsi') }}"><i class="fas fa-university"></i> <span> Data Provinsi </span></a>
            </li>
            @endcan

            @can('prodi-list')
            <li class="{{ Request::is('prodi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('prodi') }}"><i class="fas fa-university"></i> <span> Data Prodi </span></a>
            </li>
            @endcan

            @can('pt-list')
            <li class="{{ Request::is('pt') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('pt') }}"><i class="fas fa-university"></i> <span> Data Perguruan Tinggi </span></a>
            </li>
            @endcan

            @can('ptprodi-list')
            <li class="{{ Request::is('ptprodi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('ptprodi') }}"><i class="fas fa-university"></i> <span> Data Prodi Perguruan Tinggi </span></a>
            </li>
            @endcan

            @can('batch-list')
            <li class="{{ Request::is('batch') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('batch') }}"><i class="fas fa-university"></i> <span> Data Batch </span></a>
            </li>
            @endcan

            @can('yudisium-list')
            <li class="{{ Request::is('yudisium') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('yudisium') }}"><i class="fas fa-university"></i> <span> Data Yudisium </span></a>
            </li>
            @endcan

            @can('detail-list')
            <li class="{{ Request::is('detail') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('detail') }}"><i class="fas fa-university"></i> <span> Data Detail Yudisium </span></a>
            </li>
            @endcan

            @can('clustering-list')
            <li class="{{ Request::is('clustering') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('clustering') }}"><i class="fas fa-university"></i> <span> Clustering Mahasiswa </span></a>
            </li>
            @endcan

            
            <li class="menu-header">Examples</li>
            <li class="{{ Request::is('blank-page') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('blank-page') }}"><i class="far fa-square"></i> <span>Blank Page</span></a>
            </li>
            <li class="{{ Request::is('table-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('table-example') }}"><i class="fas fa-table"></i> <span>Table Example</span></a>
            </li>
            <li class="{{ Request::is('clock-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('clock-example') }}"><i class="fas fa-clock"></i> <span>Clock Example</span></a>
            </li>
            <li class="{{ Request::is('chart-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('chart-example') }}"><i class="fas fa-chart-bar"></i> <span>Chart Example</span></a>
            </li>
            <li class="{{ Request::is('form-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('form-example') }}"><i class="fas fa-file-alt"></i> <span>Form Example</span></a>
            </li>
            <li class="{{ Request::is('map-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('map-example') }}"><i class="fas fa-map"></i> <span>Map Example</span></a>
            </li>
            <li class="{{ Request::is('calendar-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('calendar-example') }}"><i class="fas fa-calendar"></i> <span>Calendar Example</span></a>
            </li>
            <li class="{{ Request::is('gallery-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('gallery-example') }}"><i class="fas fa-images"></i> <span>Gallery Example</span></a>
            </li>
            <li class="{{ Request::is('todo-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('todo-example') }}"><i class="fas fa-list"></i> <span>Todo Example</span></a>
            </li>
            <li class="{{ Request::is('contact-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('contact-example') }}"><i class="fas fa-envelope"></i> <span>Contact Example</span></a>
            </li>
            <li class="{{ Request::is('faq-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('faq-example') }}"><i class="fas fa-question-circle"></i> <span>FAQ Example</span></a>
            </li>
            <li class="{{ Request::is('news-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('news-example') }}"><i class="fas fa-newspaper"></i> <span>News Example</span></a>
            </li>
            <li class="{{ Request::is('about-example') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('about-example') }}"><i class="fas fa-info-circle"></i> <span>About Example</span></a>
            </li>
        </ul>
    </aside>
</div>
@endauth