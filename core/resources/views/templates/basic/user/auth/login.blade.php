@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $loginCaption = getContent('login.content',true);
@endphp

<body class="body-scroll d-flex flex-column h-100 menu-overlay">




  <!-- Begin page content -->
  <main class="flex-shrink-0 main has-footer">

      <!-- Fixed navbar -->
      <header class="header">
          <div class="row">
              <div class="col-auto px-0">
                  <button class="menu-btn btn btn-40 btn-link back-btn" type="button">
                      <span class="material-icons">keyboard_arrow_left</span>
                  </button>
              </div>
              <div class="text-left col align-self-center">
                 
              </div>
              <div class="ml-auto col-auto align-self-center">
                  <a href="{{ route('user.register') }}" class="text-white">
                      Sign up
                  </a>
              </div>
          </div>
      </header>
      
  <form method="POST" action="{{ route('user.login')}}" class="login-form mt-50 verify-gcaptcha">
      @csrf
          <div class="container h-100 text-white">
              <div class="row h-100">
                  <div class="col-12 align-self-center mb-4">
                      <div class="row justify-content-center">
                          <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                              <h2 class="font-weight-normal mb-5">Login into<br>your account</h2>
                              <div class="form-group float-label active">
                                  <input type="text" class="form-control text-white" value="{{ old('username') }}" name="username" required>
                                  <label class="form-control-label text-white">Username/Email</label>
                              </div>
                              <div class="form-group float-label position-relative">
                                  <input type="password" class="form-control text-white" name="password" required>
                                  <label class="form-control-label text-white">Password</label>
                              </div>  
                              <p class="text-right"><a href="{{ route('user.password.request') }}" class="text-white">Forgot Password?</a></p>
                          </div>
                      </div>
                  </div>
                  
              </div>
          </div>
      </main>

      <!-- footer-->
      <div class="footer no-bg-shadow py-3">
          <div class="row justify-content-center">
              <div class="col">
                  <button type="submit" id="recaptcha" class="btn btn-default rounded btn-block">@lang('Login Now')</button>
              </div>
          </div>
      </div>

  </form>

  
</body>







{{-- <section class="pt-120 pb-120">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="login-area">
            <h2 class="title mb-3">{{ __($loginCaption->data_values->heading) }}</h2>
            <form class="action-form loginForm verify-gcaptcha" action="{{ route('user.login') }}" method="post">
              @csrf
              <div class="form-group">
                <label>@lang('Username or Email')</label>
                <div class="input-group">
                  <div class="input-group-text"><i class="las la-user"></i></div>
                  <input type="username" name="username" class="form-control" placeholder="@lang('Username or Email')" required>
                </div>
              </div><!-- form-group end -->
              <div class="form-group mb-3">
                <label>@lang('Password')</label>
                <div class="input-group">
                  <div class="input-group-text"><i class="las la-key"></i></div>
                  <input type="password" name="password" class="form-control" placeholder="@lang('Password')" required>
                </div>
              </div><!-- form-group end -->
              <x-captcha></x-captcha>
              <div class="form-group form-check">
                <input class="form-check-input w-auto p-2" type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    @lang('Remember Me')
               </label>
            </div>
              <div class="form-group text-center">
                <button type="submit" class="btn btn--base w-100">@lang('Login Now')</button>
                <p class="mt-20">@lang('Forget your password?') <a href="{{ route('user.password.request') }}">@lang('Reset password')</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section> --}}


@endsection
