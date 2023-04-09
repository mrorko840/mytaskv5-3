@extends($activeTemplate.'layouts.master')
@section('content')




<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- Begin page content -->
    <main class="flex-shrink-0 main">

        @include(activeTemplate() . 'includes.top_nav_mini')

        <!-- page content start -->
        <div class="container mb-4 text-center text-white">
            <div class="row">
                <div class="col col-sm-8 col-md-6 col-lg-5 mx-auto">
                    <img src="{{ asset($activeTemplateTrue . 'assets/img/refer.png') }}" alt="" class="mw-100 mb-4">
                    <h5>Invite your contacts<br>or Friends and Earn Rewards</h5>
                </div>
            </div>
        </div>
        <div class="main-container">
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
                                <h6 class="mb-1">Refer and Earn Rewards</h6>
                                <p class="small text-secondary">Share your referal link and start earning</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mb-4">
                <div class="alert alert-success d-none" id="successmessage">Refferal link copied</div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="refferal Link"
                        value="{{ route('user.register') }}/{{ auth()->user()->username }}" id="link">
                    <div class="input-group-append">
                        <button class="btn btn-default rounded" type="button" id="basic-addon2"
                            onclick="copyRefLink()">Copy link</button>
                    </div>
                </div>
                <p class="text-center text-secondary">Share link to social</p>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="avatar avatar-40 rounded mx-2">
                            <div class="background">
                                <img src="{{ asset($activeTemplateTrue . 'assets/img/whatsapp.png') }}" alt="">
                            </div>
                        </div>
                        <div class="avatar avatar-40 rounded mx-2">
                            <div class="background">
                                <img src="{{ asset($activeTemplateTrue . 'assets/img/facebook.png') }}" alt="">
                            </div>
                        </div>
                        <div class="avatar avatar-40 rounded mx-2">
                            <div class="background">
                                <img src="{{ asset($activeTemplateTrue . 'assets/img/instagram.png') }}" alt="">
                            </div>
                        </div>
                        <div class="avatar avatar-40 rounded mx-2">
                            <div class="background">
                                <img src="{{ asset($activeTemplateTrue . 'assets/img/twitter.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            

            <div class="container mb-4">
                <h6 class="subtitle mb-3">Recently Invited friends</h6>
                <div class="swiper-container swiper-users text-center mb-4">
                    <div class="swiper-wrapper">

                        @forelse($refUsers as $data)
                            <div class="swiper-slide">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <div class="avatar avatar-60 rounded mb-1">
                                            <div class="background">
                                            <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . @$data->image, imagePath()['profile']['user']['size']) }}" alt="">
                                            </div>
                                        </div>
                                        <p class="text-secondary mb-0"><small>{{ __($data->username) }}</small></p>
                                        <p class="text-info"><small>{{ __($data->plan ? $data->plan->name : "No Plan") }}</small></p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div>
                                <div align="center" colspan="100%" class="text-center text-danger">{{ __($emptyMessage) }}!</div>
                            </div>
                        @endforelse

                    </div>
                </div>

                {{-- <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email addres">
                    <div class="input-group-append">
                        <button class="btn btn-default rounded" type="button" id="button-addon2">Invite</button>
                    </div>
                </div> --}}
                
            </div>
        </div>
    </main>
</body>








{{-- <section class="cmn-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-4">
                    <label>@lang('Referral Link')</label>
                    <div class="input-group">
                        <input type="text" value="{{ route('home') }}?reference={{ $user->username }}"
                        class="form-control form-control-lg" id="referralURL"
                        readonly>
                        <button class="input-group-text copytext px-3 text--base" id="copyBoard"> <i class="fa fa-copy"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-30">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive--sm">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th>@lang('Full Name')</th>
                                    <th>@lang('User Name')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Mobile')</th>
                                    <th>@lang('Plan')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($refUsers as $log)
                                    <tr>
                                        <td data-label="@lang('Full Name')">{{ __($log->fullname) }}</td>
                                        <td data-label="@lang('User Name')">{{ __($log->username) }}</td>
                                        <td data-label="@lang('Email')">{{ $log->email }}</td>
                                        <td data-label="@lang('Phone')">{{ $log->mobile }}</td>
                                        <td data-label="@lang('Plan')">{{ __($log->plan ? $log->plan->name : "No Plan") }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%" class="text-center"> {{ __($emptyMessage) }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{paginateLinks($refUsers)}}
            </div>
        </div>
    </div>
</section> --}}
@endsection
@push('style')
<style type="text/css">
    .copytextDiv{
        border:1px solid #00000021;
        cursor: pointer;
    }
    #referralURL{
        border-right: 1px solid #00000021;
    }
    .bg-success-custom{
        background-color: #28a7456e!important;
    }
    .brd-success-custom{
        border: 1px dashed #28a745;
    }
</style>
@endpush
@push('script')
    <script>
        "use strict";

        $('.main-wrapper').addClass('section--bg');

        "use strict";

        const copyRefLink = () => {
            var copyText = document.getElementById("link");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            notify('success', "Copied: " + copyText.value);
        }
    </script>
@endpush

{{-- @push('script')
<script type="text/javascript">
    (function ($) {
        "use strict";
        $('#copyBoard').click(function(){
            var copyText = document.getElementById("referralURL");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            /*For mobile devices*/
            document.execCommand("copy");
            iziToast.success({message: "Copied: " + copyText.value, position: "topRight"});
        });
    })(jQuery);
</script>
@endpush --}}


