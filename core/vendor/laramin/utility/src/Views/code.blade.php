<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="container my-5">
        <div class="card">
          <div class="card-body">
            <form action="{{route('activation_submit')}}" method="POST">
              @csrf
              <div class="text-center" class="form-group">
                <label for="code"><h3>Purchase Code</h3></label>
                <br>
                <small id="code" class="form-text text-muted">You need to enter your Purchase Code.Otherwise you can't use <a href="{{route('home')}}">{{$_SERVER['SERVER_NAME']}}</a>.</small>
                <input type="test" name="code" class="form-control" id="code" aria-describedby="code" placeholder="Enter your purchase code" required>
                
              </div>
              <input type="submit" class="btn btn-warning btn-sm w-100 border-custom my-2" value="Unlock Now">
            </form>
          </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>