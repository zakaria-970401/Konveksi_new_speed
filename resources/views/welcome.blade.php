
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>NEW SPEED | APPS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">


    <link rel="stylesheet" href="/asset_login/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/asset_login/css/animate.css">
    
    <link rel="stylesheet" href="/asset_login/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/asset_login/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/asset_login/css/magnific-popup.css">

    <link rel="stylesheet" href="/asset_login/css/aos.css">

    <link rel="stylesheet" href="/asset_login/css/ionicons.min.css">

    
    <link rel="stylesheet" href="/asset_login/css/flaticon.css">
    <link rel="stylesheet" href="/asset_login/css/icomoon.css">
    <link rel="stylesheet" href="/asset_login/css/style.css">
  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="#">NEW SPEED | APPS</a>
   
    </div>
  </nav>
    <!-- END nav -->
    
    <!-- <div class="js-fullheight"> -->
    <div class="hero-wrap js-fullheight" style="zoom: 85%">
      <div class="overlay"></div>
      <div id="particles-js"></div>
      <div class="container">
        @include('sweetalert::alert')
        @yield('konten')
        <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">APLIKASI INTERNAL <strong>KONVEKSI NEW SPEED</strong></h1>
            <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="#login" data-toggle="modal" class="btn btn-primary px-5 py-3"><i class="fas fa-sign-in-alt"> Silahkan Login</i></a></p>
          </div>
        </div>
      </div>
    </div>
    
 
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="zoom: 85%">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"> Form Login </h5>
                    </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                    
                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                    
                                                <div class="col-md-8">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukan Email..">
                    
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                    
                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    
                                                <div class="col-md-8">
                                                    <input type="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukan Password" id="pass">
                    
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                    
                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-2">
                                                    <button type="submit" class="btn btn-primary btn-block">
                                                        {{ __('Login') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
  

  <script src="/asset_login/js/jquery.min.js"></script>
  <script src="/asset_login/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/asset_login/js/popper.min.js"></script>
  <script src="/asset_login/js/bootstrap.min.js"></script>
  <script src="/asset_login/js/jquery.easing.1.3.js"></script>
  <script src="/asset_login/js/jquery.waypoints.min.js"></script>
  <script src="/asset_login/js/jquery.stellar.min.js"></script>
  <script src="/asset_login/js/owl.carousel.min.js"></script>
  <script src="/asset_login/js/jquery.magnific-popup.min.js"></script>
  <script src="/asset_login/js/aos.js"></script>
  <script src="/asset_login/js/jquery.animateNumber.min.js"></script>
  <script src="/asset_login/js/bootstrap-datepicker.js"></script>
  <script src="/asset_login/js/jquery.timepicker.min.js"></script>
  <script src="/asset_login/js/particles.min.js"></script>
  <script src="/asset_login/js/particle.js"></script>
  <script src="/asset_login/js/scrollax.min.js"></script>
 
  <script src="/asset_login/js/google-map.js"></script>
  <script src="/asset_login/js/main.js"></script>
    
  </body>
</html>