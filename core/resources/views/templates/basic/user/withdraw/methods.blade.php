@extends($activeTemplate . 'layouts.master')
@section('content')

    <body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="addmoney">
        <!-- Top navbar -->
        {{-- @include($activeTemplate . 'includes.side_nav') --}}

        <!-- Begin page content -->
        <main class="flex-shrink-0 main has-footer">
            <!-- Fixed navbar -->
            @include($activeTemplate . 'includes.top_nav_mini')

            <form action="{{ route('user.withdraw.money') }}" method="post">
                @csrf

                <div class="main-container">
                    <div class="container mb-4">
                        <p class="text-center text-secondary mb-1">Enter Amount to Add</p>
                        <div class="form-group mb-1">
                            <input type="number" step="any" name="amount" value="{{ old('amount') }}"
                                class="form-control large-gift-card" autocomplete="off" placeholder="00.00" required>
                        </div>
                        <p class="text-center text-secondary mb-4">Available: {{ $general->cur_sym }}
                            {{ showAmount($user->balance) }} </p>
                        <div class="form-group position-relative" hidden>
                            <div class="bottom-right mb-1 mr-1">
                                <button class="btn btn-sm btn-success rounded">Apply</button>
                            </div>
                            <input type="text" class="form-control" placeholder="Promo Code (optional)">
                        </div>
                    </div>

                    <div class="container mb-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="custom-control custom-switch">
                                            <input type="radio" name="paynow" class="custom-control-input" id="pay3"
                                                checked="">
                                            <label class="custom-control-label" for="pay3"></label>
                                        </div>
                                    </div>

                                    <div class="col pl-0">
                                        <h6 class="subtitle mb-0">Withdraw via</h6>
                                    </div>
                                    <div class="col-5">
                                        <select style="height: fit-content;" class="form-control form-select p-0 ps-1"
                                            name="method_code" required>
                                            <option value="">@lang('Gateway')</option>
                                            @foreach ($withdrawMethod as $data)
                                                <option value="{{ $data->id }}" data-resource="{{ $data }}">
                                                    {{ __($data->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mb-4 preview-details d-none">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <ul class="list-group list-group-flush payment-list">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>@lang('Limit')</span>
                                                <span><span class="min fw-bold">0</span> {{ __($general->cur_text) }} -
                                                    <span class="max fw-bold">0</span> {{ __($general->cur_text) }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>@lang('Charge')</span>
                                                <span><span class="charge fw-bold">0</span>
                                                    {{ __($general->cur_text) }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>@lang('Receivable')</span> <span><span class="receivable fw-bold">
                                                        0</span> {{ __($general->cur_text) }} </span>
                                            </li>
                                            <li class="list-group-item d-none justify-content-between rate-element">

                                            </li>
                                            <li class="list-group-item d-none justify-content-between in-site-cur">
                                                <span>@lang('In') <span class="base-currency"></span></span>
                                                <strong class="final_amo">0</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="container text-center">
                        <button type="submit" class="btn btn-default mb-2 mx-auto rounded">Withdraw Money</button>
                        {{-- <a href="thank_you.html" class="btn btn-default mb-2 mx-auto rounded">Add Money</a> --}}
                    </div>
                </div>

                <div style="height: 70px"></div>

            </form>



        </main>



        <!-- footer-->
        @include($activeTemplate . 'includes.bottom_nav')


    </body>

@endsection

@push('script')
    <script type="text/javascript">
        (function($) {
            "use strict";
            $('select[name=method_code]').change(function() {
                if (!$('select[name=method_code]').val()) {
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                var resource = $('select[name=method_code] option:selected').data('resource');
                var fixed_charge = parseFloat(resource.fixed_charge);
                var percent_charge = parseFloat(resource.percent_charge);
                var rate = parseFloat(resource.rate)
                var toFixedDigit = 2;
                $('.min').text(parseFloat(resource.min_limit).toFixed(2));
                $('.max').text(parseFloat(resource.max_limit).toFixed(2));
                var amount = parseFloat($('input[name=amount]').val());
                if (!amount) {
                    amount = 0;
                }
                if (amount <= 0) {
                    $('.preview-details').addClass('d-none');
                    return false;
                }
                $('.preview-details').removeClass('d-none');

                var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                $('.charge').text(charge);
                if (resource.currency != '{{ $general->cur_text }}') {
                    var rateElement =
                        `<span>@lang('Conversion Rate')</span> <span class="fw-bold">1 {{ __($general->cur_text) }} = <span class="rate">${rate}</span>  <span class="base-currency">${resource.currency}</span></span>`;
                    $('.rate-element').html(rateElement);
                    $('.rate-element').removeClass('d-none');
                    $('.in-site-cur').removeClass('d-none');
                    $('.rate-element').addClass('d-flex');
                    $('.in-site-cur').addClass('d-flex');
                } else {
                    $('.rate-element').html('')
                    $('.rate-element').addClass('d-none');
                    $('.in-site-cur').addClass('d-none');
                    $('.rate-element').removeClass('d-flex');
                    $('.in-site-cur').removeClass('d-flex');
                }
                var receivable = parseFloat((parseFloat(amount) - parseFloat(charge))).toFixed(2);
                $('.receivable').text(receivable);
                var final_amo = parseFloat(parseFloat(receivable) * rate).toFixed(toFixedDigit);
                $('.final_amo').text(final_amo);
                $('.base-currency').text(resource.currency);
                $('.method_currency').text(resource.currency);
                $('input[name=amount]').on('input');
            });
            $('input[name=amount]').on('input', function() {
                var data = $('select[name=method_code]').change();
                $('.amount').text(parseFloat($(this).val()).toFixed(2));
            });
        })(jQuery);
    </script>
@endpush
