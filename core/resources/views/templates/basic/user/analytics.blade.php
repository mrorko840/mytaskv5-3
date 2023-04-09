@extends($activeTemplate . 'layouts.master')
@section('content')
@php
    $fake_reviews = getContent('fake_review.element');
@endphp



<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="analytics">
    <!-- Top navbar -->
    @include($activeTemplate . 'includes.side_nav')

    
    <div class="backdrop"></div>


    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav')

        <!-- page content start -->
        <div class="container mt-3 mb-4 text-center">
            <h2 class="text-white">{{ $general->cur_sym }} {{ showAmount($widget['total_balance']) }}</h2>
            <p class="text-white mb-4">Total Balance</p>
        </div>

        <div class="container text-center overflow-hidden">
            <canvas id="mixedchartjs"></canvas>
        </div>
        <div class="main-container">

            <!-- Analytics -->
            <div class="container mb-4">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="doghnutchart" class="mb-3"></canvas>
                                <p class="text-secondary mb-2">Total Earnings</p>
                                <h6>{{ $general->cur_sym }} {{ showAmount($ptc->sum('amount') + $total_commission) }}</h6>
                                {{-- <p class="text-success">{{ intval(@$widget['win_raito']) }}% <span class="material-icons small">call_made</span></p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="doghnutchart3" class="mb-3"></canvas>
                                <p class="text-secondary mb-2">Total Invest</p>
                                <h6>{{ $general->cur_sym }} {{ showAmount($total_invest) }}</h6>
                                {{-- <p class="text-danger">{{ intval(@$widget['loss_raito']) }}% <span class="material-icons small">call_received</span></p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 d-none d-md-block" hidden>
                        <div class="card" hidden>
                            <div class="card-body">
                                <canvas id="doghnutchart4" class="mb-3"></canvas>
                                <p class="text-secondary mb-2">Send</p>
                                <h6>$ 2051.00</h6>
                                <p class="text-success">10% <span class="material-icons small">call_made</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 d-none d-md-block" hidden>
                        <div class="card" hidden>
                            <div class="card-body">
                                <canvas id="doghnutchart5" class="mb-3"></canvas>
                                <p class="text-secondary mb-2">Received</p>
                                <h6>$ 1200.00 </h6>
                                <p class="text-danger">-5% <span class="material-icons small">call_received</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-4">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">@lang('Click & Earn Report')</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 d-md-block mb-30">
                        <div class="card border-0">
                            <div class="card-body">
                                <div id="apex-bar-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Swiper Our Reviews-->
            <div class="container mb-4">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">Our Reviews</h6>
                    </div>
                </div>
                <div class="swiper-container swiper-users ">
                    <div class="swiper-wrapper">
                        @forelse($fake_reviews as $review)

                        <div class="swiper-slide mb-0">
                            <div style="min-height: 180px; width: 320px;" class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="avatar avatar-60 rounded mb-1">
                                                <div class="background"><img src="{{ getImage('assets/images/frontend/fake_review/'.@$review->data_values->image) }}" alt=""></div>
                                            </div>
                                            <p class="text-secondary mb-0"><small>{{ @$review->data_values->name }}</small></p>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col ">
                                            <p class="mb-1">{{@$review->data_values->review_text}}<small class="text-success" hidden>28% <span class="material-icons small" hidden>call_made</span></small></p>
                                            <p class="text-secondary small">{{ showDateTime(@$review->updated_at, 'd-m-Y, h:i a') }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @empty

                        @endforelse
                        
                    </div>
                </div>
            </div>

            

            <!-- Swiper -->
            {{-- <div class="container mb-4">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">Saved Cards</h6>
                    </div>
                </div>
                <div class="swiper-container swiper-cards">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card border-0 mb-3 bg-default text-white">
                                <div class="card-header">
                                    <h6 class="mb-0">Visa <small>Debit Card</small></h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="mb-0 mt-2">4444 5264 2541 26651</h5>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <p class="mb-0">26/21</p>
                                            <p class="small ">Expiry date</p>
                                        </div>
                                        <div class="col-auto align-self-center text-right">
                                            <p class="mb-0">Agnish Carvan</p>
                                            <p class="small">Card Holder</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-secondary text-center mb-1">Total Expense</p>
                            <h5 class="mb-4 text-center">$ 1500 <small class="text-success">28% <span class="material-icons small">call_made</span></small></h5>
                        </div>
                        <div class="swiper-slide">
                            <div class="card border-0 mb-3 bg-danger text-white">
                                <div class="card-header">
                                    <h6 class="mb-0">Maestro <small>Credit Card</small></h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="mb-0 mt-2">4444 5264 2541 658952</h5>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <p class="mb-0">26/21</p>
                                            <p class="small ">Expiry date</p>
                                        </div>
                                        <div class="col-auto align-self-center text-right">
                                            <p class="mb-0">Agnish Carvan</p>
                                            <p class="small">Card Holder</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-secondary text-center mb-1">Total Expense</p>
                            <h5 class="mb-4 text-center">$ 2800 <small class="text-danger">28% <span class="material-icons small">call_received</span></small></h5>
                        </div>
                        <div class="swiper-slide">
                            <div class="card border-0 mb-3 bg-success text-white">
                                <div class="card-header">
                                    <h6 class="mb-0">Payme <small>Debit Card</small></h6>
                                </div>
                                <div class="card-body">
                                    <h5 class="mb-0 mt-2">4444 5264 2541 26651</h5>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <p class="mb-0">26/21</p>
                                            <p class="small ">Expiry date</p>
                                        </div>
                                        <div class="col-auto align-self-center text-right">
                                            <p class="mb-0">Agnish Carvan</p>
                                            <p class="small">Card Holder</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-secondary text-center mb-1">Total Expense</p>
                            <h5 class="mb-4 text-center">$ 1500 <small class="text-success">28% <span class="material-icons small">call_made</span></small></h5>
                        </div>
                    </div>
                    <!-- swiper pagination -->
                    <div class="swiper-pagination "></div>
                </div>
            </div> --}}

            <!-- Swiper win -->
            {{-- <div class="container mb-4">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">Win Match</h6>
                    </div>
                </div>
                <div class="swiper-container swiper-users ">
                    <div class="swiper-wrapper">
                        @forelse($game_logs as $log)
                        @if($log->win_status != Status::LOSS)
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-60 rounded mb-1">
                                                @if(@$log->game->image)
                                                <div class="background"><img src="{{ getImage(getFilePath('game') . '/' . $log->game->image, getFileSize('game')) }}" alt=""></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col pl-0">
                                            <p class="text-secondary mb-0"><small>{{ __($log->game->name) }}</small></p>
                                            <p class="mb-1">
                                                <b class="@if($log->win_status != Status::LOSS) text-success @else text-danger @endif">
                                                    {{ $general->cur_sym }}{{getAmount($log->invest) }}
                                                </b>
                                                @if($log->win_status != Status::LOSS)
                                                    <span class="badge badge-success style--light px-2">@lang('Win')</span>
                                                @else
                                                    <span class="badge badge-danger style--light px-2">@lang('Lost')</span>
                                                @endif
                                            </p>
                                            <p class="text-secondary small">{{showDateTime($log->created_at, 'd-m-Y')}} | {{ diffForHumans($log->created_at) }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif

                        @empty

                        @endforelse

                    </div>
                </div>
            </div> --}}

            <!-- Swiper Lost-->
            {{-- <div class="container mb-4">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">Lost Match</h6>
                    </div>
                </div>
                <div class="swiper-container swiper-users ">
                    <div class="swiper-wrapper">
                        @forelse($game_logs as $log)
                        @if($log->win_status == Status::LOSS)
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-60 rounded mb-1">
                                                @if(@$log->game->image)
                                                <div class="background"><img src="{{ getImage(getFilePath('game') . '/' . $log->game->image, getFileSize('game')) }}" alt=""></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col pl-0">
                                            <p class="text-secondary mb-0"><small>{{ __($log->game->name) }}</small></p>
                                            <p class="mb-1">
                                                <b class="@if($log->win_status != Status::LOSS) text-success @else text-danger @endif">
                                                    {{ $general->cur_sym }}{{getAmount($log->invest) }}
                                                </b>
                                                @if($log->win_status != Status::LOSS)
                                                    <span class="badge badge-success style--light px-2">@lang('Win')</span>
                                                @else
                                                    <span class="badge badge-danger style--light px-2">@lang('Lost')</span>
                                                @endif
                                            </p>
                                            <p class="text-secondary small">{{showDateTime($log->created_at, 'd-m-Y')}} | {{ diffForHumans($log->created_at) }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif

                        @empty

                        @endforelse

                    </div>
                </div>
            </div> --}}

            <!-- Swiper -->
            {{-- <div class="container mb-4">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">Expensive Categories</h6>
                    </div>
                </div>
                <div class="swiper-container swiper-users">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide text-center">
                            <div class="avatar avatar-60 bg-default-light text-default rounded-circle">
                                <i class="material-icons">account_balance</i>
                            </div>
                            <p class="mt-2 mb-0">$1500 <small class="text-success">28% <span class="material-icons small">call_made</span></small></p>
                            <p class="small">Rent</p>
                        </div>
                        <div class="swiper-slide text-center">
                            <div class="avatar avatar-60  bg-default-light text-default rounded-circle">
                                <i class="material-icons">videogame_asset</i>
                            </div>
                            <p class="mt-2 mb-0">$540 <small class="text-success">5% <span class="material-icons small">call_made</span></small></p>
                            <p class="small mt-1">Gaming</p>
                        </div>
                        <div class="swiper-slide text-center">
                            <div class="avatar avatar-60  bg-default-light text-default rounded-circle">
                                <i class="material-icons">cake</i>
                            </div>
                            <p class="mt-2 mb-0">$800 <small class="text-danger">18% <span class="material-icons small">call_received</span></small></p>
                            <p class="small mt-1">Parties</p>
                        </div>
                        <div class="swiper-slide text-center">
                            <div class="avatar avatar-60  bg-default-light text-default rounded-circle">
                                <i class="material-icons">local_florist</i>
                            </div>
                            <p class="mt-2 mb-0">$1200 <small class="text-success">12% <span class="material-icons small">call_made</span></small></p>
                            <p class="small mt-1">Gardening</p>
                        </div>
                        <div class="swiper-slide text-center">
                            <div class="avatar avatar-60  bg-default-light text-default rounded-circle">
                                <i class="material-icons">camera</i>
                            </div>
                            <p class="mt-2 mb-0">$100 <small class="text-success">28% <span class="material-icons small">call_made</span></small></p>
                            <p class="small mt-1">Movies</p>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div> --}}

            {{-- <div class="container">
                <div class="row mb-3">
                    <div class="col">
                        <h6 class="subtitle mb-0">Upcoming Payments </h6>
                    </div>
                    <div class="col-auto"><a href="allpayment.html" class="float-right small">View All</a></div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1">$ 1548.00 </h5>
                                        <p class="text-secondary">20d to pay electricity bill</p>

                                    </div>
                                    <div class="col-auto pl-0">
                                        <button class="btn btn-40 bg-default-light text-default rounded-circle">
                                            <i class="material-icons">local_atm</i>
                                        </button>
                                    </div>
                                </div>
                                <div class="progress h-5 mt-3">
                                    <div class="progress-bar bg-default" role="progressbar" style="width:35%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mb-1">$ 106.00</h5>
                                        <p class="text-secondary">33 days to pay gas bill</p>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <button class="btn btn-40 bg-default-light text-default rounded-circle">
                                            <i class="material-icons">local_atm</i>
                                        </button>
                                    </div>
                                </div>
                                <div class="progress h-5 mt-3">
                                    <div class="progress-bar bg-default" role="progressbar" style="width: 65%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </main>

    <!-- footer-->
    @include($activeTemplate . 'includes.bottom_nav')


    
</body>

@endsection

@push('script')
<script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>

<script>
    (function ($) {
        "use strict";
        // apex-bar-chart js
        var options = {
        series: [{
        name: '<p class="text-primary">Clicks</p>',
        data: [
            @foreach($chart['click'] as $key => $click)
                {{ $click }},
            @endforeach
        ]
        }, {
        name: '<p class="text-success">Earn Amount</p>',
        data: [
                @foreach($chart['amount'] as $key => $amount)
                    {{ $amount }},
                @endforeach
        ]
        }],
        chart: {
        type: 'bar',
        height: 580,
        toolbar: {
            show: false
        }
        },
        plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
        },
        xaxis: {
        categories: [
        @foreach($chart['amount'] as $key => $amount)
                    '{{ $key }}',
                @endforeach
        ],
        },
        fill: {
        opacity: 1
        },
        tooltip: {
        y: {
            formatter: function (val) {
            return val
            }
        }
        }
        };
        var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
        chart.render();
            function createCountDown(elementId, sec) {
                var tms = sec;
                var x = setInterval(function() {
                    var distance = tms*1000;
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    document.getElementById(elementId).innerHTML =days+"d: "+ hours + "h "+ minutes + "m " + seconds + "s ";
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById(elementId).innerHTML = "{{__('COMPLETE')}}";
                    }
                    tms--;
                }, 1000);
            }
        createCountDown('counter', {{\Carbon\Carbon::tomorrow()->diffInSeconds()}});
    })(jQuery);
</script>
@endpush