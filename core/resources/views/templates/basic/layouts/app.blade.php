<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')

    <!-- Custom Css -->

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="{{ asset($activeTemplateTrue . 'assets/manifest.json') }}" />
    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/css/swiper.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset($activeTemplateTrue . 'assets/css/style.css') }}" rel="stylesheet" id="style">

    <!-- Custom stule Blade File for this tamplate -->
    @include('templates.basic.custom_css.style')

    <style>
        a {
            text-decoration: none !important;
        }

        .bg-gradiant {
            background-image: linear-gradient(to bottom right, #ffffff36, #00000081) !important;
            color: #FFF;
        }

        .bg-gradiant-alt {
            background-image: linear-gradient(to bottom right, #00000081, #ffffff36) !important;
            color: #FFF;
        }

        .bg-purple {
            background: #560087 !important;
            color: #FFF;
        }
        .text-purple {
            color: #560087 !important;
        }

        .bg-purple-light {
            background-color: #fae0ff !important;
        }

        .bg-orange {
            background: #f76000 !important;
            color: #FFF;
        }

        .btn-mini {
            font-size: 0.6rem;
            line-height: 1;
            border-radius: 80.19999999999999rem;
        }

        .btn-mini2 {
            font-size: 0.7rem;
            line-height: 1.7;
            border-radius: 80.19999999999999rem;
        }

        .border-custom {
            border-radius: 1.3rem !important;
        }

        .avatar.avatar-200 {
            height: 200px;
            line-height: 200px;
            width: 200px;
        }

        /* custom */

        .single-select.active {
            position: relative;
            border-color: #e6a25d;
        }
        .single-select {
            padding: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
            border-radius: 8px;
        }

    </style>

    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lightcase.css') }}">

    @stack('style-lib')

    @stack('style')

    @stack('style-custom')

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color1={{ $general->base_color }}&color2={{ $general->secondary_color }}">
</head>

<body>

    @stack('fbComment')

    <!-- screen loader -->
    <div class="container-fluid h-100 loader-display">
        <div class="row h-100">
            <div class="align-self-center col">
                <div class="logo-loading">
                    <div class="icon icon-100 mb-4 rounded-circle shadow-sm">
                        <img src="{{ getImage(getFilePath('logoIcon') . '/favicon.png') }}" alt=""
                            class="w-100">
                    </div>
                    <h4 class="text-primary">{{ $general->site_name }}</h4>
                    <p class="text-secondary">{{ __($pageTitle) }}</p>
                    <div class="loader-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="preloader">
        <div class="dl">
            <div class="dl__container">
                <div class="dl__corner--top"></div>
                <div class="dl__corner--bottom"></div>
            </div>
            <div class="dl__square"></div>
        </div>
    </div> --}}

    <!-- scroll-to-top start -->
    {{-- <div class="scroll-to-top">
        <span class="scroll-icon">
            <i class="fa fa-rocket" aria-hidden="true"></i>
        </span>
    </div> --}}
    <!-- scroll-to-top end -->

    @yield('panel')

    {{-- @include($activeTemplate . 'partials.footer') --}}


    @php
        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    @endphp
    @if ($cookie->data_values->status == 1 && !\Cookie::get('gdpr_cookie'))
        <!-- cookies dark version start -->
        <div class="cookies-card text-center hide">
            <div class="cookies-card__icon bg--base">
                <i class="las la-cookie-bite"></i>
            </div>
            <p class="mt-4 cookies-card__content">{{ $cookie->data_values->short_desc }} <a href="{{ route('cookie.policy') }}" target="_blank">@lang('learn more')</a></p>
            <div class="cookies-card__btn mt-4">
                <a href="javascript:void(0)" class="btn cmn-btn w-100 policy">@lang('Allow')</a>
            </div>
        </div>
        <!-- cookies dark version end -->
    @endif


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>


    <!--**** custom script start ****-->
    <!-- Required jquery and libraries -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/js/popper.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- cookie js -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/jquery.cookie.js') }}"></script>

    <!-- Swiper slider  js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/js/swiper.min.js') }}"></script>

    <!-- Swiper slider  js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/swiper/js/swiper.min.js') }}"></script>



    <!-- chart js-->
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/utils.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/vendor/chartjs/chart-js-data.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/main.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'assets/js/color-scheme-demo.js') }}"></script>

    <!-- PWA app service registration and works -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/pwa-services.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{ asset($activeTemplateTrue . 'assets/js/app.js') }}"></script>
    <!--***** custom script end *****-->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>

    @stack('script-lib')

    @stack('script')

    @include('partials.plugins')

    @include('partials.notify')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    


    <script>
        //-- Notify --//
        const notifyMsg = (msg,cls) => {
            Swal.fire({
                position: 'top-end',
                icon: cls,
                title: msg,
                toast:true,
                showConfirmButton: false,
                timer: 2100
            })
        }
        
        (function($) {
            "use strict";
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });

            var inputElements = $('input,select');
            $.each(inputElements, function(index, element) {
                element = $(element);
                var type = element.attr('type');
                if (type != 'checkbox') {
                    element.closest('.form-group').find('label').attr('for', element.attr('name'));
                    element.attr('id', element.attr('name'))
                }
            });

            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            $.each($('input, select, textarea'), function(i, element) {

                if (element.hasAttribute('required')) {
                    $(element).closest('.form-group').find('label').addClass('required');
                }

            });

            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });

            let headings = $('.table th');
            let rows = $('.table tbody tr');
            let columns
            let dataLabel;
            $.each(rows, function(index, element) {
                columns = element.children;
                if (columns.length == headings.length) {
                    $.each(columns, function(i, td) {
                        dataLabel = headings[i].innerText;
                        $(td).attr('data-label', dataLabel)
                    });
                }
            });

        })(jQuery);
    </script>

</body>

</html>
