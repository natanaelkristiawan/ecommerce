@extends('theme.admin.layouts.blank')

@section('content')

<form method="POST" action="" >
  @csrf
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            {{ Breadcrumbs::render('settings') }}
            </nav>
          </div>
          <div class="col-lg-6 col-5 text-right">
            <button type="submit" class="btn btn-sm btn-neutral">Save</button>
            <a href="" class="btn btn-sm btn-neutral">Reset</a>
          </div>
        </div>
      </div>
    </div>
  </div>



  <div class="container-fluid mt--6">
    <!-- Table -->
    <div class="row">
      <div class="col">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <h3 class="mb-0">Data</h3>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="section1-tab" data-toggle="tab" href="#section1" role="tab" aria-controls="section1" aria-selected="true">Section 1</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="section2-tab" data-toggle="tab" href="#section2" role="tab" aria-controls="section2" aria-selected="false">Section 2</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="section3-tab" data-toggle="tab" href="#section3" role="tab" aria-controls="section3" aria-selected="false">Section 3</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" id="metadata-tab" data-toggle="tab" href="#metadata" role="tab" aria-controls="metadata" aria-selected="false">Metadata</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="section1" role="tabpanel" aria-labelledby="section1-tab">
                <div class="mt-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Logo</label>
                          {!! Upload::setForm('logo', 'master.settings', array()) !!}
                      </div>
                    </div>

                     <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Background</label>
                          {!! Upload::setForm('background', 'master.settings', array()) !!}
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="form-control-label">Title</label> 
                    <input type="text" value="" placeholder="Title"name="setting[section1_title]" class="form-control">
                  </div> 

                  <div class="form-group">
                    <label class="form-control-label">Caption 1</label> 
                    <input type="text" value="" placeholder="Caption 1" name="setting[section1_caption_1]" class="form-control">
                  </div> 

                  <div class="form-group">
                    <label class="form-control-label">Caption 2</label> 
                    <input type="text" value="" placeholder="Caption 2" name="setting[section1_caption_2]" class="form-control">
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="section2" role="tabpanel" aria-labelledby="section2-tab">
                <div class="mt-4">
                  <div class="form-group">
                    <label class="form-control-label">Title</label> 
                    <input type="text" value="" placeholder="Title" name="setting[section2_title]" class="form-control">
                  </div> 
                  <div class="form-group">
                    <label class="form-control-label">Sub Title</label> 
                    <input type="text" value="" placeholder="Sub Title" name="setting[section2_sub_title]" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Data</label> 
                    <table class="table" id="table-data">
                      <thead>
                        <tr>
                          <th>Data</th>
                          <th width="10%">Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <td></td>
                          <td width="10%"><button type="button" class="btn btn-sm btn-primary btn-add-data">Add Data</button></td>
                        </tr>
                      </tfoot>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div> 
                </div>
              </div>
              <div class="tab-pane fade" id="section3" role="tabpanel" aria-labelledby="section3-tab">
                <div class="mt-4">
                  <div class="form-group">
                    <label class="form-control-label">Product</label>
                    <select name="setting[section3_product][]" data-placeholder="Choose a Product..." multiple class="chosen-select" tabindex="4">
                      <option value="1">Product 1</option>
                      <option value="2">Product 2</option>
                      <option value="3">Product 3</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Quotes</label>
                    <table class="table" id="table-qoute">
                      <thead>
                        <tr>
                          <th>Quote</th>
                          <th width="10%">Action</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <td></td>
                          <td width="10%"><button type="button" class="btn btn-sm btn-primary btn-add-quote">Add Quote</button></td>
                        </tr>
                      </tfoot>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="metadata" role="tabpanel" aria-labelledby="metadata-tab">
                <div class="mt-4">
                  <div class="form-group">
                    <label class="form-control-label">Meta Title</label> 
                    <input type="text" placeholder="Meta Title" name="setting[meta_title]" value="" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Meta Tag</label>
                    <input  type="text" placeholder="Meta Tag" value="" name="setting[meta_tag]" class="form-control tagsinput">
                  </div>
                  <div class="form-group">
                    <label class="form-control-label">Meta Description</label>
                    <textarea class="form-control" rows="5" name="setting[meta_description]"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    @include('theme.admin.partials.copyright')
  </div>
</form>
@stop



@section('script')
@parent


<script type="x-tmpl-mustache" id="template">
  <tr id="data@{{count}}">
    <td><input type="text"  class="form-control" name="setting[section2_data][@{{count}}]"></td>
    <td><button onclick="$('#data@{{count}}').remove()" class="btn btn-sm btn-danger">Delete</button></td>
  </tr>
</script>
<script type="x-tmpl-mustache" id="template-quote">
  <tr id="data_quote@{{count}}">
    <td><input type="text"  class="form-control" name="setting[section3_quote][@{{count}}]"></td>
    <td><button onclick="$('#data_quote@{{count}}').remove()" class="btn btn-sm btn-danger">Delete</button></td>
  </tr>
</script>


<script type="text/javascript">
  var count=0;
  var count_quote=0;
  $(document).ready(function() {
    $('.btn-add-data').on('click', function(){
      var template = $('#template').html();

      var data = {
        count : count,
      };

      htmlBody = Mustache.render(template, data);

      $('#table-data tbody').append(htmlBody);
      count++;
    });

     $('.btn-add-quote').on('click', function(){
      var template = $('#template-quote').html();

      var data = {
        count : count_quote,
      };

      htmlBody = Mustache.render(template, data);

      $('#table-qoute tbody').append(htmlBody);
      count_quote++;
    });

  })
</script>

@stop