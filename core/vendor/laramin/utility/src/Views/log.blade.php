<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    @php
        use App\Models\GeneralSetting;
        $general = GeneralSetting::first();
    @endphp

    <div class="container my-5">
        @php
            echo @$notify;
        @endphp

        @if ($general->code == $_SERVER['SERVER_NAME'])
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center text-success">
                        Your Product is Activated.
                    </h3>
                    <h6 class="text-center text-dark">
                        For any information <a href="https://facebook.com/mrorko10">contact us</a><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#container">.</a>
                    </h6>
                </div>
                <div align="right" class="card-footer">
                  <a class="btn btn-success btn-sm" href="{{route('home')}}">Go to Homepage</a>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center text-danger">
                        Your Product is not Activated.
                    </h3>
                    <h6 class="text-center text-dark">
                        To activate your product <a href="https://facebook.com/mrorko10">contact us</a><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#container">.</a>
                    </h6>
                </div>
            </div>
        @endif

    </div>

    <div class="container my-5">
        

        {{-- @if ($general->code != $_SERVER['SERVER_NAME'])
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('activate_system_submit') }}" method="POST">
                        @csrf
                        <div class="text-center" class="form-group">
                            <label for="code">
                                <h3>Enter your Purchase Code</h3>
                            </label>
                            <br>
                            <small id="code" class="form-text text-muted">You need to enter your Purchase
                                Code.Otherwise you can't use <a
                                    href="{{ route('home') }}">{{ $_SERVER['SERVER_NAME'] }}</a>.</small>
                            <input type="test" name="code" class="form-control" id="code"
                                aria-describedby="code" placeholder="Enter your purchase code" required>

                        </div>
                        <input type="submit" class="btn btn-warning btn-sm w-100 border-custom my-2"
                            value="Unlock Now">
                    </form>
                </div>
            </div>
        @endif --}}

    </div>


    
    @include('Utility::modal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
