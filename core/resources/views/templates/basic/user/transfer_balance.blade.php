@extends($activeTemplate.'layouts.master')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="sendmoney">
    




    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        @include($activeTemplate . 'includes.top_nav_mini')

        <div class="container mb-4 text-center">
            <div class="row mb-4 justify-content-center">
                <div class="col-auto">
                    <div class="icon icon-40 bg-default-light text-default mb-2 rounded-circle"><span class="material-icons">account_circle</span> </div>
                    <p class="small text-white">Contact</p>
                </div>
                <div class="col-auto">
                    <div class="icon icon-40 bg-default-light text-default mb-2 rounded-circle"><span class="material-icons">qr_code_scanner</span> </div>
                    <p class="small text-white">QR Code</p>
                </div>
                <div class="col-auto">
                    <div class="icon icon-40 bg-default-light text-default mb-2 rounded-circle"><span class="material-icons">account_balance</span> </div>
                    <p class="small text-white">Bank</p>
                </div>
                <div class="col-auto">
                    <div class="icon icon-40 bg-default-light text-default mb-2 rounded-circle"><span class="material-icons">account_balance_wallet</span> </div>
                    <p class="small text-white">Wallet</p>
                </div>
            </div>
        </div>

        <div class="main-container">  
            <form action="" method="post" enctype="multipart/form-data">
                @csrf          
                <div class="container mb-4">
                    <p class="text-center text-secondary mb-1">Enter Amount to send</p>
                    <p class="text-center">
                        <small class="text-success text-center">( @lang('Charge'): {{ getAmount($general->bt_fixed) }} {{ $general->cur_text }} + {{ getAmount($general->bt_percent) }}% )</small>
                    </p>
                    <div class="form-group mb-1">
                        <input type="number" step="any" name="amount" class="form-control large-gift-card" value="{{ old('username') }}" placeholder="00.00">
                    </div>
                    <p class="text-center text-secondary mb-4">
                        Available: {{$general->cur_sym}} {{showAmount($user->balance)}} <br>
                        <input type="text" class="form-control text-center text-danger calculation" placeholder="Amount Will Cut From Your Account" readonly>
                    </p>

                    
                    <div class="swiper-container swiper-users text-center mb-3">
                        <div class="swiper-wrapper">
                            @forelse($AllUsers as $data)
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-body p-2">
                                            <div class="avatar avatar-60 rounded mb-1">
                                                <div class="background"><img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . @$data->image, imagePath()['profile']['user']['size']) }}" alt=""></div>
                                            </div>
                                            <p class="text-secondary"><small>{{$data->username}}</small></p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>

                    <div class=" mb-1">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="custom-control custom-switch">
                                            <input type="radio" name="paynow" class="custom-control-input" id="pay1" checked="">
                                            <label class="custom-control-label" for="pay1"></label>
                                        </div>
                                    </div>
                                    <div class="col pl-0">
                                        <h6 class="subtitle mb-0">Pay from wallet</h6>
                                    </div>
                                    {{-- <div class="col-auto pl-0">
                                        <p class="text-secondary text-center"><a href="addfund.html">Add</a></p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <input type="text" name="username" class="form-control checkUser" placeholder="username">
                    </div>

                    {{-- <div class="form-group">
                        <textarea class="form-control" placeholder="Your Message"></textarea>
                    </div> --}}

                </div>

                <div class="container text-center">
                    <button type="submit" class="btn btn-default mb-2 mx-auto rounded">Transfer Now</button>
                </div>
            </form>
        </div>

    </main>


    
    
</body>









{{-- <div class="cmn-section">
    <div class="container">
        <div class="card">
            <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>@lang('Username')</label>
                    <input type="text" name="username" class="form-control checkUser">
                    <small class="text-danger usernameExist"></small>
                </div>
                <div class="form-group">
                    <label>@lang('Amount') <small class="text--success">( @lang('Charge'): {{ getAmount($general->bt_fixed) }} {{ $general->cur_text }} + {{ getAmount($general->bt_percent) }}% )</small></label>
                    <div class="input-group">
                        <input type="number" step="any" name="amount" value="{{ old('username') }}" class="form-control">
                        <span class="input-group-text">{{ $general->cur_text }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label>@lang('Amount Will Cut From Your Account')</label>
                    <div class="input-group">
                        <input type="text" class="form-control calculation" readonly>
                        <span class="input-group-text">{{ $general->cur_text }}</span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn--base w-100">@lang('Transfer')</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}


@endsection

@push('script')
<script type="text/javascript">
    $('input[name=amount]').on('input',function(){
        var amo = parseFloat($(this).val());
        var calculation = amo + ( parseFloat({{ $general->bt_fixed }}) + ( amo * parseFloat({{ $general->bt_percent }}) ) / 100 );
        $('.calculation').val(calculation);
    });

    $('.checkUser').on('focusout',function(e){
        var url = '{{ route('user.checkUser') }}';
        var value = $(this).val();
        var token = '{{ csrf_token() }}';
        var data = {username:value,_token:token}
        $.post(url,data,function(response) {
            if(response.data != false){
                $(`.${response.type}Exist`).text('');
            }else{
                $(`.${response.type}Exist`).text(`${response.type} not found`);
            }
        });
    });
</script>
@endpush
