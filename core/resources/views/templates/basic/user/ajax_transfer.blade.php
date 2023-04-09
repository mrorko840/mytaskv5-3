
<form id="transferForm" action="{{ route('user.transfer.submit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container mb-4">
        <p class="text-center text-secondary mb-1">Enter Amount to send</p>
        <p class="text-center">
            <small class="text-success text-center">( @lang('Charge'): {{ getAmount($general->bt_fixed) }}
                {{ $general->cur_text }} + {{ getAmount($general->bt_percent) }}% )</small>
        </p>
        <div class="form-group mb-1">
            <input type="number" id="transferAmount" step="any" name="amount" class="form-control large-gift-card bg-warning-light border transferAmount" value="{{ old('username') }}" placeholder="00.00" required>
        </div>
        <p class="text-center text-secondary mb-4">
            Available: <span class="text-success">{{ $general->cur_sym }} {{ showAmount(auth()->user()->balance) }}</span> <br><br>
            <label for="cutAmount">Amount Will Cut From Your Account</label>
            <input type="text" id="cutAmount" class="form-control text-center text-danger calculation"
                placeholder="Amount Will Cut From Your Account" readonly>
        </p>
        

        <div class=" mb-1">
            <div class="card bg-default">
                <div class="card-header">
                    <div class="container mb-1 text-center">
                        <div class="row mb-4 justify-content-center">
                            <div class="col-auto">
                                <div class="icon icon-40 bg-default-light text-default mb-2 rounded-circle"><span class="material-icons">account_circle</span> </div>
                                <p class="small text-white">Contact</p>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-40 bg-default-light text-default mb-2 rounded-circle"><span class="material-icons">qr_code_scanner</span> </div>
                                <p class="small text-white">QR Code</p>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-40 bg-default-light text-default mb-2 rounded-circle"><span class="material-icons">account_balance</span> </div>
                                <p class="small text-white">Bank</p>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-40 bg-default-light text-default mb-2 rounded-circle"><span class="material-icons">account_balance_wallet</span> </div>
                                <p class="small text-white">Wallet</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="radio" name="paynow" class="custom-control-input" id="pay1" checked="">
                                <label class="custom-control-label" for="pay1"></label>
                            </div>
                        </div>
                        <div class="col-auto pl-0">
                            <h6 class="subtitle mb-0">Pay from wallet</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <input type="text" name="username" class="form-control form-control-lg text-center checkUserTransfer" placeholder="username" required>
            <div class="valid-feedback text-center">username found!</div>
            <div class="invalid-feedback text-center">Enter a valid username plese.</div>
        </div>

    </div>

    <div class="container text-center">
        <button type="submit" class="btn btn-default mb-2 mx-auto rounded w-100">Transfer Now</button>
    </div>
</form>