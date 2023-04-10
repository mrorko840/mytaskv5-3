@extends($activeTemplate . 'layouts.master')
@section('content')
    <style>
        .StyleFont {
            font-family: "Times New Roman", Times, serif;
        }

        body {
            text-align: center;
            background-color: #3d5fa5;
        }

        .button {
            position: relative;
            display: inline-block;
            margin: 20px;
        }

        .buttonOff {
            position: relative;
            display: inline-block;
            margin: 20px;
        }

        .button a {
            color: white;
            font-family: Helvetica, sans-serif;
            font-weight: bold;
            font-size: 36px;
            text-align: center;
            text-decoration: none;
            background-color: #FFA12B;
            display: block;
            position: relative;
            padding: 20px 23px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            text-shadow: 1px 2px 6px #0000007a;
            filter: dropshadow(color=#000, offx=0px, offy=1px);
            -webkit-box-shadow: inset 0 1px 0 #FFE5C4, 0 10px 0 #915100;
            -moz-box-shadow: inset 0 1px 0 #FFE5C4, 0 10px 0 #915100;
            box-shadow: inset 0 1px 0 #FFE5C4, 0 10px 0 #915100;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 75px;
        }

        .buttonOff a {
            color: white;
            font-family: Helvetica, sans-serif;
            font-weight: bold;
            font-size: 36px;
            text-align: center;
            text-decoration: none;
            background-color: #bbbbbb;
            display: block;
            position: relative;
            padding: 20px 23px;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            text-shadow: 1px 2px 6px #0000007a;
            filter: dropshadow(color=#000, offx=0px, offy=1px);
            -webkit-box-shadow: inset 0 1px 0 #FFE5C4, 0 10px 0 #14141499;
            -moz-box-shadow: inset 0 1px 0 #FFE5C4, 0 10px 0 #14141499;
            box-shadow: inset 0 1px 0 #FFE5C4, 0 10px 0 #14141499;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 75px;
        }

        .button a:active {
            top: 10px;
            background-color: #2b2b2b;

            -webkit-box-shadow: inset 0 1px 0 #FFE5C4, inset 0 -3px 0 #14141499;
            -moz-box-shadow: inset 0 1px 0 #FFE5C4, inset 0 -3pxpx 0 #14141499;
            box-shadow: inset 0 1px 0 #FFE5C4, inset 0 -3px 0 #14141499;
        }

        .buttonOff a:active {
            top: 10px;
            background-color: #605d59;

            -webkit-box-shadow: inset 0 1px 0 #FFE5C4, inset 0 -3px 0 #14141499;
            -moz-box-shadow: inset 0 1px 0 #FFE5C4, inset 0 -3pxpx 0 #14141499;
            box-shadow: inset 0 1px 0 #FFE5C4, inset 0 -3px 0 #14141499;
        }

        .button:after {
            content: "";
            height: 100%;
            width: 100%;
            padding: 4px;
            position: absolute;
            bottom: -15px;
            left: -4px;
            z-index: -1;
            background-color: #2B1800;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .buttonOff:after {
            content: "";
            height: 100%;
            width: 100%;
            padding: 4px;
            position: absolute;
            bottom: -15px;
            left: -4px;
            z-index: -1;
            background-color: #2B1800;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }
    </style>

    <body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
        <!-- Top navbar -->
        @include($activeTemplate . 'includes.side_nav')

        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">
            <!-- Fixed navbar -->
            @include($activeTemplate . 'includes.top_nav')

            <div class="container mt-3 mb-4 text-center">
                <!-- User Balance-->
                <h2 class="text-white user_balance">

                </h2>

                <p class="text-white mb-4">Total Balance</p>
            </div>

            <div class="main-container">
                <div class="row">
                    <div class="col-12 text-center">
                        @if (auth()->user()->isClick < date('Yd'))
                            <h5 class="text-primary" id="btnMsg">Click this button to collect
                                {{ $user->plan?->ads_rate }} {{ $general->cur_sym }}</h5>
                        @else
                            <h5 class="text-success text-danger">You can collect Reward Tomorrow!</h5>
                        @endif
                    </div>
                    {{-- <div class="col-12 text-center">
                        @if (auth()->user()->isClick < date('Yd'))
                            <div id="loadBtn">
                                <div ontouchstart="">
                                    <div class="button">
                                      <a href="javascript:void(0)" id="runTask">
                                        <span class="material-icons pt-1 pl-1 text-white" style="font-size: 90px">
                                            play_arrow
                                        </span>
                                      </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div ontouchstart="">
                                <div class="buttonOff">
                                <a href="javascript:void(0)" id="noTask">
                                    <span class="material-icons text-white" style="font-size: 90px">
                                        pause
                                    </span>
                                </a>
                                </div>
                            </div>
                        @endif

                    </div> --}}

                    <div class="col-12 text-center">
                        @if (auth()->user()->isClick < date('Yd'))
                            <div id="loadBtn">
                                <img id="runTask" width="180px" height="180px" class="rounded-circle shadow" src="{{asset('assets/templates/basic/assets/img/button/playBtn.png')}}" alt="">
                            </div>
                        @else
                            <img id="runTask" width="180px" height="180px" class="rounded-circle shadow" src="{{asset('assets/templates/basic/assets/img/button/pauseBtn.png')}}" alt="">
                        @endif

                    </div>

                    {{-- <div class="col-12 text-center">
                        @if (auth()->user()->isClick < date('Yd'))
                            <div id="loadBtn">
                                <button
                                    class="btn btn-success bg-success btn-lg rounded-circle shadow border border-5 StyleFont"
                                    style="width: 150px; height: 150px; border: 5px solid #ffffff !important;"
                                    id="runTask">
                                    <span class="material-icons pt-1 pl-1 text-white" style="font-size: 90px">
                                        play_arrow
                                    </span>
                                </button>
                            </div>
                        @else
                            <button class="btn btn-warning btn-lg rounded-circle shadow border border-5 StyleFont"
                                style="width: 150px; height: 150px; border: 5px solid #ffffff !important;" disabled>
                                Click
                            </button>
                        @endif

                    </div> --}}
                    <div class="col-12 py-2 text-center">
                        <h5 id="counter"></h5>
                    </div>
                </div>
            </div>
        </main>

        <!-- footer-->
        @include($activeTemplate . 'includes.bottom_nav')



    </body>
@endsection

@push('script')
    <script>
        let isClicked = {{auth()->user()->isClick ? auth()->user()->isClick : '0'}};
        let adsRate = {{ $user->plan?->ads_rate ? $user->plan?->ads_rate : '0' }};
        let planID = {{ $user->plan?->id ? $user->plan?->id : '0' }};

        //userinFo
        const userInfo = function() {
            $.ajax({
                type: "GET",
                url: "{{ route('user.userinfo') }}",
                success: function(res) {
                    console.log(res);
                    isClicked = res.isClick
                    if (res.plan) {
                        adsRate = res.plan.ads_rate;
                        planID = res.plan.id;
                    }
                    $('.user_balance').html('{{ $general->cur_sym }} ' + parseFloat(res.balance).toFixed(2));
                }
            });
        }

        //run on window load
        userInfo()

        //noTask
        $(document).on('click', '#noTask', function (e) {
            e.preventDefault();
            notifyMsg('You have already collect Todays Reward!', 'error');
        });

        //runTask
        $(document).on('click', '#runTask', function(e) {
            e.preventDefault();
            if (planID > 0) {
                if( isClicked < {{date('Yd')}} ){
                    let reward = adsRate;
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user.runtask') }}",
                        data: {
                            reward: reward
                        },
                        success: function(res) {
                            // console.log(res);
                            notifyMsg(res.msg, res.cls);
                            $("#btnMsg").html('You can collect Reward Tomorrow!').addClass('text-danger');
    
                            $("#loadBtn").html(
                                `<img id="runTask" width="180px" height="180px" class="rounded-circle shadow" src="{{asset('assets/templates/basic/assets/img/button/pauseBtn.png')}}" alt="">`
                            );
                            userInfo()
                        }
                    });
                }else{
                    notifyMsg('You have already collect Todays Reward!', 'error');
                }
            } else {
                notifyMsg('Upgrade Your Plan at first!', 'warning');
            }
        });

        
        //create CountDown
        function createCountDown(elementId, sec) {
            var tms = sec;
            
            var x = setInterval(function() {
                if( isClicked >= {{date('Yd')}} ){
                    var distance = tms * 1000;
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
                    document.getElementById(elementId).innerHTML = days + "d: " + hours + "h " + minutes +
                        "m " + seconds + "s ";
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById(elementId).innerHTML = "{{ __('COMPLETE') }}";
                        
                    }
                    tms--;
                }

            }, 1000);
        }
        createCountDown('counter', {{ \Carbon\Carbon::tomorrow()->diffInSeconds() }});

    </script>
@endpush
