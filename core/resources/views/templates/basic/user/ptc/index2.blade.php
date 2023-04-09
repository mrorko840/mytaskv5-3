@extends($activeTemplate . 'layouts.master')
@section('content')

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

                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a style="background-color: #fff0;" class="nav-link active" id="yt-tab" data-toggle="tab" href="#yt" role="tab"
                            aria-controls="yt" aria-selected="true">Youtube</a>
                    </li>
                    <li class="nav-item">
                        <a style="background-color: #fff0;" class="nav-link" id="web-tab" data-toggle="tab" href="#web" role="tab"
                            aria-controls="web" aria-selected="false">Website</a>
                    </li>
                    <li class="nav-item">
                        <a style="background-color: #fff0;" class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Instagram</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="yt" role="tabpanel" aria-labelledby="yt-tab">
                        <div class="mt-4">
                            
                            @forelse($ads as $ad)
                                @if($ad->ads_type == 4 && $ad->plan_id == $user->plan_id)
                                    <div class="container">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col-auto pr-0">
                                                        <div class="avatar avatar-50 rounded">
                                                            <div class="background">
                                                                @if ($ad->ads_type == 4)
                                                                    <img src="{{ asset($activeTemplateTrue . '/assets/img/services/yt_logo.png') }}" alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col align-self-center pr-0">
                                                        <h6 class="font-weight-normal mb-1">
                                                            {{ __($ad->title) }}
                                                        </h6>
                                                        <p class="small text-secondary">
                                                            Ads duration: <b class="text-info">{{ $ad->duration }}s</b>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto text-right">
                                                        {{ $general->cur_sym }}{{ showAmount($ad->amount) }}
                                                        <br>
                                                        <a href="{{ route('user.ptc.show', encrypt($ad->id . '|' . auth()->user()->id)) }}"
                                                            class="btn btn-sm btn-info border-custom mt-2"
                                                            style="font-size: 0.8rem;line-height: 1;">
                                                            @lang('View Ad')
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                            <p>Data not found</p>
                            @endforelse
                            
                        </div>
                    </div>

                    <div class="tab-pane fade" id="web" role="tabpanel" aria-labelledby="web-tab">
                        <div class="mt-4">
                            
                            @forelse($ads as $ad)
                                @if($ad->ads_type == 1 && $ad->plan_id == $user->plan_id)
                                    <div class="container">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col-auto pr-0">
                                                        <div class="avatar avatar-50 rounded">
                                                            <div class="background">
                                                                @if ($ad->ads_type == 1)
                                                                    <img src="{{ asset($activeTemplateTrue . '/assets/img/services/web_logo.png') }}"
                                                                        alt="">
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col align-self-center pr-0">
                                                        <h6 class="font-weight-normal mb-1">
                                                            {{ __($ad->title) }}
                                                        </h6>
                                                        <p class="small text-secondary">
                                                            Ads duration: <b class="text-info">{{ $ad->duration }}s</b>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto text-right">
                                                        {{ $general->cur_sym }}{{ showAmount($ad->amount) }}
                                                        <br>
                                                        <a href="{{ route('user.ptc.show', encrypt($ad->id . '|' . auth()->user()->id)) }}"
                                                            class="btn btn-sm btn-info border-custom mt-2"
                                                            style="font-size: 0.8rem;line-height: 1;">
                                                            @lang('View Ad')
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p>Data not found</p>
                            @endforelse
                            
                        </div>
                    </div>

                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        Coming Soon....
                    </div>

                </div>
                
            </div>
        </main>

        <!-- footer-->
        @include($activeTemplate . 'includes.bottom_nav')



    </body>
    
@endsection
