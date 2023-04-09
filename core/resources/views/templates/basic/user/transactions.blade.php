@extends($activeTemplate . 'layouts.master')
@section('content')

    <body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">

        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">
            <!-- Fixed navbar -->
            @include($activeTemplate . 'includes.top_nav_mini')

            <div class="main-container">

                <div class="container">

                    <div class="card responsive-filter-card mb-4">
                        <div class="card-body">
                            <form action="">
                                <div class="d-flex flex-wrap gap-4">
                                    <div class="p-1 w-100">
                                        <label>@lang('Transaction Number')</label>
                                        <input class="form-control" name="search" id="search" type="text" value="{{ request()->search }}">
                                    </div>
                                    <div class="flex-grow-1 p-1">
                                        <label>@lang('Type')</label>
                                        <select id="trx_type" class="form-control form-select" name="trx_type">
                                            <option value="" @selected(request()->trx_type == '')>@lang('All')</option>
                                            <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                            <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                                        </select>
                                    </div>
                                    <div class="flex-grow-1 p-1">
                                        <label>@lang('Remark')</label>
                                        <select id="remark" class="form-control form-select" name="remark">
                                            <option value="">@lang('All')</option>
                                            @foreach ($remarks as $remark)
                                                <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>
                                                    {{ __(keyToTitle($remark->remark)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="flex-grow-1 align-self-end p-1">
                                        <button class="btn btn-warning border-custom w-100">@lang('Filter')</button>
                                    </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <div id="existSearch">
                    @include('templates.basic.user.trxAjax')
                </div>

                {{-- @forelse($transactions as $trx)
                    <div class="container">
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        <div class="avatar avatar-50 rounded">
                                            <div class="background">
                                                @if ($trx->remark == 'deposit')
                                                    <img src="{{ getImage(imagePath()['gateway']['path'] . '/' . $trx->trx_logo, imagePath()['gateway']['size']) }}"
                                                        alt="">
                                                @elseif($trx->remark == 'withdraw')
                                                    <img src="{{ getImage(imagePath()['gateway']['path'] . '/' . $trx->trx_logo, imagePath()['gateway']['size']) }}"
                                                        alt="">
                                                @else
                                                    <img src="{{ asset($activeTemplateTrue . '/assets/img/services/' . $trx->trx_logo) }}"
                                                        alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col align-self-center pr-0">
                                        <h6 class="font-weight-normal mb-1"> {{ __(@$trx->details) }}</h6>
                                        <p class="small text-secondary">{{ showDateTime($trx->created_at, 'd-m-Y') }} |
                                            {{ diffForHumans($trx->created_at) }}
                                            <br>
                                            Trx: <b class="text-info">{{ $trx->trx }}</b>
                                        </p>


                                    </div>

                                    <div class="col-auto">

                                        <h6
                                            class="@if ($trx->trx_type == '+') {{ 'text-success' }} @else {{ 'text-danger' }} @endif">

                                            @if (getAmount($trx->amount) != 0)
                                                {{ __($trx->trx_type) }}
                                                {{ __($general->cur_sym) }}
                                                {{ getAmount($trx->amount) }}
                                            @else
                                                {{ __($trx->trx_type) }}
                                                {{ __($general->cur_sym) }}
                                                {{ getAmount($trx->charge) }}
                                            @endif

                                        </h6>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div colspan="100%" class="text-center text-danger">@lang('Data Not Found')!</div>
                @endforelse

                @if ($transactions->hasPages())
                    <div class="container">
                        <div style="margin: 0 auto; justify-content: center;" class="row-12">
                            {{ paginateLinks($transactions) }}
                        </div>
                    </div>
                @endif --}}


            </div>

        </main>

    </body>
@endsection
@push('script')
    <script>

        //-- Search --//
        $(document).on('keyup', '#search', function (e) {
            e.preventDefault();
            let search_value = $(this).val()
            console.log(search_value);
            $.ajax({
                type: "GET",
                url: "transactions?search="+search_value,
                success: function (res) {
                    if(search_value!=''){
                        $("#existSearch").html(res);
                    }else{
                        $('#existSearch').load(location.href + ' #existSearch')
                    }
                }
            });
        });

        //-- Trx Type --//
        $(document).on('change', '#trx_type', function (e) {
            e.preventDefault();
            let trx_type_value = $(this).val()
            $.ajax({
                type: "GET",
                url: "transactions?trx_type="+trx_type_value,
                data:{trx_type:trx_type_value},
                success: function (res) {
                    if(trx_type_value!=''){
                        $("#existSearch").html(res);
                    }else{
                        $('#existSearch').load(location.href + ' #existSearch')
                    }
                }
            });
        });

        //-- Remark --//
        $(document).on('change', '#remark', function (e) {
            e.preventDefault();
            let remark_value = $(this).val()
            $.ajax({
                type: "GET",
                url: "transactions?remark="+remark_value,
                data:{remark:remark_value},
                success: function (res) {
                    console.log(res);
                    if(remark_value!=''){
                        $("#existSearch").html(res);
                    }else{
                        $('#existSearch').load(location.href + ' #existSearch')
                    }
                }
            });
        });

        //-- Pagination --//
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            pagination(page)            
        });
        
        function pagination(page){
            $.ajax({
                data:{page:page},
                success: function (res) {
                    $("#existSearch").html(res);
                }
            });
        }
    </script>
@endpush
