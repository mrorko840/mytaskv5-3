@extends($activeTemplate.'layouts.master')
@section('content')
<section class="cmn-section">
    <div class="container">
        <div class="text-end mb-3">
            <a href="{{ route('user.ptc.create') }}" class="btn btn--base btn-sm">@lang('Create Advertisement')</a>
        </div>
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive--sm">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Type')</th>
                                <th scope="col">@lang('Duration')</th>
                                <th scope="col">@lang('Maximum View')</th>
                                <th scope="col">@lang('Viewed')</th>
                                <th scope="col">@lang('Remain')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ads as $ptc)
                            <tr>
                                <td>{{strLimit($ptc->title,20)}}</td>
                                <td>
                                    @php echo $ptc->typeBadge @endphp
                                </td>
                                <td>{{$ptc->duration}} @lang('Sec')</td>
                                <td>{{$ptc->max_show}}</td>
                                <td>{{$ptc->showed}}</td>
                                <td>{{$ptc->remain}}</td>


                                <td class="font-weight-bold">{{ showAmount($ptc->amount) }} {{$general->cur_text}}</td>

                                <td>
                                    @php echo $ptc->statusBadge; @endphp
                                </td>
                                <td>
                                    @if ($ptc->status == 3)
                                        <button class="btn btn--base btn-sm" disabled><i class="la la-pen"></i></button>
                                    @else
                                        <a class="btn btn--base btn-sm" href="{{route('user.ptc.edit',$ptc->id)}}"><i class="la la-pen"></i></a>
                                    @endif
                                    @if($ptc->status == 1 || $ptc->status == 0)
                                        @if($ptc->status == 1)
                                            <a class="btn btn--danger btn-sm" href="{{route('user.ptc.status',$ptc->id)}}"><i class="la la-eye-slash"></i></a>
                                        @else
                                            <a class="btn btn--success btn-sm" href="{{route('user.ptc.status',$ptc->id)}}"><i class="la la-eye"></i></a>
                                        @endif
                                    @else
                                        <button class="btn btn--danger btn-sm" disabled><i class="la la-eye-slash"></i></button>
                                    @endif
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
            @if($ads->hasPages())
            <div class="card-footer">
                {{ $ads->links() }}
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
