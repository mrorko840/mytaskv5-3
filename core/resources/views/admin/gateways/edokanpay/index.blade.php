@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">

                    <form id="autoPaymentForm" action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label> @lang('Api Key')</label>
                                    <input class="form-control" type="text" name="api_key" required value="{{@$autoPayment->api_key}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label> @lang('Client Key')</label>
                                    <input class="form-control" type="text" name="client_key" required value="{{@$autoPayment->client_key}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label> @lang('Secret Key')</label>
                                    <input class="form-control" type="text" name="secret_key" required value="{{@$autoPayment->secret_key}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush

@push('script')

    <script>
        $(document).on('submit', '#autoPaymentForm', function (e) {
            e.preventDefault();
            let formData = new FormData($('#autoPaymentForm')[0])
            $.ajax({
                type: "POST",
                url: "{{route('admin.gateway.edokanpay.update')}}",
                data: formData,
                dataType: "json",
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {
                    console.log(res);
                    notifyMsg(res.msg,res.cls)
                }
            });
            
        });
    </script>
@endpush

