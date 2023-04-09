<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/png" href="{{ getImage(fileManager()->logoIcon()->path . '/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- bootstrap -->
    @php
        $activeTemplateTrue = activeTemplate(true);
    @endphp
    <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
    <title> {{ $general->sitename(__($pageTitle)) }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    
    {{-- <script>
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'hidden') {
                document.body.innerHTML = `
                       <div class="d-flex flex-wrap justify-content-center align-items-center clear-msg">
                            <h3 class="text-danger text-center">@lang('Currently you are unavailable to view this add. Please dont\'t leave the window.')</h3>
                        </div>
                    `;
            }
        });
    </script> --}}

    <style>
        #myProgress {
            width: 100%;
            background-color: #ddd;
        }

        #myBar {
            width: 10%;
            height: 30px;
            background-color: #5FA625;
            text-align: center;
            line-height: 30px;
            color: white;
        }

        #confirm {
            color: white;
            font-weight: 600;
        }

        .inputcaptcha {
            width: 60px;
        }

        .btn {
            margin-top: -4px;
        }

        @media (max-width: 767px) {
            ul.nav.navbar-nav.navbar-right {
                margin-top: 15px;
            }

            .container {
                display: flex !important;
                justify-content: center !important;
            }
        }

        @media (max-width: 320px) {
            .row {
                display: flex;
                justify-content: center;
            }

            .btn {
                margin-top: 5px;

            }
        }

        .adFram {
            border: 0;
            position: absolute;
            top: 14%;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%
        }

        .adFram {
            top: 86px;
        }

        @media (max-width: 400px) {
            .advertise-wrapper iframe {
                margin-top: unset;
            }
        }

        .adBody {
            position: absolute;
            top: 30%;
            left: 40%;
        }

        @media (max-width: 400px) {
            .advertise-wrapper iframe {
                margin-top: 43px;
            }
        }

        .iframe-container {
            position: absolute;
            width: 60%;
            padding-bottom: 56.25%;
            display: flex;
            justify-content: center;
        }

        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        @media only screen and (max-width: 768px) {
            .adFram {
                top: 124px !important;
            }
        }

        @media only screen and (max-width: 446px) {
            .adFram {
                top: 162px !important;
            }
        }

        @media only screen and (max-width: 288px) {
            .adFram {
                top: 192px !important;
            }
        }

        @media only screen and (max-width: 218px) {
            .adFram {
                top: 202px !important;
            }
        }

        .border-custom {
            border-radius: 1.3rem !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-primary p-4">
        <div class="container">
            <div class="row w-100">
                <div class="col-md-4">
                    <div id="myProgress">
                        <div id="myBar">0%</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="" id="confirm-form" method="post">
                        @csrf
                        <ul class="nav navbar-nav text-end mt-md-0 mt-2">
                            <li class="active">
                                
                                <button type="button" id="confirm" onclick="clicked()" class="btn btn-danger btn-md mt-sm-0 mt-2" disabled hidden>
                                    @lang('Loading Ads')
                                </button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <script>
        (function($, document) {
            "use strict";
            

            function move() {
                var elem = document.getElementById("myBar");
                var width = 0;
                var id = setInterval(frame, {{ $ptc->duration * 10 }});

                function frame() {
                    if (width >= 100) {
                        var confirmButton = document.getElementById("confirm");
                        confirmButton.removeAttribute('disabled');
                        confirmButton.setAttribute('type', 'submit');
                        confirmButton.className = "btn btn-success mt-sm-0 mt-2";
                        document.getElementById('confirm-form').setAttribute('action', '{{ route('user.ptc.confirm', encrypt($ptc->id . '|' . auth()->user()->id)) }}');
                        
                        var confirmButton = document.getElementById("confirm");
                        confirmButton.innerHTML = "Confirm Earn";
                        clearInterval(id);
                        document.getElementById("confirm").click();
                    } else {
                        width++;
                        elem.style.width = width + '%';
                        elem.innerHTML = width + '%';
                    }
                }
            }
            window.onload = move;
        })(jQuery, document);
    </script>

    <div class="advertise-wrapper">
        @if ($ptc->ads_type == 1)
            <iframe src="{{ $ptc->ads_body }}" class="adFram"></iframe>
        @elseif($ptc->ads_type == 2)
            <div class="container mt-5">
                <img src="{{ getImage(fileManager()->ptc()->path . '/' . $ptc->ads_body) }}" class="w-100">
            </div>
        @elseif($ptc->ads_type == 3)
            <div class="adBody">
                @php echo $ptc->ads_body @endphp
            </div>
        @else
            <div class="d-flex justify-content-center mt-3">
                    <iframe class="border-custom" src="{{ $ptc->ads_body }}?autoplay=1&mute=1" title="YouTube video player" width="93%" height="270px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        @endif
    </div>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
