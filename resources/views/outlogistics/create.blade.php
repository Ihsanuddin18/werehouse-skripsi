<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Logistik Keluar &rsaquo; Tambah logistik keluar &mdash; Warehouse BPBD | Kabupaten Jember</title>

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
                        var hours = now.getHours(), minutes = now.getMinutes(), seconds = now.getSeconds();
                        var days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                        var months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        var dayName = days[now.getDay()], day = now.getDate(), monthName = months[now.getMonth()], year = now.getFullYear();
                        hours   = (hours   < 10) ? "0" + hours   : hours;
                        minutes = (minutes < 10) ? "0" + minutes : minutes;
                        seconds = (seconds < 10) ? "0" + seconds : seconds;
                        day     = (day     < 10) ? "0" + day     : day;
                        document.getElementById('clock').innerHTML =
                            dayName + ", " + day + " " + monthName + " " + year + "<br>" +
                            hours + " : " + minutes + " : " + seconds + "  WIB";
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
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                        <li class="menu-header">Master</li>
                        <li class="dropdown"><a href="{{ route('logistics') }}"><i class="fas fa-database"></i> <span>Data Logistik</span></a></li>
                        <li class="dropdown"><a href="{{ route('suppliers') }}"><i class="fas fa-table"></i> <span>Data Supplier</span></a></li>
                        <li class="menu-header">Aktivitas</li>
                        <li><a href="{{ route('inlogistics')}}" class="nav-link"><i class="fas fa-sign-in-alt"></i> <span>Logistik Masuk</span></a></li>
                        <li class="active"><a href="{{ route('outlogistics')}}" class="nav-link"><i class="fas fa-sign-out-alt"></i> <span>Logistik Keluar</span></a></li>
                        <li><a href="{{ route('logisticrequests')}}" class="nav-link"><i class="fas fa-chart-line"></i> <span>Rekomendasi Stok</span></a></li>
                        <li class="menu-header">Pengaturan</li>
                        <li><a href="{{ route('profile.edit')}}" class="nav-link"><i class="fas fa-user"></i> <span>Profil</span></a></li>
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
                        <h1>Tambah Logistik Keluar</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                            <div class="breadcrumb-item active"><a href="{{ route('outlogistics') }}">Data Logistik Keluar</a></div>
                            <div class="breadcrumb-item">Tambah Logistik Keluar</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            {{-- Form Input UI (tidak di-submit langsung) --}}
                            <div id="inputSection">
                                <div class="form-row" style="position: relative; padding-top: 50px;">

                                    {{-- Tombol Kembali --}}
                                    <div style="position: absolute; top: 0; right: 0;">
                                        <a href="{{ route('outlogistics') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                    </div>

                                    {{-- Tanggal Kejadian --}}
                                    <div class="form-group col-md-3">
                                        <label for="tanggal_keluar">Tanggal Kejadian</label>
                                        <input type="date" class="form-control" id="tanggal_keluar">
                                    </div>

                                    {{-- Data Penerima --}}
                                    <div class="col-md-12">
                                        <h4 style="color: blue;">Data Penerima</h4>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nama_penerima">Nama Penerima</label>
                                        <input type="text" class="form-control" id="nama_penerima" placeholder="*Nama Penerima">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nik_kk_penerima">NIK / KK</label>
                                        <input type="text" class="form-control" id="nik_kk_penerima" placeholder="*NIK/KK">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nomor_telepon">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="nomor_telepon" placeholder="*Nomor Telepon">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="alamat_penerima">Alamat Penerima</label>
                                        <input type="text" class="form-control" id="alamat_penerima" placeholder="*Alamat Penerima">
                                    </div>

                                    {{-- Data Logistik --}}
                                    <div class="col-md-12">
                                        <h4 style="color: blue;">Data Logistik</h4>
                                    </div>

                                    @if(isset($logistics))
                                    <div class="form-group col-md-12">
                                        <label for="id_logistik">Nama Logistik</label>
                                        <select class="form-control" id="id_logistik">
                                            <option value="" selected disabled>*Pilih Nama Logistik</option>
                                            @foreach($logistics as $logistic)
                                                {{-- Stok tersedia = total masuk - total keluar --}}
                                                @php
                                                    $totalMasuk  = $logistic->inlogistics->sum('jumlah_logistik_masuk');
                                                    $totalKeluar = $logistic->outlogistics->sum('jumlah_logistik_keluar') ?? 0;
                                                    $stokAktual  = max(0, $totalMasuk - $totalKeluar);
                                                @endphp
                                                <option value="{{ $logistic->id }}"
                                                    data-kode="{{ $logistic->kode_logistik }}"
                                                    data-satuan="{{ $logistic->satuan_logistik }}"
                                                    data-stok="{{ $stokAktual }}">
                                                    {{ $logistic->nama_logistik }} (Stok: {{ $stokAktual }} {{ $logistic->satuan_logistik }})
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
                                        <input type="number" class="form-control" id="jumlah_logistik_keluar" placeholder="*Masukkan Jumlah" min="1">
                                        <small id="jumlah_tidak_cukup" class="form-text text-danger" style="display:none;">
                                            <i class="fas fa-exclamation-triangle"></i> Jumlah melebihi stok tersedia!
                                        </small>
                                        <small id="stok_info" class="form-text text-info"></small>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Satuan Logistik</label>
                                        <input type="text" class="form-control" id="satuan_logistik" disabled readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Jenis Bencana</label>
                                        <select class="form-control" id="keterangan_keluar">
                                            <option value="" selected disabled>*Pilih Jenis Bencana</option>
                                            <option value="Banjir">Banjir</option>
                                            <option value="Banjir Bandang">Banjir Bandang</option>
                                            <option value="Tanah Longsor">Tanah Longsor</option>
                                            <option value="Gempa Bumi">Gempa Bumi</option>
                                            <option value="Tsunami">Tsunami</option>
                                            <option value="Letusan Gunung Api">Letusan Gunung Api</option>
                                            <option value="Angin Puting Beliung">Angin Puting Beliung</option>
                                            <option value="Kekeringan">Kekeringan</option>
                                            <option value="Gelombang Pasang / Abrasi">Gelombang Pasang / Abrasi</option>
                                            <option value="Kebakaran Hutan dan Lahan">Kebakaran Hutan dan Lahan</option>
                                            <option value="Kebakaran Permukiman">Kebakaran Permukiman</option>
                                            <option value="Cuaca Ekstrem">Cuaca Ekstrem</option>
                                            <option value="Tanah Bergerak">Tanah Bergerak</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Dokumentasi Keluar</label>
                                        <input type="file" class="form-control" id="dokumentasi_keluar" accept="image/png,image/jpg,image/jpeg,image/webp">
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
                                <h3>Detail Logistik Keluar <span id="rowCount" class="badge badge-primary">0</span></h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="logisticTable">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Logistik</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Nama Penerima</th>
                                                <th>NIK / KK</th>
                                                <th>No. Telepon</th>
                                                <th>Alamat</th>
                                                <th>Tgl Keluar</th>
                                                <th>Bencana</th>
                                                <th>Dokumentasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="logisticTbody">
                                            <tr id="emptyRow">
                                                <td colspan="12" class="text-center text-muted">
                                                    <i class="fas fa-info-circle"></i> Belum ada data. Silakan isi form di atas lalu klik "Tambah ke Daftar".
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Form submit sesungguhnya --}}
                                <form id="submitForm" method="POST" action="{{ route('outlogistics.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div id="hiddenInputsContainer"></div>
                                    <div style="display: flex; justify-content: center; margin-top: 15px;">
                                        <button type="submit" id="saveLogistics" class="btn btn-primary btn-lg" disabled>
                                            <i class="fas fa-save"></i> Simpan Semua Logistik Keluar
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

        // ─── Referensi elemen ────────────────────────────────────────────
        const logisticSelect   = document.getElementById('id_logistik');
        const kodeLogistikInput = document.getElementById('kode_logistik');
        const satuanLogistikInput = document.getElementById('satuan_logistik');
        const jumlahInput      = document.getElementById('jumlah_logistik_keluar');
        const jumlahError      = document.getElementById('jumlah_tidak_cukup');
        const stokInfo         = document.getElementById('stok_info');

        const tbody           = document.getElementById('logisticTbody');
        const emptyRow        = document.getElementById('emptyRow');
        const rowCountBadge   = document.getElementById('rowCount');
        const saveBtn         = document.getElementById('saveLogistics');
        const hiddenContainer = document.getElementById('hiddenInputsContainer');

        // items[] menyimpan semua baris yang sudah ditambahkan
        // stokSementara{} melacak pengurangan stok per logistik (di sesi ini)
        let items = [];
        let fileStore = {};
        let stokSementara = {}; // { id_logistik: jumlah_sudah_dipakai_di_sesi_ini }

        // ─── Auto-fill saat pilih logistik ──────────────────────────────
        logisticSelect.addEventListener('change', function () {
            const opt = this.options[this.selectedIndex];
            kodeLogistikInput.value   = opt.getAttribute('data-kode')   || '';
            satuanLogistikInput.value = opt.getAttribute('data-satuan') || '';
            validateJumlah();
            updateStokInfo();
        });

        // ─── Validasi jumlah realtime ────────────────────────────────────
        jumlahInput.addEventListener('input', function () {
            validateJumlah();
        });

        function getStokTersedia() {
            if (!logisticSelect.value) return 0;
            const opt   = logisticSelect.options[logisticSelect.selectedIndex];
            const stokDB = parseInt(opt.getAttribute('data-stok')) || 0;
            const sudahDipakai = stokSementara[logisticSelect.value] || 0;
            return stokDB - sudahDipakai;
        }

        function updateStokInfo() {
            if (!logisticSelect.value) {
                stokInfo.textContent = '';
                return;
            }
            const stok   = getStokTersedia();
            const satuan = satuanLogistikInput.value;
            stokInfo.textContent = 'Stok tersedia: ' + stok + ' ' + satuan;
        }

        function validateJumlah() {
            const jumlah = parseInt(jumlahInput.value);
            const stok   = getStokTersedia();

            if (!jumlahInput.value || isNaN(jumlah) || jumlah <= 0 || jumlah > stok) {
                jumlahError.style.display = 'block';
                jumlahError.textContent = jumlah > stok
                    ? '⚠ Jumlah melebihi stok tersedia (' + stok + ')!'
                    : '⚠ Masukkan jumlah yang valid!';
                return false;
            }
            jumlahError.style.display = 'none';
            return true;
        }

        // ─── Validasi seluruh form ───────────────────────────────────────
        function validateForm() {
            const fields = {
                'Tanggal Keluar'  : document.getElementById('tanggal_keluar').value,
                'Nama Penerima'   : document.getElementById('nama_penerima').value.trim(),
                'NIK / KK'        : document.getElementById('nik_kk_penerima').value.trim(),
                'Nomor Telepon'   : document.getElementById('nomor_telepon').value.trim(),
                'Alamat Penerima' : document.getElementById('alamat_penerima').value.trim(),
                'Logistik'        : logisticSelect.value,
                'Jenis Bencana'   : document.getElementById('keterangan_keluar').value,
            };

            for (const [label, val] of Object.entries(fields)) {
                if (!val) {
                    alert('Kolom "' + label + '" wajib diisi!');
                    return false;
                }
            }

            if (!jumlahInput.value || parseInt(jumlahInput.value) <= 0) {
                alert('Jumlah harus lebih dari 0!');
                return false;
            }

            if (!validateJumlah()) return false;

            return true;
        }

        // ─── Render ulang tabel dari array items ─────────────────────────
        function renderTable() {
            while (tbody.rows.length > 0) tbody.deleteRow(0);

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
                    <td>${esc(item.logistikText)}</td>
                    <td>${esc(item.jumlah)}</td>
                    <td>${esc(item.satuan)}</td>
                    <td>${esc(item.namaPenerima)}</td>
                    <td>${esc(item.nikKk)}</td>
                    <td>${esc(item.telepon)}</td>
                    <td>${esc(item.alamat)}</td>
                    <td>${esc(item.tanggalKeluar)}</td>
                    <td>${esc(item.keterangan)}</td>
                    <td>${item.dokNama ? '<span class="badge badge-info"><i class="fas fa-file"></i> ' + esc(item.dokNama) + '</span>' : '<span class="text-muted">-</span>'}</td>
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

        // ─── Rebuild hidden inputs untuk form submit ─────────────────────
        function rebuildHiddenInputs() {
            hiddenContainer.innerHTML = '';
            items.forEach(function (item, index) {
                addHidden('id_logistik[]',           item.logistikId);
                addHidden('jumlah_logistik_keluar[]', item.jumlah);
                addHidden('tanggal_keluar[]',         item.tanggalKeluar);
                addHidden('nama_penerima[]',          item.namaPenerima);
                addHidden('nik_kk_penerima[]',        item.nikKk);
                addHidden('nomor_telepon[]',          item.telepon);
                addHidden('alamat_penerima[]',        item.alamat);
                addHidden('keterangan_keluar[]',      item.keterangan);

                if (fileStore[index]) {
                    const fi = document.createElement('input');
                    fi.type = 'file';
                    fi.name = 'dokumentasi_keluar[]';
                    fi.style.display = 'none';
                    const dt = new DataTransfer();
                    dt.items.add(fileStore[index]);
                    fi.files = dt.files;
                    hiddenContainer.appendChild(fi);
                } else {
                    addHidden('dokumentasi_keluar[]', '');
                }
            });
        }

        function addHidden(name, value) {
            const inp = document.createElement('input');
            inp.type  = 'hidden';
            inp.name  = name;
            inp.value = value || '';
            hiddenContainer.appendChild(inp);
        }

        // ─── Hapus item ──────────────────────────────────────────────────
        window.removeItem = function (index) {
            const removed = items[index];

            // Kembalikan stok sementara
            if (stokSementara[removed.logistikId]) {
                stokSementara[removed.logistikId] -= parseInt(removed.jumlah);
                if (stokSementara[removed.logistikId] < 0)
                    stokSementara[removed.logistikId] = 0;
            }

            items.splice(index, 1);

            // Shift file keys
            const newFS = {};
            Object.keys(fileStore).forEach(function (k) {
                const ki = parseInt(k);
                if      (ki < index)  newFS[ki]     = fileStore[ki];
                else if (ki > index)  newFS[ki - 1] = fileStore[ki];
            });
            fileStore = newFS;

            renderTable();
            updateStokInfo(); // refresh info stok setelah hapus
        };

        // ─── Tombol Tambah ke Daftar ─────────────────────────────────────
        document.getElementById('addLogistic').addEventListener('click', function () {
            if (!validateForm()) return;

            const logOpt  = logisticSelect.options[logisticSelect.selectedIndex];
            const fileEl  = document.getElementById('dokumentasi_keluar');
            const file    = fileEl.files[0] || null;
            const jumlah  = parseInt(jumlahInput.value);

            const item = {
                logistikId   : logisticSelect.value,
                logistikText : logOpt.text,
                jumlah       : jumlah,
                satuan       : satuanLogistikInput.value,
                namaPenerima : document.getElementById('nama_penerima').value.trim(),
                nikKk        : document.getElementById('nik_kk_penerima').value.trim(),
                telepon      : document.getElementById('nomor_telepon').value.trim(),
                alamat       : document.getElementById('alamat_penerima').value.trim(),
                tanggalKeluar: document.getElementById('tanggal_keluar').value,
                keterangan   : document.getElementById('keterangan_keluar').value,
                dokNama      : file ? file.name : '',
            };

            const itemIndex = items.length;
            items.push(item);
            if (file) fileStore[itemIndex] = file;

            // Kurangi stok sementara agar entri berikutnya tidak over-stok
            stokSementara[item.logistikId] = (stokSementara[item.logistikId] || 0) + jumlah;

            renderTable();
            resetInputForm();
            updateStokInfo();
        });

        // ─── Reset form input ────────────────────────────────────────────
        function resetInputForm() {
            // Biarkan tanggal & penerima tetap terisi untuk input batch
            logisticSelect.selectedIndex     = 0;
            kodeLogistikInput.value          = '';
            satuanLogistikInput.value        = '';
            jumlahInput.value                = '';
            document.getElementById('keterangan_keluar').selectedIndex = 0;
            document.getElementById('dokumentasi_keluar').value        = '';
            jumlahError.style.display  = 'none';
            stokInfo.textContent       = '';
        }

        function esc(str) {
            if (!str && str !== 0) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');
        }

        // ─── Validasi sebelum submit final ───────────────────────────────
        document.getElementById('submitForm').addEventListener('submit', function (e) {
            if (items.length === 0) {
                e.preventDefault();
                alert('Belum ada data logistik keluar. Tambahkan minimal 1 data terlebih dahulu.');
            }
        });

    }); // end DOMContentLoaded

    function performSearch() {
        const q = document.getElementById('search-input').value.toLowerCase();
        document.querySelectorAll('table tbody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    }
    document.getElementById('search-input').addEventListener('input', performSearch);
    </script>
</body>
</html>