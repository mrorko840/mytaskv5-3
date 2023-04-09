@extends($activeTemplate.'layouts.master')
@section('content')
@include('templates.basic.liveonline')
@php
    $kycInfo = getContent('kyc_info.content',true);
    $fake_reviews = getContent('fake_review.element');
    $noticeCaption = getContent('notice.content',true);
    $banners = getContent('banner.element');
    $yourLinks = getContent('links.content', true);
@endphp

<!-- App download Modal -->
@include($activeTemplate . 'includes.app_down_modal')


<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- Top navbar -->
    @include($activeTemplate . 'includes.side_nav')

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav')

        <div class="container mt-3 mb-4 text-center">
            <h2 class="text-white">{{ $general->cur_sym }} {{ showAmount($user->balance) }}</h2>
            <p class="text-white mb-4">Total Balance</p>
        </div>

        <div class="main-container">
            <!-- Scroling Banner -->
            <div class="container pb-3">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    
                    <div class="carousel-inner border-custom shadow-sm">
        
                    @php $i=0; @endphp
                    @forelse($banners as $item)
                    @php 
                    $actives = ''; 
                    @endphp
        
                    @if($i==0)
                    @php $actives = 'active';@endphp
                    @endif
                    @php $i=$i+1; @endphp
        
                        <div class="carousel-item <?= $actives ?>">
                        <img class="d-block w-100" src="{{ getImage('assets/images/frontend/banner/' . $item->data_values->image) }}" alt="banner">
                        </div>
                    
                    @empty
        
                    @endforelse
        
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            


            <!-- Scroling Notice -->
            <div class="container mb-3">
                <div class="row mx-0">
                    <div class="col-12">
                        <div class="card border-0">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div
                                        class="col-auto d-flex align-items-center justify-content-center border-custom bg-warning-light text-warning">
                                        <span class="material-icons">campaign</span>
                                    </div>
                                    <div class="col align-items-center px-0 mx-0 pt-1">
                                        <marquee behavior="scroll" direction="left">
                                            @php
                                                echo $noticeCaption->data_values->scrolingNotice;
                                            @endphp
                                        </marquee>
                                    </div>
                                    <div style="font-size: 10px"
                                        class="col-auto d-flex align-items-center justify-content-center border-custom bg-default-secondary">
                                        <span style="font-size: 17px"
                                            class="material-icons pr-1">groups</span>
                                            <b id="dynamic_counter"></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-4 text-center">
                <div class="card bg-default-secondary shadow-default">
                    <div class="card-body">
                        <!-- Swiper -->
                        <div class="swiper-container addsendcarousel text-center">
                            <div class="swiper-wrapper mb-4">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#depositModal" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">add</span></div>
                                    <p><small>Deposit</small></p>
                                </a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#withdrawModal" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">call_received</span></div>
                                    <p><small>Withdraw</small></p>
                                </a>
                                <a class="swiper-slide text-white"href="javascript:void(0)" 
                                    @if ($general->balance_transfer == 0) 
                                        onclick="notifyMsg('User balance transfer currently disabled!','error')" 
                                    @else 
                                        data-toggle="modal" data-target="#transferModal" 
                                    @endif>
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">swap_horiz</span></div>
                                    <p><small>Transfer</small></p>
                                </a>
                                <a href="{{ route('user.deposit.history') }}" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">history</span></div>
                                    <p><small>Deposit History</small></p>
                                </a>
                                <a href="{{ route('user.withdraw.history') }}" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light"><span class="material-icons">update</span></div>
                                    <p><small>Withdraw History</small></p>
                                </a>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Total deposit and withdraw -->
            <div class="container mb-4">
                <div class="row">
                    <div class="col">
                        <h6 class="subtitle mb-3">Status </h6>
                    </div>
                    <div class="col-auto">
                        <a href="" class="text-default" hidden>View all</a>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-40 border-0 bg-success-light rounded-circle text-success">
                                            <i class="material-icons vm text-template">wallet</i>
                                        </div>
                                    </div>
                                    <div class="col align-self-center">
                                        <h6 class="mb-1">Deposit</h6>
                                        <p class="small text-secondary">(Total)</p>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <h6 class="mb-1 mt-1">{{ $general->cur_sym }} {{ showAmount($user->deposits->where('status',1)->sum('amount')) }}</h6>
                                        <p class="small text-secondary"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-40 border-0 bg-warning-light rounded-circle text-warning">
                                            <i class="material-icons vm text-template">account_balance</i>
                                        </div>
                                    </div>
                                    <div class="col align-self-center">
                                        <h6 class="mb-1">Withdraw</h6>
                                        <p class="small text-secondary">(Total)</p>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <h6 class="mb-1 mt-1">{{ $general->cur_sym }} {{ showAmount($user->withdrawals->where('status',1)->sum('amount')) }}</h6>
                                        <p class="small text-secondary"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container mb-4">
                
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-around">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-40 border-0 bg-warning-light rounded-circle text-warning">
                                            <i class="material-icons vm text-template">savings</i>
                                        </div>
                                    </div>
                                    <div align="left" class="col-3 align-self-center pl-0">
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($total_invest) }}</h6>
                                        <p class="small text-secondary">Total Invest</p>
                                    </div>
                                    
                                    <div align="right" class="col-3 align-items-center pr-0 border-left">
                                        {{-- <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($ptc->sum('amount') + $total_commission) }}</h6> --}}
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($total['earn'] + $total_commission) }}</h6>
                                        <p class="small text-secondary">Total Earn</p>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <div class="avatar avatar-40 border-0 bg-success-light rounded-circle text-success">
                                            <i class="material-icons vm text-template">currency_exchange</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-around">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-40 border-0 bg-danger-light rounded-circle text-danger">
                                            <i class="material-icons vm text-template">supervised_user_circle</i>
                                        </div>
                                    </div>
                                    <div align="left" class="col-3 align-self-center pl-0">
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($total_commission) }}</h6>
                                        <p class="small text-secondary">Team Earn</p>
                                    </div>
                                    
                                    <div align="right" class="col-3 align-items-center pr-0 border-left">
                                        <h6 class="mb-1">{{ $general->cur_sym }} {{ showAmount($today['earn']) }}</h6>
                                        <p class="small text-secondary">Today Earn</p>
                                    </div>
                                    <div class="col-auto pl-0">
                                        <div class="avatar avatar-40 border-0 bg-default-light rounded-circle text-default">
                                            <i class="material-icons vm text-template">monetization_on</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- PWA add to home display -->
            <div class="container mb-4">
                <div class="card" id="addtodevice">
                    <div class="card-body text-center">
                        <div class="row mb-3">
                            <div class="col-10 col-md-4 mx-auto"><img src="{{ asset($activeTemplateTrue . 'assets/img/install-app.png') }}" alt="" class="mw-100"></div>
                        </div>

                        <h5 class="text-dark">Add to <span class="font-weight-bold">Home screen</span></h5>
                        <p class="text-secondary">See  as in fullscreen on your device.</p>
                        <button data-toggle="modal" data-target="#appDownloadModal" class="btn btn-sm btn-default px-4 rounded" id="addtohome">Install</button>
                    </div>
                </div>
            </div>
            <!-- PWA add to home display -->

            <div class="container mb-4">
                <div class="card border-0 mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-50 border-0 bg-danger-light rounded-circle text-danger">
                                    <i class="material-icons vm text-template">card_giftcard</i>
                                </div>
                            </div>
                            <div class="col-auto align-self-center">
                                <h6 class="mb-1">3 Gift Cards</h6>
                                <p class="small text-secondary">Click here to see gift cards</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container ">
                <div class="row" hidden>
                    <div class="col text-center" >
                        <h5 class="subtitle">Most Exciting Feature</h5>
                        <p class="text-secondary">Take a look at our services</p>
                    </div>
                </div>
                {{-- <div class="row text-center mt-3">
                    <div class="col-6 col-md-3">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="avatar avatar-60 bg-warning-light rounded-circle text-warning">
                                    <i class="material-icons vm md-36 text-template">savings</i>
                                </div>
                                <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($total_invest) }}</h3>
                                <p class="text-secondary small">Total Invest</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="avatar avatar-60 bg-success-light rounded-circle text-success">
                                    <i class="material-icons vm md-36 text-template">add_shopping_cart</i>
                                </div>
                                <h3 class="mt-3 mb-0 font-weight-normal">{{ $general->cur_sym }} {{ showAmount($ptc->sum('amount') + $total_commission) }}</h3>
                                <p class="text-secondary small">Total Earned</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
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

                        <div class="swiper-slide">
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


            
            

        </div>
    </main>

    <!-- footer-->
    @include($activeTemplate . 'includes.bottom_nav')


    
</body>


@endsection
@push('script')
<script src="{{ asset('assets/admin/js/vendor/apexcharts.min.js') }}"></script>
<script>
    // (function ($) {
    //     "use strict";
    //     // apex-bar-chart js
    //     var options = {
    //     series: [{
    //     name: 'Clicks',
    //     data: [
    //         @foreach($chart['click'] as $key => $click)
    //             {{ $click }},
    //         @endforeach
    //     ]
    //     }, {
    //     name: 'Earn Amount',
    //     data: [
    //             @foreach($chart['amount'] as $key => $amount)
    //                 {{ $amount }},
    //             @endforeach
    //     ]
    //     }],
    //     chart: {
    //     type: 'bar',
    //     height: 580,
    //     toolbar: {
    //         show: false
    //     }
    //     },
    //     plotOptions: {
    //     bar: {
    //         horizontal: false,
    //         columnWidth: '55%',
    //         endingShape: 'rounded'
    //     },
    //     },
    //     dataLabels: {
    //     enabled: false
    //     },
    //     stroke: {
    //     show: true,
    //     width: 2,
    //     colors: ['transparent']
    //     },
    //     xaxis: {
    //     categories: [
    //     @foreach($chart['amount'] as $key => $amount)
    //                 '{{ $key }}',
    //             @endforeach
    //     ],
    //     },
    //     fill: {
    //     opacity: 1
    //     },
    //     tooltip: {
    //     y: {
    //         formatter: function (val) {
    //         return val
    //         }
    //     }
    //     }
    //     };
    //     var chart = new ApexCharts(document.querySelector("#apex-bar-chart"), options);
    //     chart.render();
    //         function createCountDown(elementId, sec) {
    //             var tms = sec;
    //             var x = setInterval(function() {
    //                 var distance = tms*1000;
    //                 var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    //                 var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //                 var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //                 var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    //                 document.getElementById(elementId).innerHTML =days+"d: "+ hours + "h "+ minutes + "m " + seconds + "s ";
    //                 if (distance < 0) {
    //                     clearInterval(x);
    //                     document.getElementById(elementId).innerHTML = "{{__('COMPLETE')}}";
    //                 }
    //                 tms--;
    //             }, 1000);
    //         }
    //     createCountDown('counter', {{\Carbon\Carbon::tomorrow()->diffInSeconds()}});
    // })(jQuery);
</script>
@endpush
