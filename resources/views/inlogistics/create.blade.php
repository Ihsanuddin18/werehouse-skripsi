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
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                        <input id="search-input" class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                        <button class="btn" type="button" onclick="performSearch()"><i class="fas fa-search"></i></button>
                    </div>
                    <div id="clock" style="color: white; margin-left: 15px;"></div>
                </form>
                <script>
                    function updateClock() {
                        var now = new Date();
                        var hours = now.getHours();
                        var minutes = now.getMinutes();
                        var seconds = now.getSeconds();
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
                        clockElement.innerHTML = dayName + ", " + day + " " + monthName + " " + year + "<br>" + hours + " : " + minutes + " : " + seconds + "  WIB";
                        setTimeout(updateClock, 1000);
                    }
                    updateClock();
                </script>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('tdashboard') }}/assets/img/avatar/logobpbd1.png" class="rounded-circle mr-1">
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
                                    <i class="fas fa-door-open" style="display: block; margin-top: 8px;"></i>Keluar
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <img alt="image" src="{{ asset('tdashboard') }}/assets/img/avatar/logobpbd1.png" style="width: 143px; height: auto; margin-top: 20px;">
                        <a href="{{ route('home') }}"> Warehouse BPBD </a>
                        <hr style="margin-top: 3px; margin-bottom: 3px; border: none; border-bottom: 0.1px solid #C1C1C1; width: 80%;">
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
                            <a href="{{ route('logistics') }}"><i class="fas fa-database"></i> <span>Data Logistik</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('suppliers') }}"><i class="fas fa-table"></i> <span>Data Supplier</span></a>
                        </li>
                        <li class="menu-header">Aktivitas</li>
                        <li class="active">
                            <a href="{{ route('inlogistics')}}" class="nav-link"><i class="fas fa-sign-in-alt"></i> <span>Logistik Masuk</span></a>
                        </li>
                        <li>
                            <a href="{{ route('outlogistics')}}" class="nav-link"><i class="fas fa-sign-out-alt"></i> <span>Logistik Keluar</span></a>
                        </li>
                        <li>
                            <a href="{{ route('logisticrequests')}}" class="nav-link"><i class="fas fa-chart-line"></i> <span>Rekomendasi Stok</span></a>
                        </li>
                        <li class="menu-header">Pengaturan</li>
                        <li>
                            <a href="{{ route('profile.edit')}}" class="nav-link"><i class="fas fa-user"></i> <span>Profil</span></a>
                        </li>
                        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-primary btn-lg btn-block btn-icon-split" type="submit">
                                    <i class="fas fa-door-open"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Tambah Logistik Masuk</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                            <div class="breadcrumb-item active"><a href="{{ route('inlogistics') }}">Data Logistik Masuk</a></div>
                            <div class="breadcrumb-item">Tambah Logistik Masuk</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            {{-- Form Input (tidak di-submit langsung, hanya sebagai input UI) --}}
                            <div id="inputSection">
                                <div class="form-row" style="position: relative; padding-top: 50px;">

                                    {{-- Tombol Kembali --}}
                                    <div style="position: absolute; top: 0; right: 0;">
                                        <a href="{{ route('inlogistics') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                    </div>

                                    {{-- Tanggal Masuk --}}
                                    <div class="form-group col-md-3">
                                        <label for="tanggal_masuk" style="font-size: larger;">Tanggal Masuk Logistik</label>
                                        <input type="date" class="form-control" id="tanggal_masuk" placeholder="*Tanggal Masuk">
                                    </div>

                                    {{-- Supplier --}}
                                    <div class="col-md-12">
                                        <h4 style="color: blue;">Data Supplier</h4>
                                    </div>

                                    @if(isset($suppliers))
                                    <div class="form-group col-md-12">
                                        <label for="id_supplier">Nama Supplier</label>
                                        <select class="form-control" id="id_supplier">
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
                                        <label>Kode Supplier</label>
                                        <input type="text" class="form-control" id="kode_supplier" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Instansi Supplier</label>
                                        <input type="text" class="form-control" id="instansi_supplier" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Email Supplier</label>
                                        <input type="text" class="form-control" id="email_supplier" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Telepon Supplier</label>
                                        <input type="text" class="form-control" id="telepon_supplier" disabled readonly>
                                    </div>

                                    {{-- Logistik --}}
                                    <div class="col-md-12">
                                        <h4 style="color: blue;">Data Logistik</h4>
                                    </div>

                                    @if(isset($logistics))
                                    <div class="form-group col-md-12">
                                        <label for="id_logistik">Nama Logistik</label>
                                        <select class="form-control" id="id_logistik">
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
                                        <label>Kode Logistik</label>
                                        <input type="text" class="form-control" id="kode_logistik" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Jumlah</label>
                                        <input type="number" class="form-control" id="jumlah_logistik_masuk" placeholder="*Masukkan Jumlah" min="1">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Satuan Logistik</label>
                                        <input type="text" class="form-control" id="satuan_logistik" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Tanggal Kadaluarsa</label>
                                        <input type="date" class="form-control" id="expayer_logistik">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan_masuk" placeholder="*Masukkan Keterangan">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Dokumentasi Masuk</label>
                                        <input type="file" class="form-control" id="dokumentasi_masuk">
                                    </div>
                                </div>

                                <div style="text-align: right; margin-bottom: 20px;">
                                    <button type="button" id="addLogistic" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Tambah ke Daftar
                                    </button>
                                </div>
                            </div>

                            {{-- Tabel Preview --}}
                            <div class="mt-2">
                                <h3>Detail Logistik Masuk <span id="rowCount" class="badge badge-primary">0</span></h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="logisticTable">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Logistik</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Supplier</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Tanggal Kadaluarsa</th>
                                                <th>Keterangan</th>
                                                <th>Dokumentasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="logisticTbody">
                                            <tr id="emptyRow">
                                                <td colspan="10" class="text-center text-muted">
                                                    <i class="fas fa-info-circle"></i> Belum ada data. Silakan isi form di atas lalu klik "Tambah ke Daftar".
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Form submit sesungguhnya --}}
                                <form id="submitForm" method="POST" action="{{ route('inlogistics.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div id="hiddenInputsContainer"></div>
                                    <div style="display: flex; justify-content: center; margin-top: 15px;">
                                        <button type="submit" id="saveLogistics" class="btn btn-primary btn-lg" disabled>
                                            <i class="fas fa-save"></i> Simpan Semua Logistik Masuk
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Warehouse BPBD<div class="bullet"></div> Kabupaten Jember
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
        document.addEventListener('DOMContentLoaded', function () {

            // ─── Elemen referensi ───────────────────────────────────────────
            const logisticSelect    = document.getElementById('id_logistik');
            const supplierSelect    = document.getElementById('id_supplier');
            const kodeLogistikInput = document.getElementById('kode_logistik');
            const satuanLogistikInput = document.getElementById('satuan_logistik');
            const kodeSupplierInput   = document.getElementById('kode_supplier');
            const instansiSupplierInput = document.getElementById('instansi_supplier');
            const emailSupplierInput    = document.getElementById('email_supplier');
            const teleponSupplierInput  = document.getElementById('telepon_supplier');

            const tbody           = document.getElementById('logisticTbody');
            const emptyRow        = document.getElementById('emptyRow');
            const rowCountBadge   = document.getElementById('rowCount');
            const saveBtn         = document.getElementById('saveLogistics');
            const hiddenContainer = document.getElementById('hiddenInputsContainer');

            // Array untuk menyimpan semua item yang sudah ditambahkan
            // Setiap item juga menyimpan File object untuk upload
            let items = [];
            let fileStore = {}; // key: index, value: File object

            // ─── Auto-fill Supplier ─────────────────────────────────────────
            supplierSelect.addEventListener('change', function () {
                const opt = this.options[this.selectedIndex];
                kodeSupplierInput.value    = opt.getAttribute('data-kode')    || '';
                instansiSupplierInput.value = opt.getAttribute('data-instansi') || '';
                emailSupplierInput.value   = opt.getAttribute('data-email')   || '';
                teleponSupplierInput.value = opt.getAttribute('data-telepon') || '';
            });

            // ─── Auto-fill Logistik ─────────────────────────────────────────
            logisticSelect.addEventListener('change', function () {
                const opt = this.options[this.selectedIndex];
                kodeLogistikInput.value   = opt.getAttribute('data-kode')    || '';
                satuanLogistikInput.value = opt.getAttribute('data-satuan')  || '';
            });

            // ─── Validasi form input ────────────────────────────────────────
            function validateInputForm() {
                const tanggal  = document.getElementById('tanggal_masuk').value;
                const supplier = supplierSelect.value;
                const logistik = logisticSelect.value;
                const jumlah   = document.getElementById('jumlah_logistik_masuk').value;
                const expayer  = document.getElementById('expayer_logistik').value;
                const ket      = document.getElementById('keterangan_masuk').value.trim();

                if (!tanggal || !supplier || !logistik || !jumlah || !expayer || !ket) {
                    alert('Semua kolom wajib diisi sebelum menambah ke daftar!');
                    return false;
                }
                if (parseInt(jumlah) <= 0) {
                    alert('Jumlah harus lebih dari 0!');
                    return false;
                }
                return true;
            }

            // ─── Render ulang tabel dari array items ────────────────────────
            function renderTable() {
                // Hapus semua baris kecuali emptyRow
                while (tbody.rows.length > 0) {
                    tbody.deleteRow(0);
                }

                if (items.length === 0) {
                    tbody.appendChild(emptyRow);
                    rowCountBadge.textContent = '0';
                    saveBtn.disabled = true;
                    return;
                }

                items.forEach(function (item, index) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${escapeHtml(item.logistikText)}</td>
                        <td>${escapeHtml(item.jumlah)}</td>
                        <td>${escapeHtml(item.satuan)}</td>
                        <td>${escapeHtml(item.supplierText)}</td>
                        <td>${escapeHtml(item.tanggalMasuk)}</td>
                        <td>${escapeHtml(item.tanggalKadaluarsa)}</td>
                        <td>${escapeHtml(item.keterangan)}</td>
                        <td>${item.dokumentasiNama ? '<span class="badge badge-info"><i class="fas fa-file"></i> ' + escapeHtml(item.dokumentasiNama) + '</span>' : '<span class="text-muted">-</span>'}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${index})">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });

                rowCountBadge.textContent = items.length;
                saveBtn.disabled = false;
                rebuildHiddenInputs();
            }

            // ─── Rebuild hidden inputs untuk form submit ────────────────────
            function rebuildHiddenInputs() {
                hiddenContainer.innerHTML = '';

                // Buat DataTransfer untuk mengelola file inputs
                items.forEach(function (item, index) {
                    appendHidden('id_logistik[]',            item.logistikId);
                    appendHidden('id_supplier[]',            item.supplierId);
                    appendHidden('jumlah_logistik_masuk[]',  item.jumlah);
                    appendHidden('satuan_logistik[]',        item.satuan);
                    appendHidden('tanggal_masuk[]',          item.tanggalMasuk);
                    appendHidden('expayer_logistik[]',       item.tanggalKadaluarsa);
                    appendHidden('keterangan_masuk[]',       item.keterangan);
                    // File ditangani via input file terpisah
                    if (fileStore[index]) {
                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = 'dokumentasi_masuk[]';
                        fileInput.style.display = 'none';
                        const dt = new DataTransfer();
                        dt.items.add(fileStore[index]);
                        fileInput.files = dt.files;
                        hiddenContainer.appendChild(fileInput);
                    } else {
                        appendHidden('dokumentasi_masuk[]', '');
                    }
                });
            }

            function appendHidden(name, value) {
                const input = document.createElement('input');
                input.type  = 'hidden';
                input.name  = name;
                input.value = value;
                hiddenContainer.appendChild(input);
            }

            // ─── Hapus item dari array ──────────────────────────────────────
            window.removeItem = function (index) {
                items.splice(index, 1);
                // Shift file keys
                const newFileStore = {};
                Object.keys(fileStore).forEach(function (k) {
                    const ki = parseInt(k);
                    if (ki < index) newFileStore[ki] = fileStore[ki];
                    else if (ki > index) newFileStore[ki - 1] = fileStore[ki];
                    // ki === index: file dihapus
                });
                fileStore = newFileStore;
                renderTable();
            };

            // ─── Tombol Tambah ke Daftar ────────────────────────────────────
            document.getElementById('addLogistic').addEventListener('click', function () {
                if (!validateInputForm()) return;

                const suppOpt = supplierSelect.options[supplierSelect.selectedIndex];
                const logOpt  = logisticSelect.options[logisticSelect.selectedIndex];
                const fileEl  = document.getElementById('dokumentasi_masuk');
                const file    = fileEl.files[0] || null;

                const item = {
                    logistikId:         logisticSelect.value,
                    logistikText:       logOpt.text,
                    supplierId:         supplierSelect.value,
                    supplierText:       suppOpt.text,
                    jumlah:             document.getElementById('jumlah_logistik_masuk').value,
                    satuan:             satuanLogistikInput.value,
                    tanggalMasuk:       document.getElementById('tanggal_masuk').value,
                    tanggalKadaluarsa:  document.getElementById('expayer_logistik').value,
                    keterangan:         document.getElementById('keterangan_masuk').value.trim(),
                    dokumentasiNama:    file ? file.name : '',
                };

                const itemIndex = items.length;
                items.push(item);
                if (file) fileStore[itemIndex] = file;

                renderTable();
                resetInputForm();
            });

            // ─── Reset form input (siap untuk entri berikutnya) ────────────
            function resetInputForm() {
                // Jangan reset tanggal_masuk agar tidak perlu isi ulang untuk batch
                supplierSelect.selectedIndex = 0;
                kodeSupplierInput.value    = '';
                instansiSupplierInput.value = '';
                emailSupplierInput.value   = '';
                teleponSupplierInput.value = '';

                logisticSelect.selectedIndex = 0;
                kodeLogistikInput.value   = '';
                satuanLogistikInput.value = '';

                document.getElementById('jumlah_logistik_masuk').value = '';
                document.getElementById('expayer_logistik').value      = '';
                document.getElementById('keterangan_masuk').value      = '';
                document.getElementById('dokumentasi_masuk').value     = '';
            }

            // ─── Helper escape HTML ─────────────────────────────────────────
            function escapeHtml(str) {
                if (!str) return '';
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;');
            }

            // ─── Validasi sebelum submit final ──────────────────────────────
            document.getElementById('submitForm').addEventListener('submit', function (e) {
                if (items.length === 0) {
                    e.preventDefault();
                    alert('Belum ada data logistik. Silakan tambahkan minimal 1 data terlebih dahulu.');
                }
            });

        }); // end DOMContentLoaded

        // ─── Search tabel ───────────────────────────────────────────────────
        function performSearch() {
            const searchQuery = document.getElementById('search-input').value.toLowerCase();
            const tableRows = document.querySelectorAll('table tbody tr');
            tableRows.forEach(row => {
                const rowData = row.innerText.toLowerCase();
                row.style.display = rowData.includes(searchQuery) ? '' : 'none';
            });
        }
        document.getElementById('search-input').addEventListener('input', performSearch);
    </script>
</body>
</html>