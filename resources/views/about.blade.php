<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Selamat Datang Di Warehouse BPBD | Kabupaten Jember </title>

    <link
      rel="shortcut icon"
      href="{{ asset('landingpages') }}/assets/images/logo/logobpbd1.png"
      type="image/png"
    />

    <link rel="stylesheet" href="{{ asset('landingpages') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('landingpages') }}/assets/css/animate.css" />
    <link rel="stylesheet" href="{{ asset('landingpages') }}/assets/css/lineicons.css" />
    <link rel="stylesheet" href="{{ asset('landingpages') }}/assets/css/ud-styles.css" />
  </head>
  <body>
    
    <header class="ud-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg">
              <button class="navbar-toggler">
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
                <span class="toggler-icon"> </span>
              </button>

              <div class="navbar-collapse">
                <ul id="nav" class="navbar-nav mx-auto">
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="/">Beranda</a>
                  </li>

                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#about">Profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="#team">Tim</a>
                  </li>
                  <li class="nav-item">
                    <a class="ud-menu-scroll" href="/#contact">Kontak</a>
                  </li>
                  <li class="nav-item nav-item-has-children">
                    <a href="javascript:void(0)"> Halaman </a>
                    <ul class="ud-submenu">
                      <li class="ud-submenu-item">
                        <a href="{{ route('about') }}" class="ud-submenu-link">
                          Halaman Profil
                        </a>
                      </li>
                      <li class="ud-submenu-item">
                        <a href="{{ route('contact') }}" class="ud-submenu-link">
                          Hubungi Kami
                        </a>
                      </li>
                      <li class="ud-submenu-item">
                        <a href="{{ route('login') }}" class="ud-submenu-link">
                          Halaman Login
                        </a>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="navbar-btn d-none d-sm-inline-block">
                <a href="{{ route('login') }}" class="btn btn-primary">
                Login
                </a>
              </div>
              <style>
                .btn {
                    background-color: white;
                    color: #000000;
                    border: 1px solid #007bff; 
                    border-radius: 5px; 
                    padding: 10px 20px; 
                    font-size: 16px; 
                    cursor: pointer; 
                    transition: background-color 0.3s, color 0.3s; 
                  }

                  .btn:hover {
                    background-color: #007bff;
                    color: white; 
                  }

                  i {
                    font-size: 18px;
                    margin-right: 5px; 
                  }
              </style>
            </nav>
          </div>
        </div>
      </div>
    </header>
    
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>Halaman Profil</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section id="about" class="ud-about">
      <div class="container">
        <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
          <div class="ud-about-content-wrapper">
            <div class="ud-about-content">
              <span class="tag">Profil</span>
              <h2>Warehouse BPBD <br> Kabupaten Jember
              </h2>
              <p>
                Website Manajemen Stok Logistik "Warehouse BPBD Kabupaten Jember" adalah sebuah
                platform digital yang dirancang khusus untuk membantu Badan Penanggulangan Bencana
                Daerah (BPBD) Kabupaten Jember dalam mengelola dan mengoptimalkan manajemen stok
                logistik. Website ini memiliki berbagai fitur dan fungsionalitas yang
                dirancang untuk meningkatkan efisiensi, visibilitas, dan responsivitas dalam pengelolaan
                persediaan barang dan layanan logistik dalam konteks penanggulangan bencana.
              </p>
            </div>
          </div>
          <div class="ud-about-image">
            <img src="{{ asset('landingpages') }}/assets/images/about/about-image.svg" alt="about-image" />
          </div>
        </div>
      </div>
    </section>
    
     <section id="team" class="ud-team">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title mx-auto text-center">
              <span>Tim Kami</span>
              <p>
                Kami bekerja sama untuk merancang, mengembangkan, dan 
                meluncurkan website yang memenuhi standar kualitas
                dan mencerminkan komitmen BPBD Kabupaten Jember dalam
                memberikan layanan terbaik kepada masyarakat.
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".1s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="{{ asset('landingpages') }}/assets/images/team/team-01.png" alt="team" />
                </div>

                <img
                  src="{{ asset('landingpages') }}/assets/images/team/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="{{ asset('landingpages') }}/assets/images/team/shape-2.svg"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Mohammad Ihsanuddin</h5>
                <h6>Web Developer</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="https://www.instagram.com/isan.nuddin/">
                    <i class="lni lni-instagram-filled"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".15s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="{{ asset('landingpages') }}/assets/images/team/team-02.png" alt="team" />
                </div>
                <img
                  src="{{ asset('landingpages') }}/assets/images/team/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="{{ asset('landingpages') }}/assets/images/team/shape-2.svg"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Muhammad Guntur Wijaya</h5>
                <h6>App Developer</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="https://www.instagram.com/gunturwijayahh/">
                    <i class="lni lni-instagram-filled"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".2s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="{{ asset('landingpages') }}/assets/images/team/team-03.png" alt="team" />
                </div>

                <img
                  src="{{ asset('landingpages') }}/assets/images/team/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="{{ asset('landingpages') }}/assets/images/team/shape-2.svg"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Fahmi Fahreza</h5>
                <h6>UI/UX Design</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="https://www.instagram.com/reezzaaaa__/">
                    <i class="lni lni-instagram-filled"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".25s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="{{ asset('landingpages') }}/assets/images/team/team-04.png" alt="team" />
                </div>

                <img
                  src="{{ asset('landingpages') }}/assets/images/team/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="{{ asset('landingpages') }}/assets/images/team/shape-2.svg"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Caesar Ali</h5>
                <h6>Quality Assurance Analyst</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="https://www.instagram.com/alicaesar42/">
                    <i class="lni lni-instagram-filled"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="row justify-content-center">
          <div class="col-xl-3 col-lg-3 col-sm-6">
            <div class="ud-single-team wow fadeInUp" data-wow-delay=".25s">
              <div class="ud-team-image-wrapper">
                <div class="ud-team-image">
                  <img src="{{ asset('landingpages') }}/assets/images/team/team-04.png" alt="team" />
                </div>
                <img
                  src="{{ asset('landingpages') }}/assets/images/team/dotted-shape.svg"
                  alt="shape"
                  class="shape shape-1"
                />
                <img
                  src="{{ asset('landingpages') }}/assets/images/team/shape-2.svg"
                  alt="shape"
                  class="shape shape-2"
                />
              </div>
              <div class="ud-team-info">
                <h5>Rayhan Cahyadi</h5>
                <h6>Software Management</h6>
              </div>
              <ul class="ud-team-socials">
                <li>
                  <a href="https://www.instagram.com/alicaesar42/">
                    <i class="lni lni-instagram-filled"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
    
    <footer class="ud-footer wow fadeInUp" data-wow-delay=".15s">
      <div class="shape shape-1">
        <img src="{{ asset('landingpages') }}/assets/images/footer/shape-1.svg" alt="shape" />
      </div>
      <div class="shape shape-2">
        <img src="{{ asset('landingpages') }}/assets/images/footer/shape-2.svg" alt="shape" />
      </div>
      <div class="shape shape-3">
        <img src="{{ asset('landingpages') }}/assets/images/footer/shape-3.svg" alt="shape" />
      </div>
      <div class="ud-footer-widgets">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="ud-widget">
                <a href="index.html" class="ud-footer-logo">
                  <img src="{{ asset('landingpages') }}/assets/images/logo/logo.svg" alt="logo" />
                </a>
                <p class="ud-widget-desc">
                Website ini bertujuan untuk meningkatkan efisiensi, transparansi, 
                dan keterlibatan dalam manajemen stok logistik BPBD Kabupaten Jember. 
                </p>
                <ul class="ud-widget-socials">
                  <li>
                    <a href="https://www.facebook.com/bpbd.jember">
                      <i class="lni lni-facebook-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://twitter.com/pusdalops_jbr">
                      <i class="lni lni-twitter-filled"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.instagram.com/bpbd_kab.jember/">
                      <i class="lni lni-instagram-filled"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Menu Utama</h5>
                <ul class="ud-widget-links">
                  <li>
                  <a href="/">Beranda</a>
                  </li>
                  <li>
                  <a href="/#about">Profil</a>
                  </li>
                  <li>
                    <a href="#team">Tim</a>
                  </li>
                  <li>
                    <a href="/#contact">Kontak</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-6 col-sm-6">
              <div class="ud-widget">
                <h5 class="ud-widget-title">Fitur Utama</h5>
                <ul class="ud-widget-links">
                  <li>
                    <a href="/">Cetak Laporan</a>
                  </li>
                  <li>
                    <a href="/">Pemantauan Stok Secara Langsung</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ud-footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <ul class="ud-footer-bottom-left">
                <li>
                  <a href="#team">Tim Servis</a>
                </li>
              </ul>
            </div>
            <div class="col-md-4">
              <p class="ud-footer-bottom-right">
                Selamat Datang Di Website Resmi Warehouse BPBD
                <a href="/" rel="nofollow">Warehouse BPBD Kabupaten Jember </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
    <a href="javascript:void(0)" class="back-to-top">
      <i class="lni lni-chevron-up"> </i>
    </a>
    
    <script src="{{ asset('landingpages') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landingpages') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('landingpages') }}/assets/js/main.js"></script>
  </body>
</html>
