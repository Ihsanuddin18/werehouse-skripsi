<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title> Dashboard &rsaquo; Werehouse BPBD | Kabupaten Jember </title>

  <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="{{ asset('landingpages') }}/assets/images/logo/logobpbd1.png" type="image/png" />

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet"
    href="{{ asset('tdashboard') }}/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/css/components.css">

  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                  class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input id="search-input" class="form-control" type="search" placeholder="Search" aria-label="Search"
              data-width="250">
            <button class="btn" type="button" onclick="performSearch()"><i class="fas fa-search"></i></button>
          </div>
          <div id="clock" style="color: white; margin-left: 15px;"></div>
        </form>
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
            <a href="{{ route('home') }}">WB</a>
          </div>
          <ul class="sidebar-menu">
            <li class=active>
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
            <li>
              <a href="{{ route('inlogistics')}}" class="nav-link"><i class="fas fa-sign-in-alt"></i> <span>Logistik
                  Masuk</span></a>
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
        </aside>
      </div>


      <script>
        document.getElementById("notification").addEventListener("click", function (event) {
          event.preventDefault();
          $('#tambahModal').modal('show');
        });
      </script>
      @if(session('loginSuccessNotification'))
        <script>
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 9000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer);
              toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
          });

          // Tampilkan notifikasi Toast dengan pesan yang diterima dari session
          Toast.fire({
            icon: 'success',
            title: '{{ session('loginSuccessNotification') }}'
          });
        </script>
      @endif

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Logistik</h4>
                  </div>
                  <div class="card-body">
                    {{$logisticsCount}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Supplier</h4>
                  </div>
                  <div class="card-body">
                    {{ $suppliersCount }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-sign-in-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Penerimaan</h4>
                  </div>
                  <div class="card-body">
                    {{ $inlogisticsCount }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jumlah Pengeluaran</h4>
                  </div>
                  <div class="card-body">
                    {{ $outlogisticsCount }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="align-items: stretch;">

            {{-- Kolom Kiri: Tabel Stok --}}
            <div class="col-lg-8 col-12" style="display: flex; flex-direction: column;">
              <div class="card mb-0" style="display: flex; flex-direction: column; height: 520px;">
                <div class="card-header" style="flex-shrink: 0;">
                  <h4>Daftar stok data logistik</h4>
                </div>
                <div style="flex: 1; overflow-y: auto; min-height: 0;">
                  <table class="table table-striped mb-0">
                    <thead class="table-primary" style="position: sticky; top: 0; z-index: 1;">
                      <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Kode Logistik</th>
                        <th style="text-align: center;">Nama Logistik</th>
                        <th style="text-align: center;">Supplier</th>
                        <th style="text-align: center;">Stok Logistik</th>
                        <th style="text-align: center;">Tanggal Kadaluarsa</th>
                      </tr>
                    </thead>
                    @php use Carbon\Carbon; @endphp
                    <tbody>
                      @if($inlogistics->count() > 0)
                        @foreach($inlogistics as $inlogistic)
                          <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ optional($inlogistic->logistic)->kode_logistik }}</td>
                            <td class="text-center">{{ optional($inlogistic->logistic)->nama_logistik }}</td>
                            <td class="text-center">{{ optional($inlogistic->supplier)->nama_supplier }}</td>
                            <td class="text-center">
                              {{ $inlogistic->jumlah_logistik_masuk }}
                              {{ optional($inlogistic->logistic)->satuan_logistik }}
                            </td>
                            <td class="text-center">
                              {{ Carbon::parse($inlogistic->expayer_logistik)->translatedFormat('l, d F Y') }}
                            </td>
                          </tr>
                        @endforeach
                      @else
                        <tr>
                          <td colspan="6" class="text-center py-4">Tidak ada data !</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            {{-- Kolom Kanan: Mendekati Kadaluarsa + Aktivitas Terbaru --}}
            <div class="col-lg-4 col-12" style="display: flex; flex-direction: column; gap: 20px; height: 520px;">

              {{-- Card Mendekati Kadaluarsa --}}
              <div class="card mb-0" style="display: flex; flex-direction: column; flex: 0 0 auto; max-height: 200px;">
                <div class="card-header" style="flex-shrink: 0; padding: 12px 16px; border-bottom: 1px solid #f0f0f0;">
                  <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="
            width: 28px; height: 28px; border-radius: 50%; background: #fff3cd;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
          ">
                      <i class="fas fa-exclamation-triangle" style="color: #e6a817; font-size: 12px;"></i>
                    </div>
                    <h4 style="margin: 0; font-size: 14px;">Mendekati Kadaluarsa</h4>
                    @if(isset($expiringItems) && $expiringItems->count() > 0)
                              <span style="
                        margin-left: auto; background: #e6a817; color: #fff;
                        font-size: 11px; font-weight: 700; padding: 2px 8px;
                        border-radius: 20px; flex-shrink: 0;
                      ">{{ $expiringItems->count() }}</span>
                    @endif
                  </div>
                </div>
                <div style="flex: 1; overflow-y: auto; min-height: 0; padding: 4px 16px;">
                  @if(isset($expiringItems) && $expiringItems->count() > 0)
                    @foreach($expiringItems as $item)
                            @php
                              $sisaHari = $item['sisa_hari'];
                              if ($sisaHari == 0) {
                                $warnaText = '#dc3545';
                                $warnaBg = '#fdecea';
                                $labelHari = 'Hari ini kadaluarsa!';
                              } elseif ($sisaHari <= 2) {
                                $warnaText = '#dc3545';
                                $warnaBg = '#fdecea';
                                $labelHari = 'Kadaluarsa dalam ' . $sisaHari . ' hari';
                              } elseif ($sisaHari <= 4) {
                                $warnaText = '#e6a817';
                                $warnaBg = '#fff3cd';
                                $labelHari = 'Kadaluarsa dalam ' . $sisaHari . ' hari';
                              } else {
                                $warnaText = '#17a2b8';
                                $warnaBg = '#d1ecf1';
                                $labelHari = 'Kadaluarsa dalam ' . $sisaHari . ' hari';
                              }
                            @endphp
                            <div style="
                        display: flex; align-items: center; gap: 10px;
                        padding: 8px 0;
                        {{ !$loop->last ? 'border-bottom: 1px solid #f4f4f4;' : '' }}
                      ">
                              {{-- Ikon hari --}}
                              <div style="
                          width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
                          display: flex; align-items: center; justify-content: center;
                          background: {{ $warnaBg }}; color: {{ $warnaText }}; font-size: 13px;
                        ">
                                <i class="fas fa-calendar-times"></i>
                              </div>

                              {{-- Nama & label --}}
                              <div style="flex: 1; min-width: 0;">
                                <div style="
                            font-size: 13px; font-weight: 600; color: #2d2d2d;
                            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
                          ">{{ $item['nama'] }}</div>
                                <div style="font-size: 11px; color: {{ $warnaText }}; font-weight: 500; margin-top: 1px;">
                                  {{ $labelHari }}
                                </div>
                              </div>

                              {{-- Tanggal kadaluarsa --}}
                              <div style="
                          flex-shrink: 0; font-size: 11px; font-weight: 600;
                          color: {{ $warnaText }}; background: {{ $warnaBg }};
                          padding: 3px 8px; border-radius: 20px; white-space: nowrap;
                        ">
                                {{ Carbon::parse($item['expayer_logistik'])->translatedFormat('d M Y') }}
                              </div>
                            </div>
                    @endforeach
                  @else
                    <div style="text-align: center; padding: 24px 0; color: #aaa;">
                      <i class="fas fa-check-circle"
                        style="font-size: 24px; display:block; margin-bottom: 8px; color: #28a745; opacity:.6;"></i>
                      <span style="font-size: 12px;">Semua stok masih aman</span>
                    </div>
                  @endif
                </div>
              </div>

              {{-- Card Aktivitas Terbaru --}}
              <div class="card mb-0" style="display: flex; flex-direction: column; flex: 1; min-height: 0;">
                <div class="card-header" style="flex-shrink: 0; border-bottom: 1px solid #f0f0f0;">
                  <h4 style="margin: 0;">Aktivitas Terbaru</h4>
                </div>
                <div style="flex: 1; overflow-y: auto; min-height: 0; padding: 4px 16px;">
                  @if(isset($recentActivities) && $recentActivities->count() > 0)
                    @foreach($recentActivities as $activity)
                            @php $isMasuk = $activity['type'] === 'masuk'; @endphp
                            <div style="
                        display: flex; align-items: center; gap: 12px;
                        padding: 10px 0;
                        {{ !$loop->last ? 'border-bottom: 1px solid #f4f4f4;' : '' }}
                      ">
                              {{-- Ikon bulat --}}
                              <div style="
                          width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
                          display: flex; align-items: center; justify-content: center;
                          background-color: {{ $isMasuk ? '#e8f8f0' : '#fdecea' }};
                          color: {{ $isMasuk ? '#28a745' : '#dc3545' }};
                          font-size: 14px;
                        ">
                                <i class="fas {{ $isMasuk ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i>
                              </div>

                              {{-- Nama & waktu --}}
                              <div style="flex: 1; min-width: 0;">
                                <div
                                  style="font-size: 11px; color: {{ $isMasuk ? '#28a745' : '#dc3545' }}; font-weight: 600; margin-bottom: 1px; text-transform: uppercase; letter-spacing: 0.4px;">
                                  {{ $activity['user'] }}
                                  <span style="color: #aaa; font-weight: 400; text-transform: none; letter-spacing: 0;">
                                    {{ $isMasuk ? 'menambahkan logistik masuk' : 'mengeluarkan logistik' }}
                                  </span>
                                </div>
                                <div style="
                            font-size: 13px; font-weight: 600; color: #2d2d2d;
                            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 2px;
                          ">{{ $activity['nama'] ?? 'Logistik tidak diketahui' }}</div>
                                <div style="font-size: 11px; color: #aaa;">
                                  <i class="far fa-clock" style="font-size:10px;"></i>
                                  {{ \Carbon\Carbon::parse($activity['tanggal'])->translatedFormat('d M Y, H:i') }}
                                </div>
                              </div>

                              {{-- Badge jumlah --}}
                              <div style="
                          flex-shrink: 0; font-size: 12px; font-weight: 700;
                          color: {{ $isMasuk ? '#28a745' : '#dc3545' }};
                          background: {{ $isMasuk ? '#e8f8f0' : '#fdecea' }};
                          padding: 3px 10px; border-radius: 20px; white-space: nowrap;
                        ">
                                {{ $isMasuk ? '+' : '-' }}{{ $activity['jumlah'] }} {{ $activity['satuan'] }}
                              </div>
                            </div>
                    @endforeach
                  @else
                    <div style="text-align:center; padding: 60px 0; color: #aaa;">
                      <i class="fas fa-history"
                        style="font-size: 28px; display:block; margin-bottom: 10px; opacity:.4;"></i>
                      <span style="font-size: 13px;">Belum ada aktivitas</span>
                    </div>
                  @endif
                </div>
              </div>

            </div>{{-- end kolom kanan --}}

          </div>
        </section>
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

  <!-- General JS Scripts -->
  <script src="{{ asset('tdashboard') }}/assets/modules/jquery.min.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/modules/popper.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/modules/tooltip.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/modules/moment.min.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('tdashboard') }}/assets/modules/jquery.sparkline.min.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/modules/chart.min.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/modules/summernote/summernote-bs4.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('tdashboard') }}/assets/js/page/index.js"></script>

  <!-- Template JS File -->
  <script src="{{ asset('tdashboard') }}/assets/js/scripts.js"></script>
  <script src="{{ asset('tdashboard') }}/assets/js/custom.js"></script>
  <script>
    // Fungsi untuk memfilter baris tabel berdasarkan input pencarian
    function performSearch() {
      // Ambil nilai dari input pencarian
      const searchQuery = document.getElementById('search-input').value.toLowerCase();

      // Ambil semua baris dari tabel
      const tableRows = document.querySelectorAll('table tbody tr');

      // Loop melalui semua baris tabel
      tableRows.forEach(row => {
        // Ambil teks dari setiap kolom dalam baris
        const rowData = row.innerText.toLowerCase();

        // Cek apakah teks baris mengandung nilai pencarian
        if (rowData.includes(searchQuery)) {
          // Jika cocok, tampilkan baris
          row.style.display = '';
        } else {
          // Jika tidak cocok, sembunyikan baris
          row.style.display = 'none';
        }
      });
    }

    // Tambahkan event listener untuk input pencarian 
    document.getElementById('search-input').addEventListener('input', performSearch);
  </script>
</body>

</html>