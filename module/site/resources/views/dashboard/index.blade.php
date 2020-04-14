@extends('theme.public.layouts.dashboard')

@section('content')
<div class="container-fluid mt--6">
  <div class="row card-wrapper">
      @foreach($products as $product)
    <div class="col-lg-3">

      <!-- Pricing card -->
      <div class="card card-pricing border-0 text-center mb-4">
        <div class="card-header bg-transparent">
          <h4 class="text-uppercase ls-1 text-primary py-3 mb-0">{{ $product->name }}</h4>
        </div>
        <div class="card-body px-lg-7 nambah-padding">
          <div class="display-2">${{ number_format($product->price_dollar) }}</div>
          <span class=" text-muted">{{ number_format($product->price_idr) }} IDR</span>
          {!! $product->detail !!}
          <button type="button" class="btn btn-primary mb-3">Buy</button>
        </div>
      </div>
    </div>
      @endforeach
  </div>
  <!-- Footer -->
  @include('theme.admin.partials.copyright')
</div>

@stop


@section('script')
@parent
<style type="text/css">
  ul {
    padding-left: 0;
    list-style: none;

  }
  .nambah-padding ul {
    margin-top: 1.5rem !important;
    margin-bottom: 1.5rem !important;
  }
</style>
@stop