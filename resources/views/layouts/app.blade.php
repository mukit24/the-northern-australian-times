<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Northern Australian Times</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
      .bg1{
        background-color: #E1DDD2;
      }
      .bg2{
        background-color: #555A54;
      }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg2">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">The Northern Australian Times</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('articleList') }}">Articles</a>
              </li>
              @auth
              <li class="nav-item">
                <form class="d-flex" action="/logout" method="POST">
                  @csrf
                  <a class="nav-link"><button class="btn btn-danger btn-sm" type="submit">Log out</button></a>
                </form>
                <li class="nav-item">
                  <a class="nav-link"><button class="btn btn-sm btn-info">{{ auth()->user()->name }}</button></a>
                </li>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link" href="/login"><button class="btn btn-sm btn-warning">Login</button></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/register"><button class="btn btn-sm btn-light">Register</button></a>
              </li>
              @endauth
              
            </ul>
          </div>
        </div>
    </nav>
    <section class="bg1 text-dark">
      @yield('content')
    </section>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>