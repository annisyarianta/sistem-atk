<!--start header-->
<header class="top-header">
    <nav class="navbar navbar-expand align-items-center gap-4">
        <div class="btn-toggle">
            <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
        </div>
        <div class="search-bar flex-grow-1">
            <div class="position-relative">
                <div class="search-popup p-3">
                    <div class="card rounded-4 overflow-hidden">
                        <div class="card-body search-content"></div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="navbar-nav gap-1 nav-right-links align-items-center">
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-notify dropdown-menu-end shadow">
                    <div class="px-3 py-1 d-flex align-items-center justify-content-between border-bottom">
                        <div class="dropdown">
                            <div class="dropdown-menu dropdown-option dropdown-menu-end shadow"></div>
                        </div>
                    </div>
                    <div class="notify-list"></div>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/default-profile.png') }}" class="rounded-circle p-1 border"
                        width="45" height="45" alt="" />
                </a>
                <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                    <a class="dropdown-item gap-2 py-2" href="javascript:;">
                        <div class="text-center">
                            <img src="{{ asset('images/default-profile.png') }}" class="rounded-circle p-1 shadow mb-3"
                                width="90" height="90" alt="" />
                            <h5 class="user-name mb-0 fw-bold">
                                Hello, {{ Auth::user()->nama }}!
                            </h5>
                        </div>
                    </a>
                    <hr class="dropdown-divider" />
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons-outlined">power_settings_new</i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</header>
<!--end top header-->

<!--start sidebar-->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="{{ asset('images/logo-injourney.png') }}" class="logo-sm-img" alt="logo" />
        </div>
        <div class="logo-name flex-grow-1">
            <img src="{{ asset('images/logo-injourney-airport.png') }}" class="logo-lg-img" alt="logo" />
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            @if (Auth::user()->role === 'admin')
                <li>
                    <a href="{{ route('dashboard.index') }}" class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">dashboard</i>
                            </div>
                            <div class="menu-title ms-2">Dashboard</div>
                        </div>
                        <span class="badge bg-danger">1</span>
                    </a>
                </li>
                <li class="menu-label">Kelola ATK</li>
                <li>
                    <a href="{{ route('atk-masuk.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">archive</i>
                        </div>
                        <div class="menu-title">ATK Masuk</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('atk-keluar.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">unarchive</i>
                        </div>
                        <div class="menu-title">ATK Keluar</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('daftar-atk.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">assignment</i>
                        </div>
                        <div class="menu-title">Daftar ATK</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('validasi-atk.index') }}"
                        class="d-flex align-items-center justify-content-between w-100">
                        <div class="d-flex align-items-center">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">inventory</i>
                            </div>
                            <div class="menu-title ms-2">Validasi ATK</div>
                        </div>
                        @if ($jumlahValidasi > 0)
                            <span class="badge bg-danger">{{ $jumlahValidasi }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">dataset</i>
                        </div>
                        <div class="menu-title">Master Data</div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('master-atk.index') }}"><i
                                    class="material-icons-outlined">arrow_right</i>Data
                                ATK</a>
                        </li>
                        <li>
                            <a href="{{ route('master-unit.index') }}"><i
                                    class="material-icons-outlined">arrow_right</i>Data Unit</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-label">Reports</li>
                <li>
                    <a href="{{ route('berita-acara.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">description</i>
                        </div>
                        <div class="menu-title">Berita Acara</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cetak-laporan.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">print</i>
                        </div>
                        <div class="menu-title">Cetak Laporan</div>
                    </a>
                </li>
                <li class="menu-label">Settings</li>
                <li>
                    <a href="{{ route('kelola-user.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">groups</i>
                        </div>
                        <div class="menu-title">Kelola User</div>
                    </a>
                </li>
                <li class="menu-label">Logs</li>
                <li>
                    <a href="{{ route('log-login.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">security</i>
                        </div>
                        <div class="menu-title">Log Login</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('log-activity.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">history</i>
                        </div>
                        <div class="menu-title">Log Activity</div>
                    </a>
                </li>
            @elseif (Auth::user()->role === 'staff')
                <li>
                    <a href="{{ route('daftar-atk.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">assignment</i>
                        </div>
                        <div class="menu-title">Daftar ATK</div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('request-atk.index') }}">
                        <div class="parent-icon">
                            <i class="material-icons-outlined">pending_actions</i>
                        </div>
                        <div class="menu-title">Permohonan ATK</div>
                    </a>
                </li>
            @endif
        </ul>
        <!--end navigation-->
    </div>
</aside>
<!--end sidebar-->
