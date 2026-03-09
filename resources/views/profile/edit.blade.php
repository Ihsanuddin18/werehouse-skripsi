<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard &rsaquo; Profil &mdash; Warehouse BPBD | Kabupaten Jember</title>

  <link rel="shortcut icon" href="{{ asset('landingpages') }}/assets/images/logo/logobpbd1.png" type="image/png" />

  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/fontawesome/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/modules/summernote/summernote-bs4.css">

  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('tdashboard') }}/assets/css/components.css">

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

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
              <a href="{{ route('outlogistics')}}" class="nav-link"><i class="fas fa-sign-out-alt"></i> <span>Logistik
                  Keluar</span></a>
            </li>
            <li>
              <a href="{{ route('logisticrequests')}}" class="nav-link"><i class="fas fa-chart-line"></i>
                <span>Rekomendasi Stok</span></a>
            </li>
            <li class="menu-header">Pengaturan</li>
            <li class=active>
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

      <!-- Main -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profil</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
              <div class="breadcrumb-item">Profil</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">{{ Auth::user()->name }}</h2>
            <p class="section-lead">
              Tingkatkan perubahan profil anda dengan sentuhan pribadi yang unik!
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="{{ asset('tdashboard') }}/assets/img/avatar/logobpbd1.png"
                      class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Tanggal</div>
                        <div class="profile-widget-item-value">08</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Bulan</div>
                        <div class="profile-widget-item-value">Juni</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Tahun</div>
                        <div class="profile-widget-item-value">2010</div>
                      </div>
                    </div>
                  </div>

                  <div class="profile-widget-description">
                    <div class="profile-widget-name">{{ Auth::user()->name }}
                      <div class="text-muted d-inline font-weight-normal">
                        <div class="slash"></div> Biografi
                      </div>
                    </div>
                    @if(Auth::user()->biography)
            <p>{!! nl2br(Auth::user()->biography) !!}</p>
          @else
      <p>Belum ada biografi.</p>
    @endif
                  </div>
                  <div class="card-footer text-center">
                    <div class="font-weight-bold mb-2">BPBD Kabupaten Jember</div>
                    <a href="https://www.facebook.com/bpbd.jember" class="btn btn-social-icon btn-facebook mr-1">
                      <img src="{{ asset('tdashboard') }}/assets/img/logfacebook.png" alt="logofacebook">
                    </a>
                    <a href="https://twitter.com/PusdalopJ" class="btn btn-social-icon btn-twitter mr-1">
                      <img src="{{ asset('tdashboard') }}/assets/img/logtwitter.png" alt="logotwitter">
                    </a>
                    <a href="https://bpbd.jemberkab.go.id/" class="btn btn-social-icon btn-github mr-1">
                      <img src="{{ asset('tdashboard') }}/assets/img/logbpbd.png" alt="logobpbd">
                    </a>
                    <a href="https://www.instagram.com/bpbd_kab.jember/" class="btn btn-social-icon btn-instagram">
                      <img src="{{ asset('tdashboard') }}/assets/img/loginstagram.png" alt="logoinstagram">
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                @if(Session::has('status'))
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
            title: '{{ Session::get('status') }}'
            });
          </script>
        @endif

                <div class="card">
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4> Perubahan Profil</h4>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="form-group col-md-6 col-12">
                          @include('profile.partials.update-profile-information-form')
                          <div class="invalid-feedback">
                            Please fill in the first name
                          </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                          @include('profile.partials.update-password-form')
                          <div class="invalid-feedback">
                            Please fill in the last name
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      </div>
                      <div>
                        <form action="{{ route('profile.updateBiography', $user->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="row">
                            <div class="form-group col-12">
                              <label><strong style="font-size: 1.7em; color: #515151;">Perbarui
                                  Biografi</strong></label>
                              <textarea class="form-control summernote-simple" name="biography"
                                rows="5">{{ $user->biography }}</textarea>
                            </div>
                          </div>
                          <div>
                            <button type="submit" class="btn btn-primary">Simpan Biografi</button>
                          </div>
                        </form>

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

  <script src="{{ asset('tdashboard') }}/assets/modules/summernote/summernote-bs4.js"></script>

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