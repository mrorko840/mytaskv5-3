@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <div id="tableContent">
                            <table class="table table--light style--two custom-data-table">
                                <thead>
                                <tr>
                                    <th>@lang('Gateway')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($gateways as $gateway)
                                    <tr>
                                        <td data-label="@lang('Gateway')">
                                            <div class="user">
                                                <div class="thumb"><img src="{{ getImage(imagePath()['gateway']['path'].'/'. $gateway->image,imagePath()['gateway']['size'])}}" alt="@lang('image')"></div>
                                                <span class="name">{{__($gateway->name)}}</span>
                                            </div>
                                        </td>
    
                                        <td>
                                            @if($gateway->status == 1)
                                                <span class="text--small badge font-weight-normal badge--success">@lang('Enabled')</span>
                                            @else
                                                <span class="text--small badge font-weight-normal badge--warning">@lang('Disabled')</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <a href="{{ route('admin.gateway.manual.edit', $gateway->alias) }}" class="btn btn-sm btn-outline--primary editGatewayBtn">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </a>
    
                                                @if($gateway->status == 0)
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" 
                                                        data-question="@lang('Are you sure to enable this gateway?')" 
                                                        data-action="{{ route('admin.gateway.manual.activate',$gateway->code) }}">
    
                                                        <i class="la la-eye"></i> @lang('Enable')
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" 
                                                        data-question="@lang('Are you sure to disable this gateway?')" 
                                                        data-action="{{ route('admin.gateway.manual.deactivate',$gateway->code) }}">
    
                                                        <i class="la la-eye-slash"></i> @lang('Disable')
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
    
                                </tbody>
                            </table><!-- table end -->
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>
    <x-confirmation-modal></x-confirmation-modal>
@endsection

@push('script')
    <script>
         // active & deactive
         $(document).on('click', '.yes-confirm', function (e) {
            e.preventDefault()
            let formData = new FormData($('.yes-confirm-Form')[0])
            let action = $('.yes-confirm-Form').attr('action');
            // console.log(action);
            $.ajax({
                type: "POST",
                url: action,
                data: formData,
                processData: false,
                dataType: 'json',
                contentType: false,
                success: function (res) {
                    console.log(res);
                    $('.confirmationModal').modal('hide');
                    $('#tableContent').load(location.href+" #tableContent");
                    notifyMsg(res.msg,res.cls)
                }
            });
        });
    </script>
@endpush


@push('breadcrumb-plugins')
    <div class="d-flex flex-wrap justify-content-end">
        <a class="btn btn-outline--primary h-45 me-2 mb-2" href="{{ route('admin.gateway.manual.create') }}"><i class="las la-plus"></i>@lang('Add New')</a>
        <div class="d-inline">
            <div class="input-group justify-content-end">
                <input type="text" name="search_table" class="form-control bg--white" placeholder="@lang('Search')...">
                <button class="btn btn--primary input-group-text"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
@endpush
