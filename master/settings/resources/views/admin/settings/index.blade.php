@extends('theme.admin.layouts.blank')

@section('content')
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
          <a href="" class="btn btn-sm btn-neutral">Save</a>
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
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
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
                        <td width="10%"><button class="btn btn-sm btn-primary btn-add-data">Add Data</button></td>
                      </tr>
                    </tfoot>
                  </table>
                </div> 
              </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  @include('theme.admin.partials.copyright')
</div>
@stop