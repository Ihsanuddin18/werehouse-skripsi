<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard &rsaquo; Data Logistik Keluar &mdash; Warehouse BPBD | Kabupaten Jember</title>

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
                        <li>
                            <a href="{{ route('staff.inlogistics.index')}}" class="nav-link"><i class="fas fa-sign-in-alt"></i>
                                <span>Logistik Masuk</span></a>
                        </li>
                        <li class=active>
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
                        <h1>Data Logistik Keluar</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('staff.dashboard') }}">Dashboard</a></div>
                            <div class="breadcrumb-item">Data Logistik Keluar</div>
                        </div>
                    </div>
                    <div class="button-container">
                        <div class="d-flex align-items-center justify-content-end">
                            <a href="{{ route('staff.outlogistics.create') }}" class="btn btn-primary mr-2">
                                <i class="fas fa-plus"></i> Logistik Keluar
                            </a>

                        </div>
                        <br>
                        <form method="GET" action="{{ route('staff.outlogistics.index') }}" class="form-inline">
                            <div class="form-group mb-2">
                                <label for="month" class="mr-2">Bulan:</label>
                                <select name="month" id="month" class="form-control mr-2">
                                    <option value="">Pilih Bulan</option>
                                    @foreach(range(1, 12) as $month)
                                        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                            {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$month - 1] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="year" class="mr-2">Tahun:</label>
                                <select name="year" id="year" class="form-control mr-2">
                                    <option value="">Pilih Tahun</option>
                                    @foreach(range($firstYear, date('Y')) as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Filter</button>
                        </form>
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
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Daftar Logistik Keluar</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="table-primary">
                                            <tr>
                                                <th style="text-align: center;">No</th>
                                                <th style="text-align: center;">Nama Logistik</th>
                                                <th style="text-align: center;">Jumlah</th>
                                                <th style="text-align: center;">Satuan</th>
                                                <th style="text-align: center;">Nama Penerima</th>
                                                <th style="text-align: center;">Alamat Penerima</th>
                                                <th style="text-align: center;">Jenis Bencana</th>
                                                <th style="text-align: center;">Dokumentasi</th>
                                                <th style="text-align: center;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($outlogistics->count() > 0)
                                                @foreach($outlogistics as $outlogistic)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ ($outlogistics->currentPage() - 1) * $outlogistics->perPage() + $loop->iteration }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ optional($outlogistic->logistic)->nama_logistik }}</td>
                                                        <td class="text-center">{{ $outlogistic->jumlah_logistik_keluar }}</td>
                                                        <td class="text-center">
                                                            {{ optional($outlogistic->logistic)->satuan_logistik }}</td>
                                                        <td class="text-center">{{ $outlogistic->nama_penerima }}</td>
                                                        <td class="text-center">{{ $outlogistic->alamat_penerima }}</td>
                                                        <td class="text-center">{{ $outlogistic->keterangan_keluar }}</td>
                                                        <td class="text-center">
                                                            <img src="{{ asset($outlogistic->dokumentasi_keluar) }}" width='50'
                                                                height='50' class="img img-responsive" />
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-flex justify-content-center" role="group"
                                                                aria-label="Basic example">
                                                                <a href="{{ route('staff.outlogistics.show', $outlogistic->id) }}"
                                                                    class="btn btn-success mr-2" title="Detail">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('staff.outlogistics.edit', $outlogistic->id)}}"
                                                                    class="btn btn-warning mr-2" title="Edit">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('staff.outlogistics.destroy', $outlogistic->id) }}"
                                                                    method="POST" class="p-0"
                                                                    onsubmit="return confirm('Delete?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger" title="Delete">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="9" class="text-center">Tidak ada data!</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="container">
                                        <div class="row justify-content-end">
                                            <div class="col-auto">
                                                {{ $outlogistics->links() }}
                                            </div>
                                        </div>
                                        <div class="row justify-content-end mt-2">
                                            <div class="col-auto">
                                                <span> Halaman {{ $outlogistics->currentPage() }} dari
                                                    {{ $outlogistics->lastPage() }} halaman </span>
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