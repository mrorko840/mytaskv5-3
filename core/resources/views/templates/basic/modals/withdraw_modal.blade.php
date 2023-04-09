<!-- Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="withdrawModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="withdrawModalLabel">Withdraw Fund</h5>
                <button type="button" class="close withdrawClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body Start Here -->
            <div id="withdrawModalBody" class="modal-body">
                @include($activeTemplate . 'user.withdraw.ajax_withdraw')
            </div>
        </div>
    </div>
</div>

@push('script')
    <script type="text/javascript">
        $(document).on('submit', '#withdrawForm', function(e) {
            e.preventDefault()
            // alert()
            let formData = new FormData($("#withdrawForm")[0])
            $.ajax({
                type: "POST",
                url: "{{ route('user.withdraw.money') }}",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(res) {
                    console.log(res);
                    $('#withdrawModalBody').html(res.view);
                },
                error: function(err) {
                    console.log(err);
                    notifyMsg("Check Limit at first!", "warning")
                }
            });
        });

        $(document).on('submit', '#menualWithdraw', function(e) {
            e.preventDefault();
            let formData = new FormData($("#menualWithdraw")[0])
            $.ajax({
                type: "POST",
                url: "{{ route('user.withdraw.submit') }}",
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function(res) {
                    $(".withdrawClose").click();
                    $('#withdrawModalBody').load(location.href + ' #withdrawModalBody');
                    notifyMsg(res.msg, res.cls)
                }
            });
        });



        $(document).on('change', 'select[name=withdraw_method_code]',function() {
            if (!$('select[name=withdraw_method_code]').val()) {
                $('.withdraw-preview-details').addClass('d-none');
                return false;
            }
            var resource = $('select[name=withdraw_method_code] option:selected').data('resource');
            var fixed_charge = parseFloat(resource.fixed_charge);
            var percent_charge = parseFloat(resource.percent_charge);
            var rate = parseFloat(resource.rate)
            var toFixedDigit = 2;
            $('.min').text(parseFloat(resource.min_limit).toFixed(2));
            $('.max').text(parseFloat(resource.max_limit).toFixed(2));
            var amount = parseFloat($('input[name=withdraw_amount]').val());
            if (!amount) {
                amount = 0;
            }
            if (amount <= 0) {
                $('.withdraw-preview-details').addClass('d-none');
                return false;
            }
            $('.withdraw-preview-details').removeClass('d-none');

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
            $('input[name=withdraw_amount]').on('input');
        });
        $(document).on('input', 'input[name=withdraw_amount]', function() {
            var data = $('select[name=withdraw_method_code]').change();
            $('.amount').text(parseFloat($(this).val()).toFixed(2));
        });

    </script>
@endpush
