@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
    $policyPages = getContent('policy_pages.element', false, null, true);
    $registerCaption = getContent('register.content', true);
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
                    <a href="{{ route('user.login') }}" class="text-white">
                        Sign In
                    </a>
                </div>
            </div>
        </header>

        <form class="verify-gcaptcha mt-4" action="{{ route('user.register') }}" method="POST">
            @csrf
            <div class="container h-100 text-white">
                <div class="row h-100">
                    <div class="col-12 align-self-center mb-4">
                        <div class="row justify-content-center">
                            <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                                <h2 class="font-weight-normal mb-5">Create new<br>account with us</h2>
                                @if (session()->get('reference') != null)
                                <div class="form-group float-label active">
                                    <input class="form-control text-white" id="referenceBy" name="referBy" type="text" value="{{ session()->get('reference') }}" readonly>
                                    <label class="form-control-label text-white">Refer By</label>
                                </div>
                                @endif
                                <div class="form-group float-label active">
                                    <input class="form-control text-white checkUser" id="username" name="username" type="text" value="{{ old('username') }}" required>
                                    <label class="form-control-label text-white">Username</label>
                                    <small class="text-danger usernameExist"></small>
                                </div>
                                <div class="form-group float-label active">
                                    <input class="form-control text-white checkUser" id="email" name="email" type="email" value="{{ old('email') }}" required>
                                    <label class="form-control-label text-white">Email</label>
                                </div>
                                <div class="form-group float-label active">
                                    <div class="input-group">
                                        <select class="form-control text-white" id="country" name="country" required>
                                            @foreach ($countries as $key => $country)
                                                <option data-mobile_code="{{ $country->dial_code }}" data-code="{{ $key }}" value="{{ $country->country }}">{{ __($country->country) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="form-control-label text-white">Country</label>
                                </div>
                                <div class="form-group float-label active">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text mobile-code" id="inputGroup-sizing-default"></span>
                                            <input name="mobile_code" type="hidden">
                                            <input name="country_code" type="hidden">
                                        </div>
                                        <input class="form-control text-white checkUser " aria-label="Default" aria-describedby="inputGroup-sizing-default" id="mobile" name="mobile" type="number" value="{{ old('mobile') }}" required>
                                    </div>
                                    <label class="form-control-label text-white">Mobile</label>
                                </div>
                                <div class="form-group float-label position-relative">
                                    <input class="form-control text-white" id="password" name="password" type="password" required>
                                    <label class="form-control-label text-white">Password</label>
                                    @if ($general->secure_password)
                                        <div class="input-popup">
                                            <p class="error lower">@lang('1 small letter minimum')</p>
                                            <p class="error capital">@lang('1 capital letter minimum')</p>
                                            <p class="error number">@lang('1 number minimum')</p>
                                            <p class="error special">@lang('1 special character minimum')</p>
                                            <p class="error minimum">@lang('6 character password')</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group float-label position-relative">
                                    <input class="form-control text-white" id="password-confirm" name="password_confirmation" type="password" required autocomplete="new-password">
                                    <label class="form-control-label text-white">Confirm Password</label>
                                </div>
                                @if ($general->agree)
                                <div class="form-group float-label position-relative">
                                    <div class="custom-control custom-switch">
                                        <input class="custom-control-input" id="agree" name="agree" type="checkbox" @checked(old('agree')) required>
                                        <label class="custom-control-label" for="agree"> I agree with</label>
                                        @foreach ($policyPages as $policy)
                                            <a class="text--base" href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}">{{ __($policy->data_values->title) }}</a>
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- footer-->
            <div class="footer no-bg-shadow py-3">
                <div class="row justify-content-center">
                    <div class="col">
                        <button class="btn btn-default rounded btn-block" id="recaptcha" type="submit">@lang('Register')</button>
                    </div>
                </div>
            </div>


        </form>
    </main>

</body>



    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('You already have an account please Login ')</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                    <a href="{{ route('user.login') }}" class="btn btn--base">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .country-code .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }
    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            @if ($general->secure_password)
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });

                $('[name=password]').focus(function() {
                    $(this).closest('.form-group').addClass('hover-input-popup');
                });

                $('[name=password]').focusout(function() {
                    $(this).closest('.form-group').removeClass('hover-input-popup');
                });
            @endif

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
