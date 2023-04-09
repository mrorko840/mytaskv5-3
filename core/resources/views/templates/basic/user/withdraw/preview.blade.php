@extends($activeTemplate.'layouts.master')
@section('content')

@php
    $user = auth()->user();    
@endphp


<style>
    .form-control {
        line-height: 1.2 !important;
    }
</style>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">

        @include(activeTemplate() . 'includes.top_nav_mini')
        <div class="pt-120 pb-120">
            <div class="main-container">
                <div class="row justify-content-center">
                    <div class="col mx-3">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5 class="card-title">@lang('Withdraw Via') {{ $withdraw->method->name }}</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{route('user.withdraw.submit')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2">
                                        @php
                                        echo $withdraw->method->description;
                                        @endphp
                                    </div>
                                    <x-viser-form identifier="id" identifierValue="{{ $withdraw->method->form_id }}" />
                                    @if(auth()->user()->ts)
                                    <div class="form-group">
                                        <label>@lang('Google Authenticator Code')</label>
                                        <input type="text" name="authenticator_code" class="form-control form--control" required>
                                    </div>
                                    @endif
                                    <div>
                                        <button type="submit" class="btn btn-warning border-custom w-100">@lang('Submit')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>



{{-- <div class="cmn-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card custom--card">
                    <div class="card-header">
                        <h5 class="title">@lang('Withdraw Via') {{ $withdraw->method->name }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('user.withdraw.submit')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                @php
                                    echo $withdraw->method->description;
                                @endphp
                            </div>
                            <x-viser-form identifier="id" identifierValue="{{ $withdraw->method->form_id }}"></x-viser-form>
                            @if(auth()->user()->ts)
                            <div class="form-group">
                                <label>@lang('Google Authenticator Code')</label>
                                <input type="text" name="authenticator_code" class="form-control form--control" required>
                            </div>
                            @endif
                            <div class="form-group">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection