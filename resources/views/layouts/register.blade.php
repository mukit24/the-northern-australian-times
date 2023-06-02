@extends('layouts.app')

@section('content')
<div class="container p-4">
  <div class="row justify-content-center">
    <div class="col-lg-5">
      <h2>Journalist Registration</h2>
      <h6>Already Have an Account ? Then <a class="text-decoration-none" href="/login"> Click Login</a></h6>
    <form action="/register" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="exampleInputName" value="{{old('name')}}">
            @error('name')
                <p class="text-danger">{{$message}}</p>
            @enderror
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input name="email" type="email" class="form-control" value="{{old('email')}}">
          @error('email')
                <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1" value="{{old('password')}}">
          @error('password')
                <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
        <button type="submit" class="btn btn-success w-100">Register</button>
    </form>
    </div>
  </div>
</div>
@endsection