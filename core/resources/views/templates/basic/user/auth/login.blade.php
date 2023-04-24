@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $loginCaption = getContent('login.content', true);
    @endphp

    <body class="body-scroll d-flex flex-column h-100 menu-overlay">
        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">

            <!-- Fixed navbar -->
            <header class="header">
                <div class="row">
                  <div class="col align-self-center text-center">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <h5 class="mb-0">
                          <img height="24px" src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}" alt="site-logo">
                        </h5>
                    </a>
                  </div>
                </div>
            </header>

            <div class="main-container">
              <form id="loginForm" method="POST" action="{{ route('user.login') }}" class="login-form mt-50 verify-gcaptcha">
                  @csrf
                  <div class="container h-100 ">
                      <div class="row h-100">
                          <div class="col-12 align-self-center mb-4">
                              <div class="row justify-content-center">
                                  <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                                      <h2 class="font-weight-normal mb-5 text-center text-primary"><b>Login</b></h2>
                                      <div class="form-group float-label">
                                          <input type="text" class="form-control " value="{{ old('username') }}"
                                              name="username" >
                                          <label class="form-control-label "><i class="las la-user"></i> Username</label>
                                      </div>
                                      <div class="form-group float-label position-relative">
                                          <input type="password" class="form-control " name="password" >
                                          <label class="form-control-label "><i class="las la-unlock-alt"></i> Password</label>
                                      </div>
                                      <p class="text-right">
                                        <a href="{{ route('user.password.request') }}" class="">
                                          Forgot Password?
                                        </a>
                                      </p>
  
                                      <div class="row justify-content-center">
                                        <div class="col">
                                            <button type="submit" id="recaptcha" class="btn loginBtn rounded btn-block shadow">Login</button>
                                        </div>
                                      </div>
  
                                  </div>
                              </div>
                          </div>
  
                      </div>
                  </div>
  
                  <div class="footer no-bg-shadow pt-0">
                    <div class="row justify-content-center">
                        <div class="col text-center">
                          <p class="text-white mb-1">You don't have any Account?</p>
                          <a href="{{ route('user.register') }}" class="text-white mb-3 pt-0">
                            <b>Sign Up</b>
                          </a>
                        </div>
                    </div>
                  </div>
  
              </form>
            </div>
        </main>
    </body>
@endsection
@push('script')
    <script>
      $(document).ready(function () {

        $('#loginForm').submit(function (e) {
          $('.loginBtn').html(`<div class="spinner-border spinner-border-sm" role="status"></div>`);
          e.preventDefault();
          let formData = new FormData($(this)[0])
          $.ajax({
            type: "POST",
            url: "{{ route('user.login') }}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (res) {
              console.log(res);
              notifyMsg(res.msg,res.cls)
              if (res.cls == 'success') {
                window.location.href = "{{route('user.home')}}"
              }
              $('.loginBtn').html('Login');
            }
          });
        });

      });
    </script>
    
@endpush
