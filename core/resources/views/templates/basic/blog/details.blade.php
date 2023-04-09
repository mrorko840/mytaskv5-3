@extends($activeTemplate . 'layouts.frontend')
@section('content')

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
            @include($activeTemplate . 'includes.home.top_nav_mini')

            <div class="main-container">

                <!-- page content start -->

                <div class="container mb-4">
                    <div class="card">
                        <div class="card-header">
                            <img class="border-custom"
                                src="{{ getImage('assets/images/frontend/blog/' . $blog->data_values->image) }}" width="100%"
                                alt="image">
                            <div class="text-center text-info">
                                <span class="date">{{ $blog->created_at->format('d') }}</span>
                                <span class="month">{{ $blog->created_at->format('M') }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="blog-details__title">{{ __($blog->data_values->title) }}</h4>
                            <p>@php echo $blog->data_values->description @endphp</p>
                        </div>
                    </div>
                </div>

                <!-- Recent News -->
                <div class="container mb-3">
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6 class="text-center mb-0">-= Recent News =-</h6>
                        </div>
                    </div>
                    @foreach ($latests as $blog)
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-60 rounded">
                                            <div class="background">
                                                <img src="{{ getImage('assets/images/frontend/blog/' . $blog->data_values->image) }}"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col align-self-center pr-0">
                                        <h6 class="font-weight-normal mb-1">
                                            <a href="{{ route('blogDetail', $blog->id) }}">
                                                {{ __($blog->data_values->title) }}
                                            </a>
                                        </h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>

        <!-- footer-->
        @include($activeTemplate . 'includes.home.bottom_nav')



    </body>



    {{-- <section class="blog-details-section pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog-details-wrapper">
                        <div class="blog-details__thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/' . $blog->data_values->image) }}"
                                alt="image">
                            <div class="post__date">
                                <span class="date">{{ $blog->created_at->format('d') }}</span>
                                <span class="month">{{ $blog->created_at->format('M') }}</span>
                            </div>
                        </div><!-- blog-details__thumb end -->
                        <div class="blog-details__content">
                            <h4 class="blog-details__title">{{ __($blog->data_values->title) }}</h4>
                            <p>@php echo $blog->data_values->description @endphp</p>
                        </div><!-- blog-details__content end -->
                        <div class="blog-details__footer">
                            <h4 class="caption">@lang('Share This Post')</h4>
                            <ul class="social__links">
                                <li><a
                                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a
                                        href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-twitter"></i></a></li>
                                <li><a
                                        href="https://pinterest.com/pin/create/bookmarklet/?media={{ asset('assets/images/frontend/blog') . '/' . $blog->data_values->image }}&url={{ urlencode(url()->current()) }}&is_video=[is_video]&description={{ $blog->data_values->title }}"><i
                                            class="fab fa-pinterest-p"></i></a></li>
                                <li><a
                                        href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}"><i
                                            class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div><!-- blog-details__footer end -->
                    </div><!-- blog-details-wrapper end -->
                    <div class="comment-form-area">
                        <div class="fb-comments" data-href="{{ route('blogDetail', $blog->id) }}" data-width=""
                            data-numposts="5"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="sidebar">
                        <div class="widget">
                            <h5 class="widget__title">@lang('Recent Posts')</h5>
                            <ul class="small-post-list">
                                @foreach ($latests as $recent)
                                    <li class="small-post">
                                        <div class="small-post__thumb"><img
                                                src="{{ getImage('assets/images/frontend/blog/thumb_' . $recent->data_values->image) }}"
                                                alt="image"></div>
                                        <div class="small-post__content">
                                            <h5 class="post__title"><a
                                                    href="{{ route('blogDetail', $recent->id) }}">{{ __($recent->data_values->title) }}</a>
                                            </h5>
                                        </div>
                                    </li>
                                @endforeach
                            </ul><!-- small-post-list end -->
                        </div><!-- widget end -->
                        <div class="widget">
                            <h5 class="widget__title">@lang('Most Views')</h5>
                            <ul class="small-post-list">
                                @foreach ($popular as $view)
                                    <li class="small-post">
                                        <div class="small-post__thumb"><img
                                                src="{{ getImage('assets/images/frontend/blog/thumb_' . $view->data_values->image) }}"
                                                alt="image"></div>
                                        <div class="small-post__content">
                                            <h5 class="post__title"><a
                                                    href="{{ route('blogDetail', $view->id) }}">{{ __($view->data_values->title) }}</a>
                                            </h5>
                                        </div>
                                    </li>
                                @endforeach
                            </ul><!-- small-post-list end -->
                        </div><!-- widget end -->
                    </div><!-- sidebar end -->
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
