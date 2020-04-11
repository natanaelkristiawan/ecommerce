@extends('theme.admin.layouts.blank')

@section('content')

<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
           @if($method == 'create')
            {{ Breadcrumbs::render('products.create') }}
            @else
            {{ Breadcrumbs::render('products.edit') }}
            @endif
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-neutral">New</a>
          <a href="{{ route('admin.products') }}" class="btn btn-sm btn-danger">Close</a>
        </div>
      </div>
    </div>
  </div>
</div>


<form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
  @csrf
  <div class="container-fluid mt--6">

    <div class="card mb-4">
      <!-- Card header -->
      <div class="card-header">
        <h3 class="mb-0">Form</h3>
      </div>
      <!-- Card body -->
      <div class="card-body">

         <div class="form-group">
            <label class="form-control-label">Nama <span class="required">*</span></label> 
            <input required="" data-error="Please enter name" type="text" value="{{ $data->name }}" placeholder="Nama" id="name" name="name" class="form-control">
            <div class="help-block with-errors error"></div>
          </div>
          <div class="form-group">
            <label class="form-control-label">Slug <span class="required">*</span></label> 
            <input required="" data-error="Please enter slug" type="text" value="{{ $data->slug }}" placeholder="Slug" id="slug" name="slug" class="form-control">
            <div class="help-block with-errors error"></div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-control-label">Price IDR (Rp)<span class="required">*</span></label> 
                <input required="" data-error="Please enter price idr" type="number" value="{{ $data->price_idr }}" placeholder="Price IDR" name="price_idr" class="form-control">
                <div class="help-block with-errors error"></div>
              </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                <label class="form-control-label">Price Dollar ($)<span class="required">*</span></label> 
                <input required="" data-error="Please enter price idr" type="number" value="{{ $data->price_dollar }}" placeholder="Price Dollar" name="price_dollar" class="form-control">
                <div class="help-block with-errors error"></div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="form-control-label">File</label> 
            {!! Upload::setForm('file', 'master.products', $data->file) !!}
          </div>


          <div class="form-group">
            <label class="form-control-label">Detail</label> 
            <textarea  data-error="Please enter detail" type="text" placeholder="Slug" id="detail" name="detail" class="form-control textarea">{!! $data->detail !!}</textarea>
            <div class="help-block with-errors error"></div>
          </div>

          <div class="form-group">
            <label class="form-control-label">Status</label> 
            <div>
              <input type="hidden" name="status" value="0">
              <input type="checkbox" class="js-switch" name="status" value="1" {{ (bool)$data->status ?  'checked' : ''}} />
            </div>
          </div>

          <div class="hr-line-dashed"></div>
          <div class="form-group row">
            <div class="col-sm-4 col-sm-offset-2">
              <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
              <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
              <a href="{{ route('admin.products') }}" class="btn btn-danger btn-sm" >Cancel</a>
            </div>
          </div>

      </div>
    </div>
  </div>
</form>

@stop


@section('script')
@parent
<script type="text/javascript">

  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { color: '#1AB394' });

  $('.textarea').summernote({
    tabsize: 2,
    height: 300,
    callbacks: {
      onImageUpload: function(files) {
        sendFile(files[0], $(this), "{{ url(env('ADMIN_URL', 'admin').'/upload/'.'master.products/'.date('Y/m/d').'/product/file') }}");
      }
    }
  });
  $(document).ready(function(){
    $('#name').on('keyup', function(){
      var name = $(this).val();
      var slug = slugify(name);
      $('#slug').val(slug);
    });
  });


</script>
@stop