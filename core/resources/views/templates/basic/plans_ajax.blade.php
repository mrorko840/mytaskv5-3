
<div class="swiper mySwiper">
    <div class="swiper-wrapper">

        @foreach ($plans as $plan)
        <div class="swiper-slide">
            <div class="mx-2">
                <div class="card border-0
                @if ($loop->index == 0) bg-secondary
                @elseif($loop->index == 1)
                    bg-default
                @elseif($loop->index == 2)
                    bg-info
                @elseif($loop->index == 3)
                    bg-success
                @elseif($loop->index == 4)
                    bg-warning
                @elseif($loop->index == 5)
                    bg-danger
                @elseif($loop->index == 6)
                    bg-orange
                @elseif($loop->index == 7)
                    bg-purple 
                @else
                    bg-default @endif
                text-white">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-auto">
                                    <i class="material-icons vm text-template">diamond</i>
                                </div>
                                <div class="col pl-0">
                                    <h6 class="mb-1">{{ __($plan->name) }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="mb-0 mt-3">{{ $general->cur_sym }} {{ __(showAmount($plan->price)) }}</h5>
                                </div>
                                <div class="col">
                                    <p class="mb-0 mt-3 text-right">
                                        @lang('Daily Earn') {{ $general->cur_sym }} {{ $plan->ads_rate }} 
                                    </p>
                                </div>
                            </div>
        
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-0">{{ $plan->validity }} @lang('Days')</p>
                                    <p class="small ">Validity</p>
                                </div>
                                <div class="col-auto align-self-center text-right">
                                    @if (@auth()->user()->runningPlan && @auth()->user()->plan_id == $plan->id)
                                        <button
                                            class="package-disabled btn btn-sm border-custom btn-outline-light">@lang('Current')</button>
                                    @elseif(@auth()->user()->runningPlan && @auth()->user()->plan_id > $plan->id)
                                        <button
                                            class="package-disabled btn btn-sm border-custom btn-outline-light">@lang('Locked')</button>
                                    @else
                                        <button class="buyBtn btn btn-sm border-custom btn-outline-light"
                                            data-id="{{ $plan->id }}">@lang('BUY NOW')</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
    //   effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });
</script>

    




{{-- <swiper-container>
@foreach ($plans as $plan)
<swiper-slide>
    <div class="mx-2">
        <div class="card border-0
        @if ($loop->index == 0) bg-secondary
        @elseif($loop->index == 1)
            bg-default
        @elseif($loop->index == 2)
            bg-info
        @elseif($loop->index == 3)
            bg-success
        @elseif($loop->index == 4)
            bg-warning
        @elseif($loop->index == 5)
            bg-danger
        @elseif($loop->index == 6)
            bg-orange
        @elseif($loop->index == 7)
            bg-purple 
        @else
            bg-default @endif
        text-white">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto">
                            <i class="material-icons vm text-template">diamond</i>
                        </div>
                        <div class="col pl-0">
                            <h6 class="mb-1">{{ __($plan->name) }}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="mb-0 mt-3">{{ $general->cur_sym }} {{ __(showAmount($plan->price)) }}</h5>
                        </div>
                        <div class="col">
                            <p class="mb-0 mt-3 text-right">
                                @lang('Daily Earn') {{ $general->cur_sym }} {{ $plan->ads_rate }} 
                            </p>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <p class="mb-0">{{ $plan->validity }} @lang('Days')</p>
                            <p class="small ">Validity</p>
                        </div>
                        <div class="col-auto align-self-center text-right">
                            @if (@auth()->user()->runningPlan && @auth()->user()->plan_id == $plan->id)
                                <button
                                    class="package-disabled btn btn-sm border-custom btn-outline-light">@lang('Current')</button>
                            @elseif(@auth()->user()->runningPlan && @auth()->user()->plan_id > $plan->id)
                                <button
                                    class="package-disabled btn btn-sm border-custom btn-outline-light">@lang('Locked')</button>
                            @else
                                <button class="buyBtn btn btn-sm border-custom btn-outline-light"
                                    data-id="{{ $plan->id }}">@lang('BUY NOW')</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
</swiper-slide>
@endforeach
</swiper-container> --}}





{{-- @foreach ($plans as $plan)
    <div class="swiper-slide mx-2">
        <div class="card border-0
        @if ($loop->index == 0) bg-secondary
        @elseif($loop->index == 1)
            bg-default
        @elseif($loop->index == 2)
            bg-info
        @elseif($loop->index == 3)
            bg-success
        @elseif($loop->index == 4)
            bg-warning
        @elseif($loop->index == 5)
            bg-danger
        @elseif($loop->index == 6)
            bg-orange
        @elseif($loop->index == 7)
            bg-purple 
        @else
            bg-default @endif
        text-white">
                <div class="card-header">
                    <div class="row">
                        <div class="col-auto">
                            <i class="material-icons vm text-template">diamond</i>
                        </div>
                        <div class="col pl-0">
                            <h6 class="mb-1">{{ __($plan->name) }}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="mb-0 mt-3">{{ $general->cur_sym }} {{ __(showAmount($plan->price)) }}</h5>
                        </div>
                        <div class="col">
                            <p class="mb-0 mt-3 text-right">@lang('Daily') {{ $plan->daily_limit }}
                                @lang('Task')</p>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <p class="mb-0">{{ $plan->validity }} @lang('Days')</p>
                            <p class="small ">Validity</p>
                        </div>
                        
                        <div class="col-auto align-self-center text-right">
                            @if (@auth()->user()->runningPlan && @auth()->user()->plan_id == $plan->id)
                                <button
                                    class="package-disabled btn btn-sm border-custom btn-outline-light">@lang('Current')</button>
                            @elseif(@auth()->user()->runningPlan && @auth()->user()->plan_id > $plan->id)
                                <button
                                    class="package-disabled btn btn-sm border-custom btn-outline-light">@lang('Locked')</button>
                            @else
                                <button class="buyBtn btn btn-sm border-custom btn-outline-light"
                                    data-id="{{ $plan->id }}">@lang('BUY NOW')</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endforeach --}}

