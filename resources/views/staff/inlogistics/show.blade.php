<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Logistik Masuk &rsaquo; Detail logistik masuk &mdash; Warehouse BPBD | Kabupaten Jember</title>

    <link rel="shortcut icon" href="{{ asset('landingpages') }}/assets/images/logo/logobpbd1.png" type="image/png" />

    <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/select2/dist/css/select2.min.css">

    <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/css/components.css">

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                        <input id="search-input" class="form-control" type="search" placeholder="Search"
                            aria-label="Search" data-width="250">
                        <button class="btn" type="button" onclick="performSearch()"><i
                                class="fas fa-search"></i></button>
                    </div>
                    <div id="clock" style="color: white; margin-left: 15px;"></div>
                </form>
                <script>
                    function updateClock() {
                        var now = new Date();

                        var hours = now.getHours();
                        var minutes = now.getMinutes();
                        var seconds = now.getSeconds();
                        var wib = 'WIB';

                        var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        var dayName = days[now.getDay()];
                        var day = now.getDate();
                        var monthName = months[now.getMonth()];
                        var year = now.getFullYear();

                        hours = (hours < 10) ? "0" + hours : hours;
                        minutes = (minutes < 10) ? "0" + minutes : minutes;
                        seconds = (seconds < 10) ? "0" + seconds : seconds;
                        day = (day < 10) ? "0" + day : day;

                        var clockElement = document.getElementById('clock');
                        clockElement.innerHTML = dayName + ", " + day + " " + monthName + " " + year + "<br>" +
                            hours + " : " + minutes + " : " + seconds + "  " + wib;

                        setTimeout(updateClock, 1000);
                    }

                    updateClock();
                </script>
                <ul class="navbar-nav navbar-right">
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('tdashboard') }}/assets/img/avatar/logobpbd1.png"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">
                                @if(Auth::user()->last_login_at)
                                                                @php
                                                                    $diffInMinutes = Carbon\Carbon::now()->diffInMinutes(Auth::user()->last_login_at);
                                                                    $diffInSeconds = Carbon\Carbon::now()->diffInSeconds(Auth::user()->last_login_at);
                                                                    $hours = floor($diffInMinutes / 60);
                                                                    $remainingMinutes = $diffInMinutes % 60;
                                                                @endphp
                                                                @if($diffInMinutes > 60)
                                                                    Login {{ $hours }} jam {{ $remainingMinutes }} menit yang lalu
                                                                @elseif($diffInMinutes > 1)
                                                                    Login {{ $diffInMinutes }} menit yang lalu
                                                                @elseif($diffInSeconds > 0)
                                                                    Login {{ $diffInSeconds }} detik yang lalu
                                                                @else
                                                                    Baru Login
                                                                @endif
                                @else
                                    Baru Login
                                @endif
                            </div>
                            <a href="{{ route('staff.profile.edit') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item has-icon text-danger" style="cursor: pointer;">
                                    <i class="fas fa-door-open" style="display: block; margin-top: 8px;">
                                    </i>Keluar</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <img alt="image" src="{{ asset('tdashboard') }}/assets/img/avatar/logobpbd1.png"
                            style="width: 143px; height: auto; margin-top: 20px;">
                        <a href="{{ route('staff.dashboard') }}"> Warehouse BPBD </a>
                        <hr
                            style="margin-top: 3px; margin-bottom: 3px; border: none; border-bottom: 0.1px solid #C1C1C1; width: 80%;">
                        <p><br></p>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">WB</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a href="{{ route('staff.dashboard') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Aktivitas</li>
                        <li class=active>
                            <a href="{{ route('staff.inlogistics.index')}}" class="nav-link"><i class="fas fa-sign-in-alt"></i>
                                <span>Logistik Masuk</span></a>
                        </li>
                        <li>
                            <a href="{{ route('staff.outlogistics.index')}}" class="nav-link"><i class="fas fa-sign-out-alt"></i>
                                <span>Logistik Keluar</span></a>
                        </li>
                        <li class="menu-header">Pengaturan</li>
                        <li>
                            <a href="{{ route('staff.profile.edit')}}" class="nav-link"><i class="fas fa-user"></i>
                                <span>Profil</span></a>
                        </li>
                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-primary btn-lg btn-block btn-icon-split" type="submit">
                                    <i class="fas fa-door-open"></i> Keluar
                                </button>
                            </form>
                        </div>
                </aside>
            </div>

            <!-- Main -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Detail logistik masuk</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('staff.dashboard') }}">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="{{ route('staff.inlogistics.index') }}">Data Logistik Masuk</a>
                            </div>
                            <div class="breadcrumb-item">Detail logistik masuk</div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="d-flex align-items-center justify-content-end">
                                    <a href="{{ route('staff.inlogistics.index') }}" class="btn btn-primary mr-2"
                                        style="margin-top: 10px; background-color: silver !important; color: black !important;">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                                <div class="card-header">
                                    <h4 style="font-size: 2rem;">Detail logistik masuk</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 style="color: blue;">Data Supplier</h4>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_supplier">Nama Supplier:</label>
                                                <p>{{ $inlogistic->supplier->nama_supplier }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_supplier">Kode Supplier:</label>
                                                <p>{{ $inlogistic->supplier->kode_supplier }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="instansi_supplier">Instansi Supplier:</label>
                                                <p>{{ $inlogistic->supplier->instansi_supplier }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="email_supplier">Email Supplier:</label>
                                                <p>{{ $inlogistic->supplier->email_supplier }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="telepon_supplier">Telepon Supplier:</label>
                                                <p>{{ $inlogistic->supplier->telepon_supplier }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_masuk">Tanggal Masuk:</label>
                                                <p>{{ \Carbon\Carbon::parse($inlogistic->tanggal_masuk)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h4 style="color: blue;">Data Logistik</h4>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_logistik">Nama Logistik:</label>
                                                <p>{{ $inlogistic->logistic->nama_logistik }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_logistik">Kode Logistik:</label>
                                                <p>{{ $inlogistic->logistic->kode_logistik }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="satuan_logistik">Satuan Logistik:</label>
                                                <p>{{ $inlogistic->logistic->satuan_logistik }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_logistik_masuk">Jumlah:</label>
                                                <p>{{ $inlogistic->jumlah_logistik_masuk }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="expayer_logistik">Tanggal Kadaluarsa:</label>
                                                <p>{{ \Carbon\Carbon::parse($inlogistic->expayer_logistik)->translatedFormat('l, d F Y') }}
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label for="keterangan_masuk">Keterangan:</label>
                                                <p>{{ $inlogistic->keterangan_masuk }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="dokumentasi_masuk">Dokumentasi:</label>
                                                <img src="{{ asset($inlogistic->dokumentasi_masuk) }}" width='50'
                                                    height='50' class="img img-responsive" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label>Ditambahkan Pada:</label>
                                            <p>{{ \Carbon\Carbon::parse($inlogistic->created_at)->translatedFormat('l, d F Y') }}
                                            </p>
                                        </div>
                                        <div class="col mb-3">
                                            <label>Diperbarui Pada:</label>
                                            <p>{{ \Carbon\Carbon::parse($inlogistic->updated_at)->translatedFormat('l, d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th class="text-center">Kode Logistik</th>
                                                            <th class="text-center">Nama Logistik</th>
                                                            <th class="text-center">Satuan</th>
                                                            <th class="text-center">Jumlah</th>
                                                            <th class="text-center">Tanggal Masuk</th>
                                                            <th class="text-center">Tanggal Kadaluarsa</th>
                                                            <th class="text-center">Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                        use Carbon\Carbon;
                                                    @endphp
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">
                                                                {{ $inlogistic->logistic->kode_logistik }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $inlogistic->logistic->nama_logistik }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $inlogistic->logistic->satuan_logistik }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $inlogistic->jumlah_logistik_masuk }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ Carbon::parse($inlogistic->tanggal_masuk)->translatedFormat('l, d F Y') }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ Carbon::parse($inlogistic->expayer_logistik)->translatedFormat('l, d F Y') }}
                                                            </td>
                                                            <td class="text-center">{{ $inlogistic->keterangan_masuk }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Warehouse BPBD<div class="bullet"></div> Kabupaten Jember
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>



    <script src="{{ asset('tdashboard') }}/assets/modules/jquery.min.js"></script>
    <script src="{{ asset('tdashboard') }}/assets/modules/popper.js"></script>
    <script src="{{ asset('tdashboard') }}/assets/modules/tooltip.js"></script>
    <script src="{{ asset('tdashboard') }}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('tdashboard') }}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('tdashboard') }}/assets/modules/moment.min.js"></script>
    <script src="{{ asset('tdashboard') }}/assets/js/stisla.js"></script>

    <script src="{{ asset('tdashboard') }}/assets/js/scripts.js"></script>
    <script src="{{ asset('tdashboard') }}/assets/js/custom.js"></script>

    <script>
        function performSearch() {
            const searchQuery = document.getElementById('search-input').value.toLowerCase();
            const tableRows = document.querySelectorAll('table tbody tr');
            tableRows.forEach(row => {
                const rowData = row.innerText.toLowerCase();
                if (rowData.includes(searchQuery)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        document.getElementById('search-input').addEventListener('input', performSearch);
    </script>

</body>

</html>