<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Logistik Keluar &rsaquo; Edit logistik keluar &mdash; Warehouse BPBD | Kabupaten Jember</title>

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
                        <h1>Edit Logistik Keluar</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('staff.dashboard') }}">Dashboard</a></div>
                            <div class="breadcrumb-item active"><a href="{{ route('staff.outlogistics.index') }}">Logistik
                                    Keluar</a></div>
                            <div class="breadcrumb-item">Edit Logistik Keluar</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form id="logisticForm" action="{{ route('staff.outlogistics.update', $outlogistic->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id_logistik" value="{{ $outlogistic->id_logistik }}">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="tanggal_keluar" style="font-size: larger;">Tanggal Kejadian</label>
                                        <input type="date" class="form-control" name="tanggal_keluar"
                                            id="tanggal_keluar" placeholder="*Tanggal Keluar"
                                            value="{{ old('tanggal_keluar', $outlogistic->tanggal_keluar) }}" required>
                                    </div>
                                    <div style="position: absolute; top: 0; right: 0;">
                                        <a href="{{ route('staff.outlogistics.index') }}" class="btn btn-primary mx-2"
                                            style="background-color: silver !important; color: black !important;">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                    </div>
                                    <div class="col-md-12">
                                        <h4 style="color: blue;">Data Penerima</h4>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nama_penerima">Nama Penerima</label>
                                        <input type="text" class="form-control" name="nama_penerima" id="nama_penerima"
                                            placeholder="*Nama Penerima"
                                            value="{{ old('nama_penerima', $outlogistic->nama_penerima) }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nik_kk_penerima">NIK / KK</label>
                                        <input type="text" class="form-control" name="nik_kk_penerima"
                                            id="nik_kk_penerima" placeholder="*NIK/KK"
                                            value="{{ old('nik_kk_penerima', $outlogistic->nik_kk_penerima) }}"
                                            required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nomor_telepon">Nomor Telepon</label>
                                        <input type="text" class="form-control" name="nomor_telepon"
                                            id="nomor_telepon" placeholder="*Nomor telepon"
                                            value="{{ old('nomor_telepon', $outlogistic->nomor_telepon) }}"
                                            required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="alamat_penerima">Alamat Penerima</label>
                                        <input type="text" class="form-control" name="alamat_penerima"
                                            id="alamat_penerima" placeholder="*Alamat Penerima"
                                            value="{{ old('alamat_penerima', $outlogistic->alamat_penerima) }}"
                                            required>
                                    </div>
                                    <div class="col-md-12">
                                        <h4 style="color: blue;">Data Logistik</h4>
                                    </div>
                                    @if(isset($logistics))
                                        <div class="form-group col-md-12">
                                            <label for="id_logistik">Nama Logistik</label>
                                            <select class="form-control" name="id_logistik" id="id_logistik" disabled
                                                readonly>
                                                <option value="" selected disabled>*Pilih Nama Logistik</option>
                                                @foreach($logistics as $logistic)
                                                    <option value="{{ $logistic->id }}"
                                                        data-kode="{{ $logistic->kode_logistik }}"
                                                        data-satuan="{{ $logistic->satuan_logistik }}" {{ $logistic->id == $outlogistic->id_logistik ? 'selected' : '' }}>
                                                        {{ $logistic->nama_logistik }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-3">
                                        <label for="kode_logistik">Kode Logistik</label>
                                        <input type="text" class="form-control" name="kode_logistik" id="kode_logistik"
                                            value="{{ optional($outlogistic->logistic)->kode_logistik }}" disabled
                                            readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="jumlah_logistik_keluar">Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah_logistik_keluar"
                                            id="jumlah_logistik_keluar" placeholder="*Masukkan Jumlah"
                                            value="{{ old('jumlah_logistik_keluar', $outlogistic->jumlah_logistik_keluar) }}"
                                            required>
                                        @if($errors->has('jumlah_logistik_keluar'))
                                            <div class="text-danger">
                                                {{ $errors->first('jumlah_logistik_keluar') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="satuan_logistik">Satuan Logistik</label>
                                        <input type="text" class="form-control" name="satuan_logistik"
                                            id="satuan_logistik"
                                            value="{{ optional($outlogistic->logistic)->satuan_logistik }}" disabled
                                            readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="keterangan_keluar">Jenis Bencana</label>
                                        <input type="text" class="form-control" name="keterangan_keluar"
                                            id="keterangan_keluar" placeholder="*Masukkan Keterangan"
                                            value="{{ old('keterangan_keluar', $outlogistic->keterangan_keluar) }}"
                                            required>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label class="form-label">Dikeluarkan Pada</label>
                                            <input type="text" name="created_at" class="form-control"
                                                placeholder="Created At" value="{{ \Carbon\Carbon::parse($outlogistic->created_at)->translatedFormat('l, d F Y') }}" disabled
                                                readonly>
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('id_logistik').addEventListener('change', function () {
                                            var selectedOption = this.options[this.selectedIndex];
                                            document.getElementById('kode_logistik').value = selectedOption.getAttribute('data-kode');
                                            document.getElementById('satuan_logistik').value = selectedOption.getAttribute('data-satuan');
                                        });
                                    </script>
                                </div>
                                <div class="form-group col-md-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Perbarui Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>

            <script>
                document.getElementById('logisticForm').addEventListener('submit', function (event) {
                    const requiredFields = [
                        document.getElementById('tanggal_keluar'),
                        document.getElementById('nama_penerima'),
                        document.getElementById('nik_kk_penerima'),
                        document.getElementById('nomor_telepon'),
                        document.getElementById('alamat_penerima'),
                        document.getElementById('jumlah_logistik_keluar'),
                        document.getElementById('keterangan_keluar')
                    ];

                    for (let field of requiredFields) {
                        if (!field.value) {
                            alert('Semua kolom wajib diisi!');
                            event.preventDefault();
                            return;
                        }
                    }
                });
            </script>

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