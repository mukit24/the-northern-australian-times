@extends('layouts.app')

@section('content')
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h2 class="text-center">Journalist Login</h2>
            <h6>New Jounalist ? Then <a class="text-decoration-none" href="/register"> Click Register</a></h6>
    @if(session('message'))
    <div class="alert alert-danger alert-dismissible my-4 fade show">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Journalist Name</label>
            <input name="loginname" type="text" class="form-control" id="exampleInputName" value="{{old('loginname')}}">
            @error('loginname')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input name="loginpassword" type="password" class="form-control" id="exampleInputPassword1" value="{{old('loginpassword')}}">
          @error('loginpassword')
                <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
        </div>
    </div>
</div>
@endsection