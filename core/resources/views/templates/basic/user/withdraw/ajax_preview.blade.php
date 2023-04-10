<div class="pt-120 pb-120">
    <div class="main-container">
        <div class="row justify-content-center">
            <div class="col mx-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="card-title">@lang('Withdraw Via') {{ $withdraw->method->name }}</h5>
                    </div>
                    <div class="card-body">
                        <form id="menualWithdraw" action="{{route('user.withdraw.submit')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                @php
                                    echo $withdraw->method->description;
                                @endphp
                            </div>
                            <div class="row py-2">
                                <div class="col">
                                    <label for="withdrawPass">Withdraw Password</label>
                                    <input id="withdrawPass" class="form-control" type="text" name="withdrawPass" placeholder="Enter your Withdraw Pin" required>
                                </div>
                            </div>
                            <x-viser-form identifier="id" identifierValue="{{ $withdraw->method->form_id }}" />
                            @if(auth()->user()->ts)
                            <div class="form-group">
                                <label>@lang('Google Authenticator Code')</label>
                                <input type="text" name="authenticator_code" class="form-control form--control" required>
                            </div>
                            @endif
                            <div>
                                <button type="submit" class="btn btn-default border-custom w-100">@lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>