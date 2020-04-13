@extends('theme.public.layouts.login')

@section('content')
<div class="container mt--8 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary border-0 mb-0">
        <div class="card-body px-lg-5 py-lg-5">
          <form role="form" method="POST" role="form" action="{{ route('register') }}"  data-toggle="validator" data-disable="false">
            @csrf
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" required="" placeholder="Name" type="text">
              </div>
              <div class="help-block with-errors error"></div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control" required="" placeholder="Email" type="email">
              </div>
              <div class="help-block with-errors error"></div>
            </div>

            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-tablet-button"></i></span>
                </div>
                <input class="form-control"  required="" placeholder="Phone" type="number">
              </div>
              <div class="help-block with-errors error"></div>
            </div> 
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                </div>
                <input class="form-control" required="" placeholder="Invite Code" type="text">
              </div>
              <div class="help-block with-errors error"></div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" required=""  minlength="6" placeholder="Password" type="password">
              </div>
              <div class="help-block with-errors error"></div>
            </div>
            <div class="row my-4">
              <div class="col-12">
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                  <label class="custom-control-label" for="customCheckRegister">
                    <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary mt-4">Create account</button>
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <a href="{{ route('public') }}" class="text-light"><small>Back To Site</small></a>
        </div>
        <div class="col-6 text-right">
          <a href="{{ route('login') }}" class="text-light"><small>Login with exist account</small></a>
        </div>
      </div>
    </div>
  </div>
</div>
@stop