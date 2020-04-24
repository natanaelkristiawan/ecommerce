@extends('theme.public.layouts.login')

@section('content')
<div class="container mt--8 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary border-0 mb-0">
        <div class="card-body px-lg-5 py-lg-5">
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
          <form role="form" method="POST" role="form" action="{{ route('login') }}"  data-toggle="validator" data-disable="false">
            @csrf
            <div class="form-group mb-3">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control" name="email" required="" placeholder="Email" type="email">
              </div>
              <div class="help-block with-errors error"></div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" name="password" required="" placeholder="Password" type="password">
              </div>
              <div class="help-block with-errors error"></div>
            </div>
            <div class="custom-control custom-control-alternative custom-checkbox">
              <input class="custom-control-input" name="remember" value="0" type="hidden">
              <input class="custom-control-input" name="remember" value="0" id=" customCheckLogin" type="checkbox">
              <label class="custom-control-label" for=" customCheckLogin">
                <span class="text-muted">Remember me</span>
              </label>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary2 my-4">Sign in</button>
            </div>
          </form>
       </div>

      </div>
      <div class="row mt-3">
        <div class="col-6">
          <a href="{{ route('public') }}" class="text-light"><small>Back To Site</small></a>
        </div>
        <div class="col-6 text-right">
          <a href="{{ route('register') }}" class="text-light"><small>Create new account</small></a>
        </div>
      </div>
    </div>
  </div>
</div>
@stop