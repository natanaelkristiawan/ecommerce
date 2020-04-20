@extends('theme.admin.layouts.blank')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          {{ Breadcrumbs::render('customer.create') }}
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-neutral">New</a>
          <a href="{{ route('admin.customers') }}" class="btn btn-sm btn-danger">Close</a>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid mt--6">
  <div class="card">
    <div class="card-header">
      <h3 class="mb-0">Form</h3>
    </div>

    <div class="card-body">
      <div class="text-left">
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
        <form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
        @csrf
        <div class="form-group">
          <label class="form-control-label">Name</label>
          <input type="text" class="form-control" name="name" value="{{ $data->name }}">
        </div>  
        <div class="form-group">
          <label class="form-control-label">Email</label>
          <input type="email" class="form-control" name="email" value="{{ $data->email }}">
        </div>
        
        <div class="form-group">
          <label class="form-control-label">Password</label>
          <input type="password" class="form-control" name="password" value="">
        </div>

        <div class="form-group row">
          <div class="col-sm-4 col-sm-offset-2">
            <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
            <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
            <a href="{{ route('admin.customers') }}" class="btn btn-danger btn-sm" >Cancel</a>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

</div>

@stop