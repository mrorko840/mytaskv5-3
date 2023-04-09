@extends($activeTemplate .'layouts.frontend')
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
            <div class="container mb-3">

                @foreach($blogs as $blog)
                <div class="card mb-3">
                    <div class="card-header">
                        <img src="{{ getImage('assets/images/frontend/blog/'.$blog->data_values->image) }}" alt="image" class="w-100 border-custom">
                    </div>
                    <div class="card-body pt-0">
                        <h5 class="blog-post__title">{{ __($blog->data_values->title) }}</h4>
                        <p>{{ strLimit(strip_tags($blog->data_values->description),80) }} <a href="{{ route('blogDetail',$blog->id) }}" class="item-link">View More</a></p>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h6 class="subtitle mb-0">
                            <div class="avatar avatar-40 bg-danger-light text-danger rounded mr-2">
                                <span class="material-icons vm">
                                    contact_mail
                                </span>
                            </div>
                            {{ __($contact->data_values->heading) }}
                        </h6>
                    </div>
                    <div class="card-body pt-0">
                        <form action="" class="contact-form verify-gcaptcha mt-50" id="contact_form_submit"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <input type="text" name="name" class="form-control" id="contact-name"
                                        placeholder="@lang('Name')">
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="email" name="email" class="form-control" id="contact-email"
                                        placeholder="@lang('Email')">
                                </div>
                                <div class="form-group col-lg-12">
                                    <input type="text" name="subject" class="form-control" id="contact-email"
                                        placeholder="@lang('Subject')">
                                </div>
                                <div class="form-group col-lg-12">
                                    <textarea name="message" id="contact-message" class="form-control" placeholder="@lang('Write message')"></textarea>
                                </div>
                                <x-captcha></x-captcha>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary border-custom w-100">@lang('send message')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}


        </div>
    </main>

    <!-- footer-->
    @include($activeTemplate . 'includes.home.bottom_nav')



</body>

    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
