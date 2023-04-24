@extends($activeTemplate.'layouts.frontend')
@section('content')

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
          <form method="POST" action="{{ route('user.password.email') }}" class="login-form mt-50 verify-gcaptcha">
              @csrf
              <div class="container h-100 ">
                  <div class="row h-100">
                      <div class="col-12 align-self-center mb-4">
                          <div class="row justify-content-center">
                              <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                                <h2 class="font-weight-normal text-center text-primary">
                                    <b>Account Recovery</b>
                                </h2>
                                <h6 class="mb-5"></h6>
                                  
                                    <div class="form-group float-label">
                                        <input type="text" class="form-control form--control" name="value" value="{{ old('value') }}" required autofocus="off">
                                      <label class="form-control-label "><i class="las la-user"></i> Email or Username</label>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <button type="submit" id="recaptcha" class="btn loginBtn rounded btn-block shadow">Next</button>
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






{{-- <section class="pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-7">
                <div class="password-area">
                    <h3 class="title mb-2">{{ __($pageTitle) }}</h3>
                    <div class="mb-4">
                        <p>@lang('To recover your account please provide your email or username to find your account.')</p>
                    </div>
                    <form method="POST" action="{{ route('user.password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">@lang('Email or Username')</label>
                            <input type="text" class="form-control form--control" name="value" value="{{ old('value') }}" required autofocus="off">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            <p class="mt-20"><a href="{{ route('user.login') }}">@lang('Back to login')</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection
