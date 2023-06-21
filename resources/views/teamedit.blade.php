<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h2>Team Edit - {{ $team->name }}</h2>
                    </div>
                    <div class="card-body">
                      <form action="{{ url('team/edit/post') }}/{{ $team->id }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Team Member Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $team->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Team Member Phone Number</label>
                            <input type="tel" class="form-control" name="phone_number" value="{{ $team->phone_number }}">
                        </div>
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Team Update</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>