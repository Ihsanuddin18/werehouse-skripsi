<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Password &rsaquo; Warehouse BPBD | Kabupaten Jember</title>

    <!--====== Favicon Icon ======-->
    <link
      rel="shortcut icon"
      href="{{ asset('landingpages') }}/assets/images/logo/logobpbd1.png"
      type="image/png"
    />

    <link rel="shortcut icon" href="{{ asset('tloginjadi') }}/assets/images/fav.jpg">
    <link rel="stylesheet" href="{{ asset('tloginjadi') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('tloginjadi') }}/assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('tloginjadi') }}/assets/css/style.css" />

</head>
<style>
            body {
                background-image: url('{{ asset("tloginjadi") }}/assets/images/abstrak1.jpg');
                background-size: cover;
                background-position: center, center;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            .container-fluid {p
                padding-top: 90px; 
                text-align: center;
            }

            @media screen and (max-width: 768px) {
                .container-fluid {
                    padding-top: 50px;
                }
            }

            .login-info {
                margin-top: 20px;
            }

            @media screen and (max-width: 768px) {
                .login-info {
                    margin-top: 40px;
                }
            }
        </style>
    <style>
    body {
        background-image: url('{{ asset("tloginjadi") }}/assets/images/abstrak1.jpg');
        background-size: cover;
        background-position: center, center;
    }
    </style>

<body>
    <div class="container-fluid ">
        <div class="container ">
            <div class="row cdvfdfd">
                <div class="col-lg-10 col-md-12 login-box">
                    <div class="row">
                    <div class="col-lg-6 col-md-6 log-det">
                    <div class="small-logo">
                        <img src="{{ asset('tloginjadi') }}/assets/images/logo1login.svg" alt="Logo">
                    </div>
                    <p class="dfmn">Forgot Password</p>
                    <div class="text-box-cont">
                        <form method="POST" action="{{ route('password.store') }}"> <!-- Sesuaikan action route dengan yang Anda miliki -->
                            @csrf <!-- Tambahkan CSRF token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}"> <!-- Tambahkan token reset password -->

                            <!-- Email Address -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email" value="{{ $request->email }}" required autofocus autocomplete="email">
                            </div>

                            <!-- New Password -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="New Password" aria-label="New Password" aria-describedby="basic-addon2" name="password" required autocomplete="new-password">
                            </div>

                            <!-- Confirm Password -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="basic-addon3" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="input-group center">
                                <button type="submit" class="btn btn-danger" style="background-color: rgb(110, 110, 255); border-color: rgb(110, 110, 252);">Perbarui Password</button>
                            </div>
                        </form>
                        <div class="row">
                            <p class="forget-p">Warehouse | BPBD</p>
                        </div>
                        <div class="row">
                            <p class="small-info"></p>
                        </div>   
                    </div>
                </div>
                        <div class="col-lg-6 col-md-6 box-de">
                           <div class="inn-cover">
                               <div class="ditk-inf">
                                <div class="small-logo">
                                    <img src="{{ asset('tloginjadi') }}/assets/images/logo2login.svg" alt="Logo">
                            </div>
                                    <h2 class="w-100">Kembali ke halaman Login? </h2>
                                    <p>Jika anda yakin, Silahkan tekan tombol dibawah ini !</p>
                                    <a href="#">
                                    <button type="button" class="btn btn-outline-light">Login</button>
                                    </a>
                                </div>
                                 <div class="foter-credit">
                                  <a href="https://smarteyeapps.com/"></a>  
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('tloginjadi') }}/assets/js/jquery-3.2.1.min.js"></script>
<script src="{{ asset('tloginjadi') }}/assets/js/popper.min.js"></script>
<script src="{{ asset('tloginjadi') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ asset('tloginjadi') }}/assets/js/script.js"></script>


</html>
