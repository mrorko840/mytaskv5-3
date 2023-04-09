@extends('admin.layouts.app')
@section('panel')
    <ul class="nav nav-tabs justify-content-left" id="myTab" role="tablist">
        @foreach ($plans as $plan)
            <li class="nav-item">
                <a style="background-color: #fff0;" class="nav-link  bg-info mx-1" id="yt-tab" data-toggle="tab"
                    href="#{{ str_replace(' ', '', $plan->name) }}" role="tab"
                    aria-controls="{{ str_replace(' ', '', $plan->name) }}" 
                    aria-selected="true">
                    {{ $plan->name }}
                </a>
            </li>
        @endforeach

    </ul>

    <div class="tab-content" id="myTabContent">
        @foreach ($ads as $ptc)
            @foreach ($plans as $plan)
                <div class="tab-pane fade" id="{{ str_replace(' ', '', $plan->name) }}" role="tabpanel" aria-labelledby="yt-tab">
                    @foreach ($ads as $ptc)
                        @if ($plan->id == $ptc->plan_id)
                            <div class="card my-2">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-auto pr-0">
                                            <div class="avatar avatar-50 rounded">
                                                <div class="background">
                                                    @if ($ptc->ads_type == 4)
                                                        <img width="50px" height="50px"
                                                            src="{{ asset($activeTemplateTrue . '/assets/img/services/yt_logo.png') }}"
                                                            alt="">
                                                    @elseif ($ptc->ads_type == 1)
                                                        <img width="50px" height="50px"
                                                            src="{{ asset($activeTemplateTrue . '/assets/img/services/web_logo.png') }}"
                                                            alt="">
                                                    @elseif ($ptc->ads_type == 2)
                                                        <img width="50px" height="50px"
                                                            src="{{ asset($activeTemplateTrue . '/assets/img/services/image_logo.png') }}"
                                                            alt="">
                                                    @elseif ($ptc->ads_type == 3)
                                                        <img width="50px" height="50px"
                                                            src="{{ asset($activeTemplateTrue . '/assets/img/services/code_logo.png') }}"
                                                            alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col align-self-center pr-0">
                                            <h6 class="font-weight-normal mb-1"> {{ strLimit($ptc->title, 20) }}</h6>
                                            <p class="small text-secondary">
                                                Only for
                                                <span class="text-info">
                                                    @if ($plan->id == $ptc->plan_id)
                                                        {{ $plan->name }}
                                                    @endif
                                                </span>
                                                <br>
                                                Duration: <span class="text-warning">{{ $ptc->duration }}
                                                    @lang('Sec')</span>
                                            </p>
                                        </div>

                                        <div class="col-auto text-center">

                                            <h6 class="text-danger">
                                                {{ showAmount($ptc->amount) }} {{ $general->cur_text }}
                                            </h6>

                                            @php echo $ptc->statusBadge @endphp
                                            <br>

                                            <a class="badge badge--warning mt-1"
                                                href="{{ route('admin.ptc.edit', $ptc->id) }}">
                                                <i class="la la-pen"></i> @lang('Edit')
                                            </a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        @endforeach

    </div>
@endsection
@push('script')
    <script>
        
    </script>
@endpush

@push('breadcrumb-plugins')
    <a href="{{ route('admin.ptc.create') }}" class="btn btn-outline--primary btn-sm"><i class="las la-plus"></i>
        @lang('Add New')</a>
@endpush

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
