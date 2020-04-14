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
          <form role="form" method="POST" role="form" action="{{ route('register') }}"  data-toggle="validator" data-disable="false">
            @csrf
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" name="name" required="" value="{{ old('name') }}" placeholder="Name" type="text">
              </div>
              <div class="help-block with-errors error"></div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input class="form-control" required="" value="{{ old('email') }}" name="email" placeholder="Email" type="email">
              </div>
              <div class="help-block with-errors error"></div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                </div>
                <input class="form-control" name="invite_code" required="" placeholder="Invite Code" type="text">
              </div>
              <div class="help-block with-errors error"></div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" name="password" required=""  minlength="6" placeholder="Password" type="password">
              </div>
              <div class="help-block with-errors error"></div>
            </div>
            <div class="row my-4">
              <div class="col-12">
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                  <label class="custom-control-label" for="customCheckRegister">
                    <span class="text-muted">I agree with the <a href="javascript:;" class="popup">Privacy Policy</a></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" disabled="" class="btn btn-primary mt-4" id="btn-submit">Create account</button>
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


<div class="modal fade" id="modal-filter" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modal-filter" aria-hidden="true">
  <div style="margin-top: 30vh" class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Privacy Policy</h3>
      </div>
      <div class="modal-body" id="modal-data">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop


@section('script')
@parent

<script type="text/javascript">
  $(document).on('click', '#customCheckRegister', function() {
    $(this).is(':checked') ? $('#btn-submit').removeAttr('disabled') : $('#btn-submit').attr('disabled', 'disabled');
  });

  $(document).ready(function(){
    $('.popup').on('click', function(){
      $('#modal-filter').modal('show');
    });
  });
</script>
@stop