@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--sm">
                        <div id="tableBlock">
                            <table class="table table--light style--two">
                            <thead id="tableHead">
                                <tr>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Price')</th>
                                    <th scope="col">@lang('Limit/Day')</th>
                                    <th scope="col">@lang('Ads Rate')</th>
                                    <th scope="col">@lang('Validity')</th>
                                    <th scope="col" hidden>@lang('Referral Commission')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @forelse($plans as $plan)
                                    <tr>
                                        <td data-label="@lang('Name')">{{ $plan->name }}</td>
                                        <td data-label="@lang('Price')" class="font-weight-bold">
                                            {{ showAmount($plan->price) }} {{ $general->cur_text }}</td>
                                        <td data-label="@lang('Limit/Day')">{{ $plan->daily_limit }} @lang('Ads')</td>
                                        <td data-label="@lang('Ads Rate')">{{ $general->cur_sym }}
                                            {{ showAmount($plan->ads_rate) }}</td>
                                        <td data-label="@lang('Validity')">{{ $plan->validity }} @lang('Day')</td>
                                        <td data-label="@lang('Referral Commission')" hidden>@lang('up to') <span
                                                class="font-weight-bold text-primary px-3">{{ $plan->ref_level }}
                                            </span>@lang('level')</td>
                                        <td data-label="@lang('Status')">
                                            @if ($plan->status == 1)
                                                <span class="badge badge--success">@lang('Active')</span>
                                            @else
                                                <span class="badge badge--danger">
                                                    @lang('Inactive')
                                                </span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <button class="btn btn-outline--primary btn-sm planBtn"
                                                data-id="{{ $plan->id }}" data-name="{{ $plan->name }}"
                                                data-price="{{ getAmount($plan->price) }}"
                                                data-daily_limit="{{ $plan->daily_limit }}"
                                                data-ads_rate="{{ getAmount($plan->ads_rate) }}"
                                                data-validity="{{ $plan->validity }}" data-status="{{ $plan->status }}"
                                                data-ref_level="{{ $plan->ref_level }}" data-act="Edit">
                                                <i class="la la-pencil"></i> @lang('Edit')
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
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="planModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class="act"></span> @lang('Subscription Plan')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form id="addModalForm">
                    <input type="hidden" name="id" id="plan_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">@lang('Name') </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="@lang('Plan Name')"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="price">@lang('Price') </label>
                            <div class="input-group">
                                <input type="number" class="form-control has-append" name="price" id="price"
                                    placeholder="@lang('Price of Plan')" required>
                                <div class="input-group-text">{{ $general->cur_text }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="daily_limit">@lang('Daily Ad Limit')</label>
                            <input type="number" class="form-control" name="daily_limit" id="daily_limit" placeholder="@lang('Daily Ad Limit')"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="ads_rate">@lang('Per Ads Rate')</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="ads_rate" id="ads_rate" placeholder="@lang('Per Ads Rate')"
                                    required>
                                <div class="input-group-text">{{ $general->cur_text }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="daily_limit">@lang('Validity')</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="validity" id="validity" placeholder="@lang('Validity')"
                                    required>
                                <div class="input-group-text">@lang('Days')</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="details">@lang('Referral Commission') </label>
                            <select name="ref_level" id="ref_level" class="form-control" required>
                                <option value="0"> @lang('NO Referral Commission')</option>
                                @for ($i = 1; $i <= $levels; $i++)
                                    <option value="{{ $i }}"> @lang('Up to') {{ $i }}
                                        @lang('Level')</option>
                                @endfor
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="status">@lang('Status')</label>
                            <input type="checkbox" data-width="100%" data-height="50" data-onstyle="-success"
                                data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('Enable')"
                                data-off="@lang('Disable')" name="status" id="status" value="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 submitBtn">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn-outline--primary btn-sm planBtn" data-id="0" data-act="Add" data-bs-toggle="modal"
        data-bs-target="#planModal"><i class="las la-plus"></i> @lang('Add New')</button>
@endpush

@push('script')
    <script>
        $(document).on('change', '#status', function (e) {
            e.preventDefault();
            if($(this).prop('checked')){
                $('#status').val('on')
            }else{
                $('#status').val('off')
            }
            console.log($('#status').val());
        });

        $(document).on('click', '.submitBtn', function (e) {
            e.preventDefault();
            let id              = $('#plan_id').val();
            let name            = $('#name').val();
            let price           = $('#price').val();
            let daily_limit     = $('#daily_limit').val();
            let ads_rate        = $('#ads_rate').val();
            let validity        = $('#validity').val();
            let ref_level       = $('#ref_level').val();
            let status          = $('#status').val();
            // let status          = 0;
            $.ajax({
                type: "POST",
                url: "{{ route('admin.plan.save') }}",
                data: {
                    id:id,
                    name:name, 
                    price:price, 
                    daily_limit:daily_limit, 
                    ads_rate:ads_rate, 
                    validity:validity, 
                    ref_level:ref_level, 
                    status:status
                },
                success: function (res) {
                    // console.log(res);
                    $("#planModal").modal('hide');
                    $("#addModalForm")[0].reset();
                    //---For Load Table Body---
                    $('#tableBlock').load(location.href+' #tableBlock');
                    notifyMsg(res.msg, res.cls)
                }
            });
        });

        $(document).on('click','.planBtn', function (e) {
            e.preventDefault();
            var modal = $('#planModal');
            modal.find('.act').text($(this).data('act'));
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=name]').val($(this).data('name'));
            modal.find('input[name=price]').val($(this).data('price'));
            modal.find('input[name=daily_limit]').val($(this).data('daily_limit'));
            modal.find('input[name=ads_rate]').val($(this).data('ads_rate'));
            modal.find('input[name=validity]').val($(this).data('validity'));
            modal.find('input[name=status]').bootstrapToggle($(this).data('status') == 1 ? 'on' : 'off');
            modal.find('select[name=ref_level]').val($(this).data('ref_level'));
            if ($(this).data('id') == 0) {
                modal.find('form')[0].reset();
            }
            modal.modal('show');
        });
    </script>
@endpush
