    @auth
        @php
            header('Location: user/dashboard');
            die();
        @endphp
    @endauth


    @extends($activeTemplate . 'layouts.frontend')
    @section('content')
        @include('templates.basic.liveonline')
        @php
            $banners = getContent('banner.element');
            $yourLinks = getContent('links.content', true);
            $fake_reviews = getContent('fake_review.element');
            $noticeCaption = getContent('notice.content', true);
        @endphp

        <!-- App download Modal -->
        @include('templates.basic.includes.app_down_modal')

        <body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">

            <style>
                a {
                    text-decoration: none !important;
                    text-decoration-color: none !important;
                }
            </style>

            <!-- Begin page content -->
            <main class="flex-shrink-0 main has-footer">
                <!-- Fixed navbar -->
                @include($activeTemplate . 'includes.home.top_nav')

                <div class="main-container">

                    <!-- page content start -->
                    <div class="container pb-3">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner border-custom shadow-sm">

                                @php $i=0; @endphp
                                @forelse($banners as $item)
                                    @php
                                        $actives = '';
                                    @endphp

                                    @if ($i == 0)
                                        @php $actives = 'active';@endphp
                                    @endif
                                    @php $i=$i+1; @endphp

                                    <div class="carousel-item <?= $actives ?>">
                                        <img class="d-block w-100"
                                            src="{{ getImage('assets/images/frontend/banner/' . $item->data_values->image) }}"
                                            alt="banner">
                                    </div>

                                @empty
                                @endforelse

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
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
                                                <span style="font-size: 17px" class="material-icons pr-1">groups</span>
                                                <b id="dynamic_counter"></b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mb-4">

                        <div class="row mb-3">

                            <div class="col pr-2">

                                <a href="{{ route('contact') }}">
                                    <div class="card border-0 mb-3">
                                        <div class="card-body">
                                            <div class="row align-items-center">

                                                <div class="col align-self-center pr-0">
                                                    <h6 class="mb-1">Help Center</h6>
                                                    <p class="small text-secondary">Click here</p>
                                                </div>

                                                <div class="col-auto">
                                                    <div
                                                        class="avatar avatar-50 border-0 bg-success-light rounded-circle text-success">
                                                        <i class="material-icons vm text-template">privacy_tip</i>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('income.guide') }}">
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">

                                                <div class="col align-self-center pr-0">
                                                    <h6 class="mb-1">Income Guide</h6>
                                                    <p class="small text-secondary">Click here</p>
                                                </div>

                                                <div class="col-auto">
                                                    <div
                                                        class="avatar avatar-50 border-0 bg-warning-light rounded-circle text-warning">
                                                        <i class="material-icons vm text-template">table_chart</i>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>

                            <div class="col pl-2">

                                <a href="{{ route('user.referred') }}">
                                    <div class="card h-100 border-0">
                                        <div class="card-body pb-0">
                                            <div class="row align-items-center">
                                                <div class="col-12 align-self-center">
                                                    <h6 class="mb-1">Invite Friends</h6>
                                                    <p class="small text-secondary">Click here</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer pt-0">
                                            <div class="text-right">
                                                <div class="avatar avatar-100 border-0 rounded text-danger">
                                                    <div class="background">
                                                        <img src="{{ asset($activeTemplateTrue . '/assets/img/home/reffer_home.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col pr-2">

                                <a href="{{ $yourLinks->data_values->video }}" target="blank">
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">

                                                <div class="col align-self-center pr-0">
                                                    <h6 class="mb-1">Video Tutorial</h6>
                                                    <p class="small text-secondary">Click here</p>
                                                </div>
                                                <div class="col-auto">
                                                    <div
                                                        class="avatar avatar-50 border-0 bg-danger-light rounded-circle text-danger">
                                                        <i class="material-icons vm text-template">smart_display</i>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>

                            <div class="col pl-2 ">

                                <a href="{{ route('blog') }}">
                                    <div class="card border-0 h-100">
                                        <div class="card-body">
                                            <div class="row align-items-center">

                                                <div class="col align-self-center pr-0">
                                                    <h6 class="mb-1">News</h6>
                                                    <p class="small text-secondary">Click here</p>
                                                </div>
                                                <div class="col-auto">
                                                    <div
                                                        class="avatar avatar-50 border-0 bg-purple-light rounded-circle text-purple">
                                                        <i class="material-icons vm text-template">newspaper</i>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>

                        </div>
                    </div>



                    <!-- PWA add to home display -->
                    <div class="container mb-4">
                        <div class="card" id="addtodevice">
                            <div class="card-body text-center">
                                <div class="row mb-3">
                                    <div class="col-10 col-md-4 mx-auto"><img
                                            src="{{ asset($activeTemplateTrue . 'assets/img/install-app.png') }}"
                                            alt="" class="mw-100"></div>
                                </div>

                                <h5 class="text-dark">Add to <span class="font-weight-bold">Home screen</span></h5>
                                <p class="text-secondary">See as in fullscreen on your device.</p>
                                <button data-toggle="modal" data-target="#appDownloadModal"
                                    class="btn btn-sm btn-default px-4 rounded" id="addtohome">Install</button>
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
                                                            <div class="background"><img
                                                                    src="{{ getImage('assets/images/frontend/fake_review/' . @$review->data_values->image) }}"
                                                                    alt=""></div>
                                                        </div>
                                                        <p class="text-secondary mb-0">
                                                            <small>{{ @$review->data_values->name }}</small>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col ">
                                                        <p class="mb-1">{{ @$review->data_values->review_text }}<small
                                                                class="text-success" hidden>28% <span
                                                                    class="material-icons small"
                                                                    hidden>call_made</span></small></p>
                                                        <p class="text-secondary small">
                                                            {{ showDateTime(@$review->updated_at, 'd-m-Y, h:i a') }}</p>
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
            @include($activeTemplate . 'includes.home.bottom_nav')



        </body>

        @if ($sections->secs != null)
            @foreach (json_decode($sections->secs) as $sec)
                @include($activeTemplate . 'sections.' . $sec)
            @endforeach
        @endif
    @endsection
