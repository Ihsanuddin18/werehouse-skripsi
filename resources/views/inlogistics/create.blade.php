<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Logistik Masuk &rsaquo; Tambah logistik masuk &mdash; Warehouse BPBD | Kabupaten Jember</title>

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
                        <a href="{{ route('home') }}"> Warehouse BPBD </a>
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
                        <li class=active>
                            <a href="{{ route('inlogistics')}}" class="nav-link"><i class="fas fa-sign-in-alt"></i>
                                <span>Logistik Masuk</span></a>
                        </li>
                        <li>
                            <a href="{{ route('outlogistics')}}" class="nav-link"><i class="fas fa-sign-out-alt"></i>
                                <span>Logistik Keluar</span></a>
                        </li>
                        <li>
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
                        <h1>Tambah logistik masuk</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                            <div class="breadcrumb-item active"><a href="{{ route('inlogistics') }}">Data Logistik Masuk</a>
                            </div>
                            <div class="breadcrumb-item">Tambah logistik masuk</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form id="logisticForm">
                                @csrf
                                <div class="form-row">
                                    <div class="form-container"
                                        style="position: relative; width: 100%; padding-top: 60px;">
                                        <div class="form-group col-md-3">
                                            <label for="tanggal_masuk" style="font-size: larger;">Tanggal Masuk
                                                Logistik</label>
                                            <input type="date" class="form-control" name="tanggal_masuk"
                                                id="tanggal_masuk" placeholder="*Tanggal Masuk" required>
                                        </div>
                                        <div style="position: absolute; top: 0; right: 0;">
                                            <a href="{{ route('inlogistics') }}" class="btn btn-primary mx-2"
                                                style="background-color: silver !important; color: black !important;">
                                                <i class="fas fa-arrow-left"></i> Kembali
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h4 style="color: blue;">Data Supplier</h4>
                                    </div>
                                    @if(isset($suppliers))
                                        <div class="form-group col-md-12">
                                            <label for="id_supplier">Nama Supplier</label>
                                            <select class="form-control" name="id_supplier" id="id_supplier" required>
                                                <option value="" selected disabled>*Pilih Nama Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}"
                                                        data-kode="{{ $supplier->kode_supplier }}"
                                                        data-instansi="{{ $supplier->instansi_supplier }}"
                                                        data-email="{{ $supplier->email_supplier }}"
                                                        data-telepon="{{ $supplier->telepon_supplier }}">
                                                        {{ $supplier->nama_supplier }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-3">
                                        <label for="kode_supplier">Kode Supplier</label>
                                        <input type="text" class="form-control" name="kode_supplier" id="kode_supplier"
                                            disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="instansi_supplier">Instansi Supplier</label>
                                        <input type="text" class="form-control" name="instansi_supplier"
                                            id="instansi_supplier" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="email_supplier">Email Supplier</label>
                                        <input type="text" class="form-control" name="email_supplier"
                                            id="email_supplier" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="telepon_supplier">Telepon Supplier</label>
                                        <input type="text" class="form-control" name="telepon_supplier"
                                            id="telepon_supplier" disabled readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <h4 style="color: blue;">Data Logistik</h4>
                                    </div>
                                    @if(isset($logistics))
                                        <div class="form-group col-md-12">
                                            <label for="id_logistik">Nama Logistik</label>
                                            <select class="form-control" name="id_logistik" id="id_logistik" required>
                                                <option value="" selected disabled>*Pilih Nama Logistik</option>
                                                @foreach($logistics as $logistic)
                                                    <option value="{{ $logistic->id }}"
                                                        data-kode="{{ $logistic->kode_logistik }}"
                                                        data-satuan="{{ $logistic->satuan_logistik }}">
                                                        {{ $logistic->nama_logistik }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-3">
                                        <label for="kode_logistik">Kode Logistik</label>
                                        <input type="text" class="form-control" name="kode_logistik" id="kode_logistik"
                                            disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="jumlah_logistik_masuk">Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah_logistik_masuk"
                                            id="jumlah_logistik_masuk" placeholder="*Masukkan Jumlah" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="satuan_logistik">Satuan Logistik</label>
                                        <input type="text" class="form-control" name="satuan_logistik"
                                            id="satuan_logistik" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="expayer_logistik">Tanggal Kadaluarsa</label>
                                        <input type="date" class="form-control" name="expayer_logistik"
                                            id="expayer_logistik" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="keterangan_masuk">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan_masuk"
                                            id="keterangan_masuk" placeholder="*Masukkan Keterangan" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="dokumentasi_masuk">Dokumentasi Masuk</label>
                                        <input type="file" class="form-control" name="dokumentasi_masuk"
                                            id="dokumentasi_masuk" placeholder="*Masukan dokumentasi">
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <button type="button" id="addLogistic" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Lihat Detail
                                    </button>
                                </div>
                            </form>
                            <div class="mt-4">
                                <h3>Detail logistik masuk</h3>
                                <table class="table table-striped" id="logisticTable">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Logistik</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Supplier</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Kadaluarsa</th>
                                            <th>Dokumentasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div style="display: flex; justify-content: center;">
                                    <button type="button" id="saveLogistics" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Tambah Logistik Masuk
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const logisticSelect = document.getElementById('id_logistik');
                    const kodeLogistikInput = document.getElementById('kode_logistik');
                    const satuanLogistikInput = document.getElementById('satuan_logistik');

                    const supplierSelect = document.getElementById('id_supplier');
                    const kodeSupplierInput = document.getElementById('kode_supplier');
                    const instansiSupplierInput = document.getElementById('instansi_supplier');
                    const emailSupplierInput = document.getElementById('email_supplier');
                    const teleponSupplierInput = document.getElementById('telepon_supplier');

                    const addLogisticButton = document.getElementById('addLogistic');
                    const logisticTable = document.getElementById('logisticTable').getElementsByTagName('tbody')[0];

                    function updateLogisticDetails() {
                        const selectedOption = logisticSelect.options[logisticSelect.selectedIndex];
                        const kodeLogistik = selectedOption.getAttribute('data-kode');
                        const satuanLogistik = selectedOption.getAttribute('data-satuan');

                        kodeLogistikInput.value = kodeLogistik;
                        satuanLogistikInput.value = satuanLogistik;
                    }

                    function updateSupplierDetails() {
                        const selectedOption = supplierSelect.options[supplierSelect.selectedIndex];
                        const kodeSupplier = selectedOption.getAttribute('data-kode');
                        const instansiSupplier = selectedOption.getAttribute('data-instansi');
                        const emailSupplier = selectedOption.getAttribute('data-email');
                        const teleponSupplier = selectedOption.getAttribute('data-telepon');

                        kodeSupplierInput.value = kodeSupplier;
                        instansiSupplierInput.value = instansiSupplier;
                        emailSupplierInput.value = emailSupplier;
                        teleponSupplierInput.value = teleponSupplier;
                    }

                    function validateForm() {
                        const requiredFields = [
                            document.getElementById('tanggal_masuk'),
                            supplierSelect,
                            logisticSelect,
                            document.getElementById('jumlah_logistik_masuk'),
                            document.getElementById('expayer_logistik'),
                            document.getElementById('keterangan_masuk')
                        ];

                        for (let field of requiredFields) {
                            if (!field.value) {
                                alert('Semua kolom wajib diisi!');
                                return false;
                            }
                        }

                        return true;
                    }

                    function addRemoveButtonHandler(button) {
                        button.addEventListener('click', function () {
                            this.closest('tr').remove();
                            addLogisticButton.disabled = false; // Re-enable the button when a row is removed
                        });
                    }

                    logisticSelect.addEventListener('change', updateLogisticDetails);
                    supplierSelect.addEventListener('change', updateSupplierDetails);

                    addLogisticButton.addEventListener('click', function () {
                        if (!validateForm()) {
                            return;
                        }

                        const tanggalMasuk = document.getElementById('tanggal_masuk').value;
                        const supplierText = supplierSelect.options[supplierSelect.selectedIndex].text;
                        const logisticText = logisticSelect.options[logisticSelect.selectedIndex].text;
                        const jumlah = document.getElementById('jumlah_logistik_masuk').value;
                        const satuan = satuanLogistikInput.value;
                        const tanggalKadaluarsa = document.getElementById('expayer_logistik').value;
                        const dokumentasi = document.getElementById('dokumentasi_masuk').files[0] ? document.getElementById('dokumentasi_masuk').files[0].name : '';

                        const newRow = logisticTable.insertRow();
                        const cell1 = newRow.insertCell(0);
                        const cell2 = newRow.insertCell(1);
                        const cell3 = newRow.insertCell(2);
                        const cell4 = newRow.insertCell(3);
                        const cell5 = newRow.insertCell(4);
                        const cell6 = newRow.insertCell(5);
                        const cell7 = newRow.insertCell(6);
                        const cell8 = newRow.insertCell(7);
                        const cell9 = newRow.insertCell(8);

                        cell1.innerHTML = logisticTable.rows.length;
                        cell2.innerHTML = logisticText + `<input type="hidden" name="id_logistik[]" value="${logisticSelect.value}">`;
                        cell3.innerHTML = jumlah + `<input type="hidden" name="jumlah_logistik_masuk[]" value="${jumlah}">`;
                        cell4.innerHTML = satuan + `<input type="hidden" name="satuan_logistik[]" value="${satuan}">`;
                        cell5.innerHTML = supplierText + `<input type="hidden" name="id_supplier[]" value="${supplierSelect.value}">`;
                        cell6.innerHTML = tanggalMasuk + `<input type="hidden" name="tanggal_masuk[]" value="${tanggalMasuk}">`;
                        cell7.innerHTML = tanggalKadaluarsa + `<input type="hidden" name="expayer_logistik[]" value="${tanggalKadaluarsa}">`;
                        cell8.innerHTML = dokumentasi + `<input type="hidden" name="dokumentasi_masuk[]" value="${dokumentasi}">`;
                        cell9.innerHTML = '<button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button>';

                        document.querySelectorAll('.remove-row').forEach(button => {
                            addRemoveButtonHandler(button);
                        });
                        addLogisticButton.disabled = true; // Disable the button after adding a row
                    });

                    document.getElementById('saveLogistics').addEventListener('click', function () {
                        if (!validateForm()) {
                            return;
                        }
                        const logisticForm = document.getElementById('logisticForm');
                        logisticForm.action = "{{ route('inlogistics.store') }}";
                        logisticForm.method = 'POST';
                        logisticForm.enctype = 'multipart/form-data'; // Menambahkan atribut enctype
                        logisticForm.submit();
                    });

                    document.getElementById('logisticForm').addEventListener('submit', function (event) {
                        if (!validateForm()) {
                            event.preventDefault();
                        }
                    });
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

</html