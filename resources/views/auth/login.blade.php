@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-4">
    <h3 class="text-center">Login TRAX</h3>
    <form action="{{ route('login.post') }}" method="post">
      @csrf
      <div class="mb-3">
        <label>Username</label>
        <input name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input name="password" type="password" class="form-control" required>
      </div>
      <button class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>
@endsection
