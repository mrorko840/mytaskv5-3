<div class="modal fade" id="container" tabindex="-1" aria-labelledby="containerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('activate_system_submit') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="containerLabel">Enter your Purchase Code</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="text-center" class="form-group">
                        <small id="code" class="form-text text-muted">You need to enter your Purchase
                            Code.Otherwise you can't use <a
                                href="{{ route('home') }}">{{ $_SERVER['SERVER_NAME'] }}</a>.</small>
                        <input type="test" name="code" class="form-control" id="code"
                            aria-describedby="code" placeholder="Enter your purchase code" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-warning btn-sm w-100 border-custom my-2"
                        value="Unlock Now">
                </div>
            </form>
        </div>
    </div>
</div>