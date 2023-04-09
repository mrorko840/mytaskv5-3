@extends($activeTemplate.'layouts.master')
@section('content')

@php
    $yourLinks = getContent('links.content', true);
    $total_task = $user->daily_limit;
    if ($total_task > 0) {
        $remain_task_ratio = 100 * (($total_task - $user->clicks->where('view_date',Date('Y-m-d'))->count()) / $total_task);
        $complete_task_ratio = 100 * ($user->clicks->where('view_date',Date('Y-m-d'))->count() / $total_task);
    }
@endphp

<!-- App download Modal -->
@include('templates.basic.includes.app_down_modal')
    
<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">

        @include(activeTemplate().'includes.side_nav')
        
        <!-- Cover Photo -->
        <div style="background-image: url({{ getImage('assets/images/user/cover/'.$user->cover_image) }})" class="coverPhoto"></div>
        <div class="text-right">
            <form id="coverImgForm">
                <div class="avatar-edit">
                    <input type='file' class="coverPicUpload" id="cover_image" name="cover_image" accept=".png, .jpg, .jpeg" hidden/>
                    <label id="coverPhotoSpin" 
                        style="position: inherit;" 
                        {{-- class="text-white bg-orange coverEdit"  --}}
                        for="cover_image">
                        {{-- <span  class="material-icons">photo_camera</span> --}}
                    </label>
                </div>
            </form>
        </div>

        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">
            <!-- Fixed navbar -->
            @include(activeTemplate().'includes.top_nav')

            <div class="container-fluid top-220 text-left mb-4">
                <img class="profile-thumb rounded-circle loadProfilePhoto" width="150px" src="{{ getImage(imagePath()['profile']['user']['path'].'/'. @$user->image,imagePath()['profile']['user']['size']) }}" alt="">
                <form id="imgForm">
                    <div class="avatar-edit">
                        <input type='file' class="profilePicUpload" id="image" name="image" accept=".png, .jpg, .jpeg" hidden/>
                        <label  class="text-white bg-orange imgEdit" for="image">
                            <span class="material-icons">photo_camera</span>
                        </label>
                    </div>
                </form>
            </div>

            <div class="container mx-2 mb-4 text-left text-white">
                <h6 class="mb-1">{{ __($user->fullname) }}</h6>
                <p>{{@$user->address->country}}</p>
            </div>

            <div class="main-container">

                
                <div class="container mb-4">
                    <div class="row mb-4">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-default px-2 btn-block rounded" data-toggle="modal" data-target="#QrCodeModal">
                                <span class="material-icons mr-1">
                                    qr_code_scanner
                                </span> 
                                Share QR
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('plans') }}" class="btn btn-outline-default px-2 btn-block rounded">
                                <span class="material-icons mr-1">
                                    diamond
                                </span> 
                                @if($user->plan)
                                    @if($user->expire_date > now()) {{ __($user->plan->name) }} @endif 
                                    @if($user->expire_date < now()) <span class="text-danger">(@lang('Expired'))</span> @endif
                                @else
                                    @lang('No Plan')
                                @endif
                            </a>
                        </div>
                    </div>

                    <!-- Wallet Card -->
                    {{-- <div class="container">
                        <div class="wallet-card">
                            <!-- Balance -->
                            <div class="balance">
                                <div class="left">
                                    <span class="title">My Balance</span>
                                    <h1 class="total">{{ $general->cur_sym }} {{ showAmount($user->balance) }}</h1>
                                </div>
                                <div align="center" class="right">
                                    <a href="{{ route('plans') }}" class="text-primary">

                                        <div class="chip chip-media">
                                            <i class="chip-icon bg-primary">
                                                <ion-icon style="font-size:20px;" name="basket" role="img" class="md hydrated"
                                                    aria-label="person"></ion-icon>
                                            </i>
                                            <span class="chip-label">{{ __($user->plan ? $user->plan->name : 'No Plan') }}</span>
                                        </div>



                                    </a>
                                </div>
                            </div>
                            <!-- * Balance -->
                            <!-- Wallet Footer -->
                            <div class="wallet-footer">
                                <div class="item">
                                    <a href="{{ route('user.deposit') }}">
                                        <div class="shadow icon-wrapper bg-warning bg-gradiant">
                                            <ion-icon name="arrow-up-outline"></ion-icon>
                                        </div>
                                        <strong>Deposit</strong>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ route('user.referred') }}">
                                        <div class="shadow icon-wrapper bg-secondary bg-gradiant">
                                            <ion-icon name="person-add-outline"></ion-icon>
                                        </div>
                                        <strong>Invite</strong>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ route('user.withdraw') }}">
                                        <div class="shadow icon-wrapper bg-success bg-gradiant">
                                            <ion-icon name="arrow-down-outline"></ion-icon>
                                        </div>
                                        <strong>Withdraw</strong>
                                    </a>
                                </div>
                            </div>
                            <!-- * Wallet Footer -->
                        </div>
                    </div> --}}
                    <!-- Wallet Card -->

                    <div class="card border-0 mb-3 bg-default-secondary text-white">
                        <div class="card-header mt-2">
                            <h6 class="mb-0">My Balance</h6>
                            <h3>{{ $general->cur_sym }} {{ showAmount($user->balance) }}</h3>
                        </div>
                        
                        <div class="card-footer">
                            <div class="row justify-content-center mb-3">

                                <div style="flex-direction: column;" class="col d-flex justify-content-center align-items-center">
                                    <a class="d-flex blalnceCardBtn" 
                                        href="javascript:void(0)" data-toggle="modal" data-target="#depositModal">
                                        <span class="material-icons">
                                            arrow_downward
                                        </span>
                                    </a>
                                    <div class="text-center pt-1">
                                        Deposit
                                    </div>
                                </div>
                                <div style="flex-direction: column;" class="col d-flex justify-content-center align-items-center">
                                    <a class="d-flex blalnceCardBtn" href="javascript:void(0)" 
                                        @if ($general->balance_transfer == 0) 
                                            onclick="notifyMsg('User balance transfer currently disabled!','error')" 
                                        @else 
                                            data-toggle="modal" data-target="#transferModal" 
                                        @endif>
                                        <span class="material-icons">
                                            swap_horiz
                                        </span>
                                    </a>
                                    <div class="text-center pt-1">
                                        Transfer
                                    </div>
                                </div>
                                <div style="flex-direction: column;" class="col d-flex justify-content-center align-items-center">
                                    <a class="d-flex blalnceCardBtn" href="javascript:void(0)" data-toggle="modal" data-target="#withdrawModal">
                                        <span class="material-icons">
                                            arrow_upward
                                        </span>
                                    </a>
                                    <div class="text-center pt-1">
                                        Withdraw
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Task Ratio -->
                    {{-- <div class="row">

                        <div class="col-12 col-md-6 pb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1">Remain Today: <span class="text-orange">{{ $user->daily_limit - $user->clicks->where('view_date',Date('Y-m-d'))->count() }} Task</span></h6>
                                            <p class="text-secondary">Remain Rario: 
                                                <span class="text-orange">
                                                    {{ round(@$remain_task_ratio) }} %
                                                </span>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="progress h-5 mt-3">
                                        <div class="progress-bar bg-orange" role="progressbar" style="width:{{ round(@$remain_task_ratio) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1">Complete Today: <span class="text-default">{{ $user->clicks->where('view_date',Date('Y-m-d'))->count() }} Task</span></h6>
                                            <p class="text-secondary">Complete Rario: 
                                                <span class="default">
                                                    {{ round(@$complete_task_ratio) }} %
                                                </span>
                                            </p>

                                        </div>
                                    </div>
                                    <div class="progress h-5 mt-3">
                                        <div class="progress-bar bg-default" role="progressbar" style="width:{{ round(@$complete_task_ratio) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>

                <!-- Profile Settings -->
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Profile</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="list-group list-group-flush border-top border-color">
                                
                                <a href="{{ route('user.profile.setting') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-default-light text-default rounded-right">
                                                <span class="material-icons">manage_accounts</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Profile Setting</h6>
                                            <p class="text-secondary">Update account informations</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="{{ route('user.address.setting') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-default-light text-default rounded-right">
                                                <span class="material-icons">location_city</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">My Address</h6>
                                            <p class="text-secondary">Update Address informations</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('user.change.password') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-default-light text-default rounded-right">
                                                <span class="material-icons">lock_open</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Security Settings</h6>
                                            <p class="text-secondary">Change Password</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports -->
                <div class="container mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Reports</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="list-group list-group-flush border-top border-color">
                                
                                <a href="{{ route('user.commissions') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-success-light text-success rounded-right">
                                                <span class="material-icons">bubble_chart</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Commissions</h6>
                                            <p class="text-secondary">Commissions from myTeam</p>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('user.transactions') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-success-light text-success rounded-right">
                                                <span class="material-icons">bar_chart</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Transactions</h6>
                                            <p class="text-secondary">All Transactions Here</p>
                                        </div>
                                    </div>
                                </a>
                                
                                <a href="{{ route('user.deposit.history') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-success-light text-success rounded-right">
                                                <span class="material-icons">history_toggle_off</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Deposit History</h6>
                                            <p class="text-secondary">All deposit records here.</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{ route('user.withdraw.history') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-success-light text-success rounded-right">
                                                <span class="material-icons">history_toggle_off</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Withdraw History</h6>
                                            <p class="text-secondary">All withdraw records here.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Others -->
                <div class="container mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Others</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="list-group list-group-flush border-top border-color">
                                
                                <a href="{{ route('user.referred') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-warning-light text-warning rounded-right">
                                                <span class="material-icons">groups</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">My Team</h6>
                                            <p class="text-secondary">See Team Earning Informations</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#appDownloadModal" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-warning-light text-warning rounded-right">
                                                <span class="material-icons">system_update</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Download App</h6>
                                            <p class="text-secondary">Install Our Offical Application</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exit -->
                <div class="container mt-3">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Exit</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="list-group list-group-flush border-top border-color">
                                <a href="{{ route('user.logout') }}" class="list-group-item list-group-item-action border-color">
                                    <div class="row">
                                        <div class="col-auto pl-0">
                                            <div class="avatar avatar-50 bg-danger-light text-danger rounded-right">
                                                <span class="material-icons">power_settings_new</span>
                                            </div>
                                        </div>
                                        <div class="col align-self-center pl-0">
                                            <h6 class="mb-1">Logout</h6>
                                            <p class="text-secondary">Logout from the application</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <!-- QrCode Modal -->

        <div class="modal fade" id="QrCodeModal" tabindex="-1" role="dialog" aria-labelledby="QrCodeModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="QrCodeModalCenterTitle">Invite with - QR Code</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div align="center" class="modal-body">
                        <img src="https://chart.googleapis.com/chart?cht=qr&chl={{ route('user.register') }}/{{ auth()->user()->username }}&chs=180x180&choe=UTF-8&chld=L|2" alt="QR Code">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

</body>

@include(activeTemplate() . 'includes.bottom_nav')

@push('style-custom')
    <style>
        .blalnceCardBtn {
            height: 50px !important; 
            width: 50px !important; 
            box-shadow: 0 0 0.5rem 0px #00000040 !important;
            border-radius: 1.3rem !important;
            color: #fff !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .coverPhoto{
            margin-top: 60px !important;
            background-size: cover;
            background-repeat: no-repeat;
            height: 170px;
            width: 100%;
            background-position: center;
            position: cover;
        }

        .top-220 {
            margin-top: -220px;
        }

        .profile-thumb {
            padding: 0.18rem !important;
            background-color: #3d5fa5 !important;
            border: 1px solid #3d5fa5 !important;
            max-width: 100%;
            height: auto;
            transition: ease all 0.5s;
            -webkit-transition: ease all 0.5s;
        }

        .darkmode .profile-thumb {
            background-color: #0f0b04 !important;
            border: 1px solid #0f0b04 !important;
        }
    </style>
    <style>
        .avatar-edit label {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            text-align: center;
            line-height: 41px;
            border: 3px solid #3d5fa5;
            font-size: 18px;
            cursor: pointer;
            position: absolute;
            transition: ease all 0.5s;
            -webkit-transition: ease all 0.5s;
        }
        .avatar-edit{
            transition: ease all 0.5s;
            -webkit-transition: ease all 0.5s;
        }
        .darkmode .avatar-edit {
            background-color: #040910;
        }
        .darkmode .avatar-edit label {
            border: 3px solid #040910 !important;
        }
        .imgEdit {
            margin-left: 6.3rem !important;
            margin-top: -2.6rem !important;
        }
        .coverEdit {
            margin-right: 0.3rem !important;
            margin-top: -45px !important;
        }
    </style>
@endpush

@push('script')
    <script>

        $(".profilePicUpload").on('change', function(e) {
            e.preventDefault();
            //loading
            $('.loadProfilePhoto').attr('src', "{{asset('assets/images/profile_loading.gif')}}");
            $.ajax({
                method: "POST",
                url: "{{route('user.profile.photo')}}",
                data: new FormData($("#imgForm")[0]),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {
                    console.log(res.msg);
                    $('.loadProfilePhoto').attr('src', "{{route('home')}}/"+res.img);
                    // $('.profilePhoto').attr('style', '');
                    $('.profilePhoto').attr('style', "background-image: url('{{route('home')}}/"+res.img+"');");
                    notifyMsg(res.msg,res.cls)
                },
                error: function (err) {
                    let msg = err.responseJSON['message'];
                    notifyMsg(msg,'error')
                }
            });

        });

        //cover-photo Upload//
        $(".coverPicUpload").on('change', function(e) {
            e.preventDefault();
            //loading
            $('.coverPhoto').attr('style', "background-image: url('{{asset('assets/images/cover_loading.gif')}}');");
            $.ajax({
                method: "POST",
                url: "{{route('user.cover.photo')}}",
                data: new FormData($("#coverImgForm")[0]),
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {
                    console.log(res.msg);
                    notifyMsg(res.msg,res.cls);
                    $('.coverPhoto').attr('style', "background-image: url('{{route('home')}}/"+res.img+"');");
                },
                error: function (err) {
                    let msg = err.responseJSON['message'];
                    notifyMsg(msg,'error')
                }
            });

        });
    </script>
@endpush
@endsection
