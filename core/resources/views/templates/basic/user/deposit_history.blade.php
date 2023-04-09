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

            @forelse($deposits as $log) 
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-50 rounded">
                                    <div class="background">
                                        @if(@$log->gateway->image)
                                        <img src="{{getImage(imagePath()['gateway']['path'].'/'.$log->gateway->image)}}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1">Deposit Via {{ __(@$log->gateway->name)  }}
                                </h6>
                                <p class="small text-secondary">
                                    Trx: <b class="text-info">{{ $log->trx }}</b>
                                    <br>
                                    {{showDateTime($log->created_at, 'd-m-Y')}} | {{ diffForHumans($log->created_at) }}
                                </p>
                            </div>

                            @php
                                $details = ($log->detail != null) ? json_encode($log->detail) : null;
                            @endphp

                            <div class="col-auto text-right">
                                {{__($general->cur_sym)}} {{ showAmount($log->amount + $log->charge) }}
                                <br>
                                ({{ showAmount($log->final_amo) }} {{ __($log->method_currency) }})
                                <br>
                                <a href="javascript:void(0)" class="@if($log->method_code >= 1000) detailBtn @else disabled @endif"
                                    @if($log->method_code >= 1000)
                                        data-info="{{ $details }}"
                                    @endif
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

            @if ($deposits->hasPages())
                <div class="">
                    {{ paginateLinks($deposits) }}
                </div>
            @endif
        </div>

    </main>
</body>





{{-- <div class="cmn-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header border-0 py-3">
                        <form action="">
                            <div class="d-flex justify-content-end">
                                <div class="input-group w-auto">
                                    <input type="text" name="search" class="form-control" value="{{ request()->search }}" placeholder="@lang('Search by transactions')">
                                    <button class="input-group-text bg-primary border-0 text-white">
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
                                        <th>@lang('Details')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($deposits as $deposit)
                                        <tr>
                                            <td>
                                                <span class="fw-bold"> <span class="text-primary">{{ __($deposit->gateway?->name) }}</span> </span>
                                                <br>
                                                <small> {{ $deposit->trx }} </small>
                                           </td>

                                           <td class="text-center">
                                               {{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}
                                           </td>
                                           <td class="text-center">
                                              {{ __($general->cur_sym) }}{{ showAmount($deposit->amount ) }} + <span class="text-danger" title="@lang('charge')">{{ showAmount($deposit->charge)}} </span>
                                               <br>
                                               <strong title="@lang('Amount with charge')">
                                               {{ showAmount($deposit->amount+$deposit->charge) }} {{ __($general->cur_text) }}
                                               </strong>
                                           </td>
                                           <td class="text-center">
                                              1 {{ __($general->cur_text) }} =  {{ showAmount($deposit->rate) }} {{__($deposit->method_currency)}}
                                               <br>
                                               <strong>{{ showAmount($deposit->final_amo) }} {{__($deposit->method_currency)}}</strong>
                                           </td>
                                           <td class="text-center">
                                               @php echo $deposit->statusBadge @endphp
                                           </td>
                                            @php
                                                $details = ($deposit->detail != null) ? json_encode($deposit->detail) : null;
                                            @endphp

                                            <td>
                                                <a href="javascript:void(0)" class="btn btn--base btn-sm @if($deposit->method_code >= 1000) detailBtn @else disabled @endif"
                                                    @if($deposit->method_code >= 1000)
                                                        data-info="{{ $details }}"
                                                    @endif
                                                    @if ($deposit->status == 3)
                                                    data-admin_feedback="{{ $deposit->admin_feedback }}"
                                                    @endif
                                                    >
                                                    <i class="fa fa-desktop"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($deposits->hasPages())
                    <div class="card-footer">
                        {{ $deposits->links() }}
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
                <ul class="list-group userData mb-2">
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

                var userData = $(this).data('info');
                var html = '';
                if(userData){
                    userData.forEach(element => {
                        if(element.type != 'file'){
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                        }
                    });
                }

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
