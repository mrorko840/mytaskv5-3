<!-- Modal -->
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="transferModalLabel">Transfer Fund</h5>
                <button type="button" class="close transferClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body Start Here -->
            <div id="transferModalBody" class="modal-body">
                @include($activeTemplate . 'user.ajax_transfer')
            </div>
        </div>
    </div>
</div>

@push('script')
<script type="text/javascript">
    $(document).on('submit', '#transferForm', function (e) {
        e.preventDefault();
        let formData = new FormData($("#transferForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('user.transfer.submit') }}",
            data: formData,
            processData: false,
            dataType: 'json',
            contentType: false,
            success: function (res) {
                if(res.cls=='success'){
                    $(".transferClose").click();
                    $('#transferModalBody').load(location.href + ' #transferModalBody');
                }
                notifyMsg(res.msg,res.cls)
            },
            error: function (err) {
                console.log(err.responseJSON['message']);
                let msg = err.responseJSON['message'];
                notifyMsg(msg,'error')
            }
        });
        
    });

    $(document).on('input', '.transferAmount',function(){
        var amo = parseFloat($('.transferAmount').val());
        var calculation = amo + ( parseFloat("{{ $general->bt_fixed }}") + ( amo * parseFloat("{{ $general->bt_percent }}") ) / 100 );
        console.log(amo);
        $('#cutAmount').val(calculation);
    });

    $(document).on('keyup', '.checkUserTransfer',function(e){
        e.preventDefault();
        var url = "{{ route('user.checkUser') }}";
        var value = $(this).val();
        var token = '{{ csrf_token() }}';
        var data = {username:value,_token:token}
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (res) {
                let checkUser = $('.checkUserTransfer');
                if(res.data==true){
                    checkUser.removeClass('is-invalid');
                    checkUser.addClass('is-valid');
                }else{
                    checkUser.removeClass('is-valid');
                    checkUser.addClass('is-invalid');
                }
            }
        });
    });
</script>
@endpush