@extends($activeTemplate.'layouts.master')
@section('content')

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        @include(activeTemplate() . 'includes.top_nav_mini')

        <div class="main-container">
            <div class="container">
                <form action="">
                    <div class="d-flex justify-content-end ms-auto table--form mb- mb-3 flex-wrap">
                        <div class="input-group">

                            <input class="form-control border-custom mr-2" name="search" type="text" value="{{ request()->search }}" placeholder="@lang('Search by transactions')">
                        
                            <button class="input-group-text text-white border-custom bg-warning">
                                <span class="material-icons">
                                    search
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @forelse($withdraws as $log) 
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-50 rounded">
                                    <div class="background">
                                        @if(@$log->method->image)
                                        <img src="{{getImage(imagePath()['gateway']['path'].'/'.$log->method->image)}}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1">Withdraw Via {{ __(@$log->method->name) }}
                                </h6>
                                <p class="small text-secondary">
                                    Trx: <b class="text-info">{{ $log->trx }}</b>
                                    <br>
                                    {{showDateTime($log->created_at, 'd-m-Y')}} | {{ diffForHumans($log->created_at) }}
                                </p>
                            </div>

                            <div class="col-auto text-right">
                                {{__($general->cur_sym)}} {{ showAmount($log->amount - $log->charge) }}
                                <br>
                                ({{ showAmount($log->final_amount) }} {{ __($log->currency) }})
                                <br>
                                <a href="javascript:void(0)" class="detailBtn"
                                    data-user_data="{{ json_encode($log->withdraw_information) }}"
                                    @if ($log->status == 3)
                                    data-admin_feedback="{{ $log->admin_feedback }}"
                                    @endif
                                    >
                                    @if($log->status == 1)
                                        <span class="badge badge-success style--light">@lang('Complete')</span>
                                    @elseif($log->status == 2)
                                        <span class="badge badge-warning style--light">@lang('Pending')</span>
                                    @elseif($log->status == 3)
                                        <span class="badge badge-danger style--light">@lang('Rejected')</span>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div colspan="100%" class="text-center text-danger">@lang('Data Not Found')!</div>
            @endforelse 

            @if ($withdraws->hasPages())
                <div class="">
                    {{ paginateLinks($withdraws) }}
                </div>
            @endif
        </div>

    </main>
</body>



{{-- <div class="cmn-section">
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header border-0">
                        <form action="">
                            <div class="d-flex justify-content-end">
                                <div class="input-group w-auto">
                                    <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('Search by transactions')">
                                    <button class="input-group-text bg-primary text-white border-0">
                                        <i class="las la-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive--sm">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>@lang('Gateway | Transaction')</th>
                                        <th class="text-center">@lang('Initiated')</th>
                                        <th class="text-center">@lang('Amount')</th>
                                        <th class="text-center">@lang('Conversion')</th>
                                        <th class="text-center">@lang('Status')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @forelse($withdraws as $withdraw)
                                    <tr>
                                        <td data-label="@lang('Gateway | Transaction')">
                                            <span class="fw-bold"><span class="text-primary"> {{ __(@$withdraw->method->name) }}</span></span>
                                            <br>
                                            <small>{{ $withdraw->trx }}</small>
                                        </td>
                                        <td data-label="@lang('Initiated')" class="text-center">
                                            {{ showDateTime($withdraw->created_at) }} <br>  {{ diffForHumans($withdraw->created_at) }}
                                        </td>
                                        <td data-label="@lang('Amount')" class="text-center">
                                            {{ __($general->cur_sym) }}{{ showAmount($withdraw->amount ) }} - <span class="text-danger" title="@lang('charge')">{{ showAmount($withdraw->charge)}} </span>
                                             <br>
                                             <strong title="@lang('Amount after charge')">
                                             {{ showAmount($withdraw->amount-$withdraw->charge) }} {{ __($general->cur_text) }}
                                             </strong>

                                         </td>
                                         <td data-label="@lang('Conversion')" class="text-center">
                                            1 {{ __($general->cur_text) }} =  {{ showAmount($withdraw->rate) }} {{ __($withdraw->currency) }}
                                             <br>
                                             <strong>{{ showAmount($withdraw->final_amount) }} {{ __($withdraw->currency) }}</strong>
                                         </td>
                                         <td data-label="@lang('Status')" class="text-center">
                                            @php echo $withdraw->statusBadge @endphp
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <button class="btn btn-sm btn--base detailBtn"
                                            data-user_data="{{ json_encode($withdraw->withdraw_information) }}"
                                            @if ($withdraw->status == 3)
                                            data-admin_feedback="{{ $withdraw->admin_feedback }}"
                                            @endif
                                            >
                                                <i class="la la-desktop"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($withdraws->hasPages())
                    <div class="card-footer">
                        {{$withdraws->links()}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> --}}


 {{-- APPROVE MODAL --}}
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Details')</h5>
                <span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </span>
            </div>
            <div class="modal-body">
                <ul class="list-group userData">

                </ul>
                <div class="feedback"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-sm" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.detailBtn').on('click', function () {
                var modal = $('#detailModal');
                var userData = $(this).data('user_data');
                var html = ``;
                userData.forEach(element => {
                    if(element.type != 'file'){
                        html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>${element.name}</span>
                            <span">${element.value}</span>
                        </li>`;
                    }
                });
                modal.find('.userData').html(html);

                if($(this).data('admin_feedback') != undefined){
                    var adminFeedback = `
                        <div class="my-3">
                            <strong>@lang('Admin Feedback')</strong>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                }else{
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);

                modal.modal('show');
            });
        })(jQuery);

    </script>
@endpush
