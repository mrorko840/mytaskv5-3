@extends($activeTemplate.'layouts.master')
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
                                <div class="flex-grow-1 p-1">
                                    <label>@lang('TRX / Username')</label>
                                    <input type="text" name="search" value="{{ request()->search }}" class="form-control">
                                </div>
                                <div class="flex-grow-1 p-1">
                                    <label>@lang('Levels')</label>
                                    <select class="form-control form-select" name="level">
                                        <option value="">@lang('any')</option>
                                        @for($i = 1; $i <= $levels; $i++)
                                            <option value="{{ $i }}">{{__(ordinal($i))}} @lang('Level')</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="flex-grow-1 p-1">
                                    <label>@lang('Remark')</label>
                                    <select class="form-control form-select" name="remark">
                                        <option value="">@lang('All')</option>
                                        <option value="deposit_commission">@lang('Deposit Commission')</option>
                                        <option value="plan_subscribe_commission">@lang('Plan Subscribe Commission')</option>
                                        <option value="ptc_view_commission">@lang('Advertisement View Commission')</option>
                                    </select>
                                </div>
                                <div class="flex-grow-1 align-self-end p-1">
                                    <button class="btn btn-warning border-custom w-100"><i class="las la-filter"></i> @lang('Filter')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            @forelse($commissions as $log)  
            <div class="container">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar bg-warning-light text-warning avatar-50 rounded">
                                    <div class="background">
                                        <span class="material-icons">
                                            group_add
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1">Commission From {{ __($log->userFrom->username) }} - <span class="small text-danger">{{ ordinal($log->level) }} Level</span></h6>
                                <p class="small text-secondary">
                                    Trx: <b class="text-info">{{ $log->trx }}</b>
                                    <br>
                                    {{ showDateTime($log->created_at, 'd-m-Y') }} | 
                                    {{ diffForHumans($log->created_at) }}
                                    
                                </p>
                                
                                
                            </div>
      
                            <div class="col-auto">

                              <h6 class="text-success">
      
                                  @if(getAmount($log->amount) != 0)
                                  {{ __($log->trx_type) }}
                                  {{ __($general->cur_sym) }}
                                  {{ getAmount($log->amount) }}
                                  
                                  @else
                                  {{ __($log->trx_type) }}
                                  {{ __($general->cur_sym) }}
                                  {{ getAmount($log->charge) }}
                                  @endif
                                  
                              </h6>

                                @if($log->type == 'deposit_commission')
                                    <span class="badge badge-info">@lang('Deposit')</span>
                                @elseif($log->type == 'plan_subscribe_commission')
                                    <span class="badge badge-warning">@lang('Buy Plan')</span>
                                @else
                                    <span class="badge badge-danger">@lang('Ads View')</span>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @empty
              <div colspan="100%" class="text-center text-danger">@lang('Data Not Found')!</div>
            @endforelse 

            @if ($commissions->hasPages())
            <div class="container">
                <div style="margin: 0 auto; justify-content: center;" class="row-12">
                        {{ paginateLinks($commissions) }}
                </div>
                
            </div>
            @endif


        </div>

    </main>

</body>






{{-- <div class="cmn-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="show-filter mb-3 text-end">
                    <button type="button" class="btn btn--base showFilterBtn btn-sm"><i class="las la-filter"></i> @lang('Filter')</button>
                </div>
                <div class="card responsive-filter-card mb-4">
                    <div class="card-body">
                        <form action="">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="flex-grow-1">
                                    <label>@lang('TRX/Username')</label>
                                    <input type="text" name="search" value="{{ request()->search }}" class="form-control">
                                </div>
                                <div class="flex-grow-1">
                                    <label>@lang('Remark')</label>
                                    <select class="form-select form--select" name="remark">
                                        <option value="">@lang('Any')</option>
                                        <option value="deposit_commission">@lang('Deposit Commission')</option>
                                        <option value="plan_subscribe_commission">@lang('Plan Subscribe Commission')</option>
                                        <option value="ptc_view_commission">@lang('Advertisement View Commission')</option>
                                    </select>
                                </div>
                                <div class="flex-grow-1">
                                    <label>@lang('Levels')</label>
                                    <select class="form-select form--select" name="level">
                                        <option value="">@lang('Any')</option>
                                        @for($i = 1; $i <= $levels; $i++)
                                            <option value="{{ $i }}">{{__(ordinal($i))}} @lang('Level')</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="flex-grow-1 align-self-end">
                                    <button class="btn btn--base w-100"><i class="las la-filter"></i> @lang('Filter')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive--sm">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th>@lang('Transaction')</th>
                                    <th>@lang('Commission From')</th>
                                    <th>@lang('Commission Level')</th>
                                    <th>@lang('Commission Type')</th>
                                    <th>@lang('Amount')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($commissions as $log)
                                    <tr>
                                        <td data-label="@lang('Transaction')">{{ $log->trx }}</td>
                                        <td data-label="@lang('Commission From')">{{ __($log->userFrom->username) }}</td>
                                        <td data-label="@lang('Level')">{{ ordinal($log->level) }}</td>
                                        <td data-label="@lang('Commission Type')">
                                            @if($log->type == 'deposit_commission')
                                                <span class="badge badge--success">@lang('Deposit')</span>
                                            @elseif($log->type == 'plan_subscribe_commission')
                                                <span class="badge badge--dark">@lang('Plan Subscribe')</span>
                                            @else
                                                <span class="badge badge--primary">@lang('Ads View')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Amount')">{{ showAmount($log->amount) }} {{ __($general->cur_text) }}</td>
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
                </div>
                {{paginateLinks($commissions)}}
            </div>
        </div>
    </div>
</div> --}}
@endsection


@push('script')
<script>
    (function($){
    "use strict"
        $('[name=remark]').val('{{ request()->remark }}');
        $('[name=level]').val('{{ request()->level }}');
    })(jQuery);
</script>
@endpush
