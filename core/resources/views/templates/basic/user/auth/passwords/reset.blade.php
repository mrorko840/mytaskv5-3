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
          <form method="POST" action="{{ route('user.password.update') }}" class="login-form mt-50 verify-gcaptcha">
              @csrf
              <div class="container h-100 ">
                  <div class="row h-100">
                      <div class="col-12 align-self-center mb-4">
                          <div class="row justify-content-center">
                              <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                                    <h2 class="font-weight-normal text-center text-primary">
                                        <b>Reset Password</b>
                                    </h2>
                                    <h6 class="mb-5"></h6>

                                    <input type="hidden" name="email" value="{{ $email }}">
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="form-group float-label">
                                        <input type="password" class="form-control form--control" name="password" required>
                                        <label class="form-control-label "><i class="las la-unlock-alt"></i> New Password</label>
                                    </div>
                                    <div class="form-group float-label">
                                        <input type="password" class="form-control form--control" name="password_confirmation" required>
                                        <label class="form-control-label "><i class="las la-unlock-alt"></i> Confirm New Password</label>
                                    </div>

                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <button type="submit" id="recaptcha" class="btn loginBtn rounded btn-block shadow">Update Password</button>
                                        </div>
                                    </div>

                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              {{-- <div class="footer no-bg-shadow pt-0">
                <div class="row justify-content-center">
                    <div class="col text-center">
                      <p class="text-white mb-1">You don't have any Account?</p>
                      <a href="{{ route('user.register') }}" class="text-white mb-3 pt-0">
                        <b>Sign Up</b>
                      </a>
                    </div>
                </div>
              </div> --}}

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
                        <p>@lang('Your account is verified successfully. Now you can change your password. Please enter a strong password and don\'t share it with anyone.')</p>
                    </div>
                    <form method="POST" action="{{ route('user.password.update') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label class="form-label">@lang('Password')</label>
                            <input type="password" class="form-control form--control" name="password" required>
                            @if($general->secure_password)
                                <div class="input-popup">
                                    <p class="error lower">@lang('1 small letter minimum')</p>
                                    <p class="error capital">@lang('1 capital letter minimum')</p>
                                    <p class="error number">@lang('1 number minimum')</p>
                                    <p class="error special">@lang('1 special character minimum')</p>
                                    <p class="error minimum">@lang('6 character password')</p>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">@lang('Confirm Password')</label>
                            <input type="password" class="form-control form--control" name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn--base w-100"> @lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection

@push('script-lib')
<script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
<script>
    (function ($) {
        "use strict";
        @if($general->secure_password)
            $('input[name=password]').on('input',function(){
                secure_password($(this));
            });

            $('[name=password]').focus(function () {
                $(this).closest('.form-group').addClass('hover-input-popup');
            });

            $('[name=password]').focusout(function () {
                $(this).closest('.form-group').removeClass('hover-input-popup');
            });
        @endif
    })(jQuery);
</script>
@endpush
