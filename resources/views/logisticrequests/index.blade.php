<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard &rsaquo; Rekomendasi Stok &mdash; Werehouse BPBD | Kabupaten Jember</title>

    <link rel="shortcut icon" href="{{ asset('landingpages') }}/assets/images/logo/logobpbd1.png" type="image/png" />

    <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/css/components.css">

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
     <style>
        /* Warna baris berdasarkan status */
        .row-aman {
            background-color: #e8f8f0 !important; /* hijau muda */
        }
        .row-warning {
            background-color: #fdeaea !important; /* merah muda */
        }

        /* Hover effect untuk kenyamanan visual */
        .table-hover tbody tr:hover {
            background-color: #f3f6f9 !important;
        }
    </style>

</head>

<body>
    <div id="app">
        <div="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
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
                            <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
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
                        <a href="{{ route('home') }}"> Werehouse BPBD </a>
                        <hr
                            style="margin-top: 3px; margin-bottom: 3px; border: none; border-bottom: 0.1px solid #C1C1C1; width: 80%;">
                        <p><br></p>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">WB</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a href="{{ route('home') }}"><i class="fas fa-home"></i><span>Dashboard</span></a>
                        </li>
                        <li class="menu-header">Master</li>
                        <li class="dropdown">
                            <a href="{{ route('logistics') }}"><i class="fas fa-database"></i> <span>Data
                                    Logistik</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('suppliers') }}"><i class="fas fa-table"></i> <span>Data
                                    Supplier</span></a>
                        </li>
                        <li class="menu-header">Aktivitas</li>
                        <li>
                            <a href="{{ route('inlogistics')}}" class="nav-link"><i class="fas fa-sign-in-alt"></i>
                                <span>Logistik Masuk</span></a>
                        </li>
                        <li>
                            <a href="{{ route('outlogistics')}}" class="nav-link"><i class="fas fa-sign-out-alt"></i>
                                <span>Logistik Keluar</span></a>
                        </li>
                        <li class=active>
                            <a href="{{ route('logisticrequests')}}" class="nav-link"><i class="fas fa-chart-line"></i>
                                <span>Rekomendasi Stok</span></a>
                        </li>
                        <li class="menu-header">Pengaturan</li>
                        <li>
                            <a href="{{ route('profile.edit')}}" class="nav-link"><i class="fas fa-user"></i>
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
                        <h1>Rekomendasi Stok </h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                            <div class="breadcrumb-item">Rekomendasi Stok </div>
                        </div>
                    </div>
                
                     <!-- Statistics Rekomendasi Stok -->
                      <!-- <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Statistics</h4>
                                    <div class="card-header-action">
                                        <a href="#" class="btn active">Week</a>
                                        <a href="#" class="btn">Month</a>
                                        <a href="#" class="btn">Year</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                  <canvas id="myChart2" height="90"></canvas>


                                    <div class="statistic-details mt-3">
                                        <div class="statistic-details-item">
                                            <div class="text-small text-muted">
                                                <span class="text-primary">
                                                    <i class="fas fa-caret-up"></i>
                                                </span> 7%
                                            </div>
                                            <div class="detail-value">$243</div>
                                            <div class="detail-name">Today</div>
                                        </div>
                                        <div class="statistic-details-item">
                                            <div class="text-small text-muted">
                                                <span class="text-danger">
                                                    <i class="fas fa-caret-down"></i>
                                                </span> 23%
                                            </div>
                                            <div class="detail-value">$2,902</div>
                                            <div class="detail-name">This Week</div>
                                        </div>
                                        <div class="statistic-details-item">
                                            <div class="text-small text-muted">
                                                <span class="text-primary">
                                                    <i class="fas fa-caret-up"></i>
                                                </span> 9%
                                            </div>
                                            <div class="detail-value">$12,821</div>
                                            <div class="detail-name">This Month</div>
                                        </div>
                                        <div class="statistic-details-item">
                                            <div class="text-small text-muted">
                                                <span class="text-primary">
                                                    <i class="fas fa-caret-up"></i>
                                                </span> 19%
                                            </div>
                                            <div class="detail-value">$92,142</div>
                                            <div class="detail-name">This Year</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- End Statistics rekomendasi -->
                    
                        <!-- Pilihan Halaman -->
                    <!-- <div class="btn-group">
                        <a href="" class="btn btn-outline-primary">Daftar Rekomendasi</a>
                        <a href="" class="btn btn-outline-primary">Statistics</a>

                    </div> -->

                    <!-- Filter & Export -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <form method="GET" action="{{ route('logisticrequests.index') }}" class="form-inline">
                            <label for="year" class="mr-2">Tahun:</label>
                            <select name="year" id="year" class="form-control mr-2">
                                @foreach(range($firstYear, date('Y') + 10) as $y)
                                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Generate</button>
                        </form>

                        <form method="GET" action="{{ route('export_logistic_request_pdf') }}">
                            <input type="hidden" name="year" value="{{ $tahun }}">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </button>
                        </form>
                    </div>
                    @if(Session::has('success'))
                        <script>
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: 'success',
                                title: '{{ Session::get('success') }}'
                            });
                        </script>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Daftar Rekomendasi Stok </h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th style="text-align: center;">No</th>
                                                <th style="text-align: center;">Nama Logistik</th>
                                                <th style="text-align: center;">Stok Saat Ini</th>
                                                <th style="text-align: center;">Rata-rata Penggunaan per Bulan</th>
                                                <th style="text-align: center;">Rekomendasi Kebutuhan Tahunan</th>
                                                <th style="text-align: center;">Status</th>
                                            </tr>
                                        </thead>
                                        @php
                                            use Carbon\Carbon;
                                        @endphp
                                        <tbody>
                                    @forelse($logisticrequests as $i => $item)
                                    <tr class="{{ $item['status'] == 'Aman' ? 'row-aman' : 'row-warning' }}">
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-center">{{ $item['nama_logistik'] }}</td>
                                        <td class="text-center">{{ $item['stok_saat_ini'] }}</td>
                                        <td class="text-center">{{ $item['rata_bulanan'] }}</td>
                                        <td class="text-center">{{ $item['rekomendasi_tahunan'] }}</td>
                                        <td class="text-center">
                                            @if($item['status'] == 'Aman')
                                                <span class="badge badge-success">Aman</span>
                                            @else
                                                <span class="badge badge-danger">Perlu Pengadaan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                                    <td colspan="9" class="text-center">Tidak ada data!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="container">
                                        <div class="row justify-content-end mt-2">
                                            <div class="col-auto">
                                                <span>Menampilkan total {{ count($logisticrequests) }} data hasil rekomendasi stok</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </div>

    <footer class="main-footer">
        <div class="footer-left">
            Werehouse BPBD<div class="bullet"></div> Kabupaten Jember
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/statistics.js') }}"></script>

   
</body>

</html>